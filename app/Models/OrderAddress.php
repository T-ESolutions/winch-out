<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'pickup_lat',
        'pickup_lng',
        'pickup_address',
        'drop_off_lat',
        'drop_off_lng',
        'drop_off_address',
        'provider_lat',
        'provider_lng',
        'provider_address',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
