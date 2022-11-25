<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModellYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'modell_id',
        'year',
    ];
    public function modell()
    {
        return $this->belongsTo(Modell::class, 'modell_id');
    }

}
