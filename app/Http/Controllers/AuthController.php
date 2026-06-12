<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->is_admin ? redirect()->route('admin.dashboard') : redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($credentials['email'] === 'admin@gmail.com') {
            $this->ensureAdminCredentials();
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return Auth::user()->is_admin
                ? redirect()->route('admin.dashboard')
                : redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    protected function ensureAdminCredentials(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Admin ShoesAsia',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return Auth::user()->is_admin ? redirect()->route('admin.dashboard') : redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil. Selamat datang di ShoesAsia!');
    }

    public function logout(Request $request)
    {
        // Kembalikan stok untuk semua item di keranjang yang belum di-checkout
        $cart = session()->get('cart', []);
        foreach ($cart as $item) {
            $product = \App\Models\Product::find($item['product_id']);
            if ($product) {
                $product->increment('stock', $item['quantity']);
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
