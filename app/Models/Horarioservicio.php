<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarioservicio extends Model
{
    protected $fillable= [
        'hora',
        'cantidad',
        'servicio_id',
        'tema_id'
    ];

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }
    
    use HasFactory;
}
