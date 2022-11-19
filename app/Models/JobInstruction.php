<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInstruction extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $appends = ['title'];
    const TYPE = ['user', 'provider'];

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
}
