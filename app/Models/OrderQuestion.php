<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'title_ar',
        'title_en',
        'type',
        'service_id',
        'service_data',
    ];

    protected $appends = ['title'];

    public function getTitleAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
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
