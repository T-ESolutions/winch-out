<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [''];

    const CANCEL = ['user', 'provider', 'admin'];

    protected $appends = ['status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function service_car_category()
    {
        return $this->belongsTo(ServiceCarCategory::class, 'service_car_category_id');
    }

    public function getStatusAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->status_ar;
        } else {
            return $this->status_en;
        }
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


    public function getBrandDataAttribute()
    {
        if ($this->attributes['brand_data'] != null) {
            return json_decode($this->attributes['brand_data']);
        }
        return "";
    }

    public function setBrandDataAttribute()
    {
        $this->attributes['brand_data'] = json_encode($this->attributes['brand_data']);
    }

    public function getModellDataAttribute()
    {
        if ($this->attributes['modell_data'] != null) {
            return json_decode($this->attributes['modell_data']);
        }
        return "";
    }

    public function setModellDataAttribute()
    {
        $this->attributes['modell_data'] = json_encode($this->attributes['modell_data']);
    }
}
