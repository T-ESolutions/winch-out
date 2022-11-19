<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderExtraService extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function scopeApproval($query)
    {
//        0=>rejected | 1=>accepted
        return $query->where('user_approval', 1);
    }

}
