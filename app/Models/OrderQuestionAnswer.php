<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_question_id',
        'answer',
        'type',
        'provider_approval',
        'reject_reason',
    ];
    const TYPE = ['text', 'radio', 'checkbox', 'image'];

    public function order_question()
    {
        return $this->belongsTo(OrderQuestion::class, 'order_question_id');
    }

    public function scopeApproval($query)
    {
        return $query->where('provider_approval', 1);
    }
}
