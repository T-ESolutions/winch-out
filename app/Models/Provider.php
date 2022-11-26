<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Provider extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'country_code',
        'phone',
        'user_phone',
        'email_verified_at',
        'password',
        'rate',
        'social_id',
        'social_type',
        'image',
        'id_image',
        'drive_license_image',
        'car_license_image',
        'car_image',
        'active',
        'suspend',
        'available',
        'ios_deleted_at',
        'fcm_token',
        'status',
        'lat',
        'lng',
        'address',
        'parent_id',
        'in_job',
        'type',
        'app_percent',
    ];

    const STATUS = ['pending', 'accepted', 'rejected'];
    const TYPE = ['subscription', 'freelance'];

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    //image
    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/providers') . '/' . $image;
        }
        return asset('uploads/default.jpg');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'providers');
            $this->attributes['image'] = $imageFields;
        } else {
            $this->attributes['image'] = $image;
        }
    }

    //drive_license_image
    public function getDriveLicenseImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/providers/drive_license_images') . '/' . $image;
        }
        return asset('uploads/default.jpg');
    }

    public function setDriveLicenseImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'providers/drive_license_images');
            $this->attributes['drive_license_image'] = $imageFields;
        } else {
            $this->attributes['drive_license_image'] = $image;
        }
    }

    //car_license_image
    public function getCarLicenseImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/providers/car_license_image') . '/' . $image;
        }
        return asset('uploads/default.jpg');
    }

    public function setCarLicenseImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'providers/car_license_image');
            $this->attributes['car_license_image'] = $imageFields;
        } else {
            $this->attributes['car_license_image'] = $image;
        }
    }

    //car_image
    public function getCarImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/providers/car_image') . '/' . $image;
        }
        return asset('uploads/default.jpg');
    }

    public function setCarImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'providers/car_image');
            $this->attributes['car_image'] = $imageFields;
        } else {
            $this->attributes['car_image'] = $image;
        }
    }

    public function getJWTIdentifier()
    {
        // Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        // Implement getJWTCustomClaims() method.
        //return [];
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeSuspend($query)
    {
        return $query->where('suspend', 1);
    }

    public function scopeAvailable($query)
    {
        return $query->where('active', 1);
    }

    public function scopeInjob($query)
    {
        return $query->where('in_job', 1);
    }

    public function parent()
    {
        return $this->belongsTo(Provider::class, 'parent_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'provider_id');
    }


    public function reviewsReached()
    {
        return $this->morphMany(OrderReview::class, 'target')->approval();
    }

    public function reviewsWriter()
    {
        return $this->morphMany(OrderReview::class, 'writer')->approval();
    }

    public function contact()
    {
        return $this->morphMany(ContactUs::class, 'writer');
    }
}
