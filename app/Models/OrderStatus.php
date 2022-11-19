<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $guarded=[''];
    protected $appends = ['status'];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getStatusAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->status_ar;
        } else {
            return $this->status_en;
        }
    }

}
