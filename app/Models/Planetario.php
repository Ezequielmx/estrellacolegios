<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planetario extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'tamaño',
        'activo',
    ];

    public function servicios(){
        return $this->hasMany('App\Models\Servicio');
    }
}
