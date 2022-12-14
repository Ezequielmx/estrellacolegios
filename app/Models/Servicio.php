<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    public function establecimiento(){
        return $this->belongsTo('App\Models\Establecimiento');
    }

    public function asesor(){
        return $this->belongsTo('App\Models\Asesore');
    }

    public function planetario(){
        return $this->belongsTo('App\Models\Planetario');
    }

    public function estado(){
        return $this->belongsTo('App\Models\Estado');
    }

    public function espacio(){
        return $this->belongsTo('App\Models\Espacio');
    }

}
