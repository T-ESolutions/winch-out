<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'target',
        'writer',
        'rate',
        'comment',
        'admin_approval',
        'reject_reason',
    ];

    public function target()
    {
        return $this->morphTo();
    }

    public function writer()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function scopeApproval($query)
    {
        return $query->where('admin_approval', 1);
    }
}
