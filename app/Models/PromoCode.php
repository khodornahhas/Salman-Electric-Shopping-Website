<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoCode extends Model
{
    use HasFactory;
    protected $table = 'promocodes';
    protected $fillable = ['code', 'discount_percent', 'expires_at'];
    protected $casts = ['expires_at' => 'datetime',];
    
    public function products()
{
    return $this->belongsToMany(Product::class, 'product_promocode', 'promocode_id', 'product_id');
}

    public function users(){
        return $this->belongsToMany(User::class, 'redeemed_promocodes', 'promocode_id', 'user_id');

    }
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class, 'promo_code_id');
    }

    public static function generateCode($length = 8){
        return strtoupper(substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, $length));
    }
}

