<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReview extends Model
{
    use HasFactory;
    protected $guarded=[''];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function scopeApproval($query)
    {
        return $query->where('admin_approval', 1);
    }
}
