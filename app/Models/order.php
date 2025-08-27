<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HasFactory;

class Order extends Model
{
    protected $fillable = [
        'user_id', 
        'first_name', 
        'last_name', 
        'email', 
        'phone',
        'street', 
        'apartment', 
        'city', 
        'notes', 
        'shipping', 
        'total', 
        'status',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function promoCode() {
    return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}

