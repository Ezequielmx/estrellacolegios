<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'inicio',
        'fin',
        'color',
        'activa',
    ];

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

}
