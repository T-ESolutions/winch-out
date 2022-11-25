<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderExtraService extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'service_id',
        'service_data',
        'name',
        'price',
        'user_approval',
        'reject_reason',
    ];

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


    public function getServiceDataAttribute()
    {
        if ($this->attributes['service_data'] != null) {
            return json_decode($this->attributes['service_data']);
        }
        return "";
    }

    public function setServiceDataAttribute()
    {
        $this->attributes['service_data'] = json_encode($this->attributes['service_data']);
    }
}
