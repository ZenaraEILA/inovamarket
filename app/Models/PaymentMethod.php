<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'provider',
        'account_name',
        'account_number',
        'is_primary',
        'is_verified',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeDisplayAttribute()
    {
        $types = [
            'bank_transfer' => 'Transfer Bank',
            'e_wallet' => 'E-Wallet',
            'credit_card' => 'Kartu Kredit',
        ];

        return $types[$this->type] ?? $this->type;
    }

    public function getProviderLogoAttribute()
    {
        $logos = [
            'bca' => '/images/banks/bca.png',
            'mandiri' => '/images/banks/mandiri.png',
            'bni' => '/images/banks/bni.png',
            'bri' => '/images/banks/bri.png',
            'gopay' => '/images/ewallet/gopay.png',
            'ovo' => '/images/ewallet/ovo.png',
            'dana' => '/images/ewallet/dana.png',
            'shopeepay' => '/images/ewallet/shopeepay.png',
        ];

        return $logos[strtolower($this->provider)] ?? '/images/banks/default.png';
    }
}
