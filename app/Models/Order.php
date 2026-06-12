<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'customer_name', 'customer_phone', 'customer_address',
        'note', 'total_amount', 'status', 'payment_method', 'payment_status',
        'snap_token',
    ];

    protected $casts = [
        'total_amount' => 'decimal:0',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'Pending'   => 'badge-warning',
            'Diproses'  => 'badge-info',
            'Dikirim'   => 'badge-primary',
            'Selesai'   => 'badge-success',
            default     => 'badge-ghost',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'Pending'   => 'text-amber-500 bg-amber-500/10 border-amber-500/30',
            'Diproses'  => 'text-blue-500 bg-blue-500/10 border-blue-500/30',
            'Dikirim'   => 'text-indigo-500 bg-indigo-500/10 border-indigo-500/30',
            'Selesai'   => 'text-green-500 bg-green-500/10 border-green-500/30',
            default     => 'text-gray-500 bg-gray-500/10 border-gray-500/30',
        };
    }

    public function getStatusIconAttribute(): string
    {
        return match ($this->status) {
            'Pending'   => 'clock',
            'Diproses'  => 'package',
            'Dikirim'   => 'truck',
            'Selesai'   => 'check-circle',
            default     => 'circle',
        };
    }

    public function getFormattedPaymentMethodAttribute(): string
    {
        return match ($this->payment_method) {
            'cod'       => 'Bayar di Tempat (COD)',
            'midtrans'  => 'Transfer / E-Wallet (Midtrans)',
            default     => 'Tidak Diketahui',
        };
    }

    public function getFormattedPaymentStatusAttribute(): string
    {
        return match ($this->payment_status) {
            'pending'   => 'Belum Bayar',
            'paid'      => 'Lunas',
            'failed'    => 'Gagal',
            'expired'   => 'Kedaluwarsa',
            default     => 'Belum Bayar',
        };
    }

    public function getPaymentStatusColorAttribute(): string
    {
        return match ($this->payment_status) {
            'pending'   => 'text-amber-500 bg-amber-500/10 border-amber-500/30',
            'paid'      => 'text-emerald-500 bg-emerald-500/10 border-emerald-500/30',
            'failed'    => 'text-rose-500 bg-rose-500/10 border-rose-500/30',
            'expired'   => 'text-slate-500 bg-slate-500/10 border-slate-500/30',
            default     => 'text-amber-500 bg-amber-500/10 border-amber-500/30',
        };
    }
}
