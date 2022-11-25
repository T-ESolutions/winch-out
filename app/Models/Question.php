<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'type',
        'active',
        'service_id',
    ];

    //Enumeration values
    const TYPE = ['text', 'radio', 'checkbox', 'image'];

    protected $appends = ['title'];

    public function getTitleAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
