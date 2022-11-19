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
}
