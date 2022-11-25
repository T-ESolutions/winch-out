<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProviderRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'provider_id',
        'status',
    ];
    const STATUS = ['pending', 'accepted', 'rejected'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
