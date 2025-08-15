<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RedeemedPromoCode extends Model
{
    use HasFactory;

    protected $table = 'redeemed_promocodes';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'promocode_id',
        'redeemed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promocode_id');
    }
}
