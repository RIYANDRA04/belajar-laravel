@extends('layouts.app')
@section('title', 'Checkout — ShoesAsia')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-12">

    <div class="flex items-center gap-3 mb-8" data-aos="fade-right">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
            <i data-lucide="credit-card" class="w-5 h-5 text-white"></i>
        </div>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800">Checkout</h1>
            <p class="text-gray-500 text-sm">Lengkapi data pengiriman</p>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="flex items-center gap-4 mb-10" data-aos="fade-up">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 text-white flex items-center justify-center">
                <i data-lucide="check" class="w-4 h-4"></i>
            </div>
            <span class="text-sm font-semibold text-indigo-600">Keranjang</span>
        </div>
        <div class="flex-1 h-0.5 bg-indigo-200 rounded"></div>
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full text-white text-xs font-bold flex items-center justify-center" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">2</div>
            <span class="text-sm font-bold text-indigo-600">Data Pengiriman</span>
        </div>
        <div class="flex-1 h-0.5 bg-slate-200 rounded"></div>
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 text-xs font-bold flex items-center justify-center">3</div>
            <span class="text-sm text-gray-400">Selesai</span>
        </div>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Form Fields --}}
            <div class="lg:col-span-2 space-y-5" data-aos="fade-right">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h2 class="font-bold text-gray-800 mb-5 flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4 text-indigo-500"></i> Informasi Penerima
                    </h2>

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="user" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
                            <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}"
                                   placeholder="Masukkan nama lengkap"
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-slate-200 focus:border-indigo-400 focus:outline-none text-sm transition-all @error('customer_name') border-red-400 @enderror">
                        </div>
                        @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- WhatsApp -->
                    <div class="mb-4">
                        <label for="customer_phone" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Nomor WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="phone" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
                            <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}"
                                   placeholder="Contoh: 08123456789"
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-slate-200 focus:border-indigo-400 focus:outline-none text-sm transition-all @error('customer_phone') border-red-400 @enderror">
                        </div>
                        @error('customer_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="customer_address" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="map-pin" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
                            <textarea id="customer_address" name="customer_address" rows="3"
                                      placeholder="Jl. Contoh No. 1, Kelurahan, Kecamatan, Kota, Kode Pos"
                                      class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-slate-200 focus:border-indigo-400 focus:outline-none text-sm transition-all resize-none @error('customer_address') border-red-400 @enderror">{{ old('customer_address') }}</textarea>
                        </div>
                        @error('customer_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Catatan -->
                    <div class="mb-6">
                        <label for="note" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Catatan <span class="text-gray-400 font-normal">(opsional)</span>
                        </label>
                        <div class="relative">
                            <i data-lucide="message-square" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
                            <textarea id="note" name="note" rows="2"
                                      placeholder="Contoh: Warna hitam lebih diutamakan, tolong bubble wrap tebal"
                                      class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-slate-200 focus:border-indigo-400 focus:outline-none text-sm resize-none transition-all">{{ old('note') }}</textarea>
                        </div>
                    </div>

                    <!-- Metode Pembayaran Card (Premium Layout) -->
                    <div class="border-t border-slate-100 pt-6">
                        <h2 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="wallet" class="w-4 h-4 text-indigo-500"></i> Pilih Metode Pembayaran
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- COD Option -->
                            <label class="relative flex flex-col p-4 rounded-2xl border-2 border-slate-200 cursor-pointer hover:border-indigo-400 transition-all select-none group has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50/20">
                                <input type="radio" id="payment-cod" name="payment_method" value="cod" class="sr-only" {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-105 transition-transform">
                                            <i data-lucide="banknote" class="w-4.5 h-4.5"></i>
                                        </div>
                                        <span class="font-bold text-gray-800 text-sm">Cash on Delivery (COD)</span>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 border-slate-300 flex items-center justify-center group-has-[:checked]:border-indigo-600 group-has-[:checked]:bg-indigo-600">
                                        <div class="w-2 h-2 rounded-full bg-white hidden group-has-[:checked]:block"></div>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-400 ml-11">Bayar secara tunai di tempat saat kurir mengantarkan paket sepatu Anda.</p>
                            </label>

                            <!-- Midtrans Option -->
                            <label class="relative flex flex-col p-4 rounded-2xl border-2 border-slate-200 cursor-pointer hover:border-indigo-400 transition-all select-none group has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50/20">
                                <input type="radio" id="payment-midtrans" name="payment_method" value="midtrans" class="sr-only" {{ old('payment_method') === 'midtrans' ? 'checked' : '' }}>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:scale-105 transition-transform">
                                            <i data-lucide="credit-card" class="w-4.5 h-4.5"></i>
                                        </div>
                                        <span class="font-bold text-gray-800 text-sm">Transfer / E-Wallet</span>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 border-slate-300 flex items-center justify-center group-has-[:checked]:border-indigo-600 group-has-[:checked]:bg-indigo-600">
                                        <div class="w-2 h-2 rounded-full bg-white hidden group-has-[:checked]:block"></div>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-400 ml-11">Bayar otomatis instan lewat Virtual Account, QRIS (Gopay/ShopeePay), dll.</p>
                            </label>
                        </div>

                        <!-- Midtrans Embedded Payment Section (Premium Inline Design) -->
                        <div id="midtrans-embedded-container" class="mt-6 hidden transition-all duration-500 overflow-hidden max-h-0">
                            <div class="bg-indigo-50/10 border border-indigo-500/10 rounded-3xl p-5 shadow-sm">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4 pb-4 border-b border-slate-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-sm">
                                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <p class="font-extrabold text-sm text-gray-800 tracking-wide">Pilihan Metode Pembayaran</p>
                                            <p class="text-xs text-gray-400">Silakan pilih opsi pembayaran instan Anda di bawah</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 text-[10px] font-bold text-emerald-600 uppercase tracking-wider w-fit">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                                        Tersambung Aman
                                    </div>
                                </div>
                                <div id="snap-container" class="w-full bg-white rounded-2xl border border-slate-200/80 overflow-hidden min-h-[400px] shadow-sm">
                                    <div class="flex flex-col items-center justify-center min-h-[400px] text-gray-400 space-y-3">
                                        <div class="w-12 h-12 rounded-full border-4 border-indigo-500/30 border-t-indigo-500 animate-spin"></div>
                                        <p class="text-xs font-bold animate-pulse text-indigo-500">Menghubungkan ke secure payment gateway...</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @error('payment_method') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div data-aos="fade-left">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sticky top-24">
                    <h3 class="font-bold text-gray-800 mb-4">Pesananmu</h3>

                    <div class="space-y-3 mb-4 max-h-64 overflow-y-auto pr-1">
                        @foreach($cart as $item)
                        <div class="flex gap-3">
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}"
                                 class="w-14 h-14 rounded-xl object-cover bg-slate-100 flex-shrink-0"
                                 style="{{ !empty($item['image_filter']) ? 'filter:' . $item['image_filter'] . ';' : '' }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=100&q=70'">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-700 line-clamp-2 leading-tight">{{ $item['name'] }}</p>
                                <div class="flex items-center gap-1 mt-0.5 flex-wrap">
                                    <p class="text-xs text-gray-400">Size: {{ $item['size'] }}</p>
                                    @if(!empty($item['selected_color']))
                                    <span class="text-xs bg-indigo-50 text-indigo-600 px-1.5 py-0.5 rounded font-medium">{{ $item['selected_color'] }}</span>
                                    @endif
                                    <p class="text-xs text-gray-400">| Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <p class="text-xs font-bold text-indigo-600 mt-0.5">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr class="border-slate-200 my-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500">Subtotal</span>
                        <span class="font-bold text-gray-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Ongkir</span>
                        <span class="inline-flex items-center gap-2 text-sm font-semibold text-green-600">
                            <i data-lucide="gift" class="w-4 h-4"></i>
                            Gratis
                        </span>
                    </div>
                    <hr class="border-slate-200 mb-4">
                    <div class="flex justify-between items-center mb-6">
                        <span class="font-bold text-gray-700">Total</span>
                        <span class="font-extrabold text-xl text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn w-full border-0 text-white font-bold rounded-2xl text-base transition-all hover:shadow-xl" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                        <span class="flex items-center justify-center gap-2"><i data-lucide="check-circle" class="w-4 h-4"></i> Konfirmasi Pesanan</span>
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn btn-ghost w-full mt-2 text-gray-500 text-sm rounded-2xl">
                        ← Kembali ke Keranjang
                    </a>
                </div>
            </div>

        </div>
    </form>
</div>

<!-- Premium Toast Banner -->
<div id="toast-banner" class="fixed top-5 right-5 z-[10000] bg-slate-900 border border-slate-800 text-white rounded-2xl p-4 shadow-2xl flex items-center gap-3 max-w-sm translate-x-[450px] transition-transform duration-300 pointer-events-none">
    <div class="w-10 h-10 rounded-xl bg-red-500/20 text-red-500 flex items-center justify-center flex-shrink-0">
        <i data-lucide="alert-circle" class="w-5 h-5"></i>
    </div>
    <div>
        <p class="font-extrabold text-sm text-slate-100">Data Belum Lengkap</p>
        <p class="text-xs text-slate-400 mt-0.5" id="toast-message">Mohon lengkapi Nama, WhatsApp, dan Alamat Penerima terlebih dahulu.</p>
    </div>
</div>

<!-- Premium Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-[9999] flex flex-col items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="relative flex flex-col items-center">
        <!-- Modern Spinner -->
        <div class="w-16 h-16 rounded-full border-4 border-indigo-500/30 border-t-indigo-500 animate-spin mb-4"></div>
        <p class="text-white font-extrabold text-lg tracking-wide animate-pulse id-loading-text">Menghubungkan ke Pembayaran Aman...</p>
        <p class="text-slate-400 text-xs mt-1">Mohon tunggu sebentar, jangan menutup halaman ini.</p>
    </div>
</div>

@push('scripts')
<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const codRadio = document.getElementById('payment-cod');
    const midtransRadio = document.getElementById('payment-midtrans');
    const form = document.querySelector('form');
    const overlay = document.getElementById('loading-overlay');
    const loadingText = overlay.querySelector('.id-loading-text');
    const toast = document.getElementById('toast-banner');
    const toastMsg = document.getElementById('toast-message');

    const nameInput = document.getElementById('customer_name');
    const phoneInput = document.getElementById('customer_phone');
    const addressInput = document.getElementById('customer_address');
    const noteInput = document.getElementById('note');
    
    const submitBtn = document.querySelector('button[type="submit"]');

    let toastTimeout = null;
    function showToast(message, type = 'error') {
        toastMsg.textContent = message;
        
        // Premium customized banner style based on type
        const iconContainer = toast.querySelector('.w-10');
        const titleText = toast.querySelector('.font-extrabold');
        
        if (type === 'success') {
            iconContainer.className = 'w-10 h-10 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center flex-shrink-0';
            iconContainer.innerHTML = '<i data-lucide="check-circle" class="w-5 h-5"></i>';
            titleText.textContent = 'Pesanan Tersimpan';
            toast.className = 'fixed top-5 right-5 z-[10000] bg-slate-900 border border-indigo-500/30 text-white rounded-2xl p-4 shadow-2xl flex items-center gap-3 max-w-sm translate-x-[450px] transition-transform duration-300 pointer-events-none';
        } else {
            iconContainer.className = 'w-10 h-10 rounded-xl bg-red-500/20 text-red-500 flex items-center justify-center flex-shrink-0';
            iconContainer.innerHTML = '<i data-lucide="alert-circle" class="w-5 h-5"></i>';
            titleText.textContent = 'Data Belum Lengkap';
            toast.className = 'fixed top-5 right-5 z-[10000] bg-slate-900 border border-slate-800 text-white rounded-2xl p-4 shadow-2xl flex items-center gap-3 max-w-sm translate-x-[450px] transition-transform duration-300 pointer-events-none';
        }
        
        toast.classList.remove('translate-x-[450px]');
        toast.classList.add('translate-x-0');
        if (window.lucide) window.lucide.createIcons();
        
        if (toastTimeout) clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-[450px]');
        }, 5000);
    }

    function highlightField(input) {
        input.focus();
        input.classList.add('border-red-400');
        input.scrollIntoView({ behavior: 'smooth', block: 'center' });
        setTimeout(() => input.classList.remove('border-red-400'), 3000);
    }

    function validateShippingData() {
        if (!nameInput.value.trim()) {
            showToast('Silakan isi Nama Lengkap Penerima terlebih dahulu!');
            highlightField(nameInput);
            return false;
        }
        if (!phoneInput.value.trim()) {
            showToast('Silakan isi Nomor WhatsApp Penerima terlebih dahulu!');
            highlightField(phoneInput);
            return false;
        }
        if (!addressInput.value.trim()) {
            showToast('Silakan isi Alamat Lengkap Pengiriman terlebih dahulu!');
            highlightField(addressInput);
            return false;
        }
        return true;
    }

    let snapLoaded = false;
    let currentSnapToken = '';
    let loadedShippingData = '';

    function getShippingSignature() {
        return nameInput.value.trim() + '|' + phoneInput.value.trim() + '|' + addressInput.value.trim() + '|' + noteInput.value.trim();
    }

    // Toggle handler for payment method
    function handlePaymentMethodChange() {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
        const embeddedContainer = document.getElementById('midtrans-embedded-container');
        
        if (selectedMethod === 'midtrans') {
            // Validate first
            if (!validateShippingData()) {
                if (codRadio) codRadio.checked = true;
                return;
            }
            
            // Show the container with smooth transition
            embeddedContainer.classList.remove('hidden');
            setTimeout(() => {
                embeddedContainer.style.maxHeight = '2000px';
            }, 10);
            
            const currentSig = getShippingSignature();
            
            // Check if we need to load or reload the snap token
            if (!snapLoaded || loadedShippingData !== currentSig) {
                initiateMidtransPayment();
            } else {
                // Already loaded, just update the confirm button text
                updateButtonToMidtransPaidState();
            }
        } else {
            // COD Option selected
            // Smoothly collapse
            embeddedContainer.style.maxHeight = '0px';
            setTimeout(() => {
                embeddedContainer.classList.add('hidden');
            }, 500);
            
            // Restore standard submit button
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span class="flex items-center justify-center gap-2"><i data-lucide="check-circle" class="w-4 h-4"></i> Konfirmasi Pesanan</span>';
            if (window.lucide) window.lucide.createIcons();
        }
    }

    if (midtransRadio) midtransRadio.addEventListener('change', handlePaymentMethodChange);
    if (codRadio) codRadio.addEventListener('change', handlePaymentMethodChange);

    function updateButtonToMidtransPaidState() {
        submitBtn.disabled = false;
        submitBtn.className = "btn w-full border-0 text-white font-bold rounded-2xl text-base transition-all hover:shadow-xl hover:scale-[1.01] flex items-center justify-center gap-2";
        submitBtn.style.background = "linear-gradient(135deg,#6366f1,#8b5cf6,#ec4899)";
        submitBtn.innerHTML = '<span class="flex items-center justify-center gap-2"><i data-lucide="arrow-up" class="w-4 h-4 animate-bounce"></i> Bayar pada Pilihan di Atas</span>';
        if (window.lucide) window.lucide.createIcons();
    }

    function initiateMidtransPayment() {
        // Show inline loading state
        const snapContainer = document.getElementById('snap-container');
        snapContainer.innerHTML = `
            <div class="flex flex-col items-center justify-center min-h-[400px] text-gray-400 space-y-3">
                <div class="w-12 h-12 rounded-full border-4 border-indigo-500/30 border-t-indigo-500 animate-spin"></div>
                <p class="text-xs font-bold animate-pulse text-indigo-500">Mendapatkan token pembayaran aman...</p>
            </div>
        `;
        
        // Update main button to connecting
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="flex items-center justify-center gap-2"><i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Menghubungkan Midtrans...</span>';
        if (window.lucide) window.lucide.createIcons();

        const currentSig = getShippingSignature();

        fetch("{{ route('checkout.initiate-midtrans') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                customer_name: nameInput.value.trim(),
                customer_phone: phoneInput.value.trim(),
                customer_address: addressInput.value.trim(),
                note: noteInput.value.trim()
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.error || 'Terjadi kesalahan sistem.'); });
            }
            return response.json();
        })
        .then(data => {
            if (data.snap_token) {
                currentSnapToken = data.snap_token;
                snapLoaded = true;
                loadedShippingData = currentSig;

                // Clear previous loader inside snap-container
                snapContainer.innerHTML = '';

                // Embed Snap payment options directly into our inline div!
                const redirectUrl = data.redirect_url;
                snap.embed(data.snap_token, {
                    embedId: 'snap-container',
                    onSuccess: function(result) {
                        window.location.href = redirectUrl + '?transaction_status=settlement&status_code=200';
                    },
                    onPending: function(result) {
                        window.location.href = redirectUrl + '?transaction_status=pending&status_code=201';
                    },
                    onError: function(result) {
                        window.location.href = redirectUrl + '?transaction_status=deny&status_code=202';
                    },
                    onClose: function() {
                        // User clicked outside or closed the snap — do nothing, stay on checkout page
                    }
                });

                // Update submit button text to guide the customer
                updateButtonToMidtransPaidState();

                // Smoothly scroll to the payment container so they see it instantly!
                setTimeout(() => {
                    document.getElementById('midtrans-embedded-container').scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 200);

            } else {
                throw new Error('Token transaksi kosong.');
            }
        })
        .catch(err => {
            snapLoaded = false;
            snapContainer.innerHTML = `
                <div class="flex flex-col items-center justify-center min-h-[400px] text-red-500 p-6 text-center space-y-3">
                    <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-500">
                        <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                    </div>
                    <p class="text-sm font-bold">Gagal Memuat Gerbang Pembayaran</p>
                    <p class="text-xs text-gray-500 max-w-xs">${err.message || 'Terjadi gangguan koneksi server.'}</p>
                    <button type="button" id="btn-retry-snap" class="btn btn-sm btn-outline border-indigo-500 text-indigo-500 hover:bg-indigo-50 mt-2 rounded-xl">Coba Lagi</button>
                </div>
            `;
            if (window.lucide) window.lucide.createIcons();
            
            const btnRetry = document.getElementById('btn-retry-snap');
            if (btnRetry) {
                btnRetry.addEventListener('click', handlePaymentMethodChange);
            }
            
            // Revert radio button back to COD
            if (codRadio) codRadio.checked = true;
            handlePaymentMethodChange();
            showToast(err.message || 'Terjadi gangguan saat memproses checkout.');
        });
    }

    // Handle traditional form submit or click on Midtrans state
    if (form) {
        form.addEventListener('submit', function(e) {
            const selectedMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
            
            if (selectedMethod === 'midtrans') {
                e.preventDefault();
                
                // Customize notification/alert on click as per Request 8 & 9
                // Smooth scroll to the embedded midtrans box
                const container = document.getElementById('midtrans-embedded-container');
                container.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Show a premium glassmorphic toast notification urging them to complete payment in the form
                showToast('Pesanan telah dibuat! Selesaikan pembayaran Anda pada menu di atas agar pesanan dapat langsung kami proses.', 'success');
            } else {
                // COD Flow
                if (validateShippingData()) {
                    loadingText.textContent = 'Sedang Memproses Pesanan Anda...';
                    overlay.classList.remove('hidden');
                    setTimeout(() => {
                        overlay.classList.remove('opacity-0');
                        overlay.classList.add('opacity-100');
                    }, 10);
                } else {
                    e.preventDefault();
                }
            }
        });
    }
});
</script>
@endpush
@endsection
