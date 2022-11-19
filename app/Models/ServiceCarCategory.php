<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCarCategory extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function car_category()
    {
        return $this->belongsTo(CarCategory::class, 'car_category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function modell()
    {
        return $this->belongsTo(Modell::class, 'modell_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'service_car_category_id');
    }
}
