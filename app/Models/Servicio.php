<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    public function establecimientos(){
        return $this->belongsToMany('App\Models\Establecimiento');
    }

    public function personal(){
        return $this->belongsToMany('App\Models\User')
                    ->withPivot('role_id');
    }

    public function horarios(){
        return $this->hasMany('App\Models\Horarioservicio');
    }

    public function asesor(){
        return $this->belongsTo('App\Models\User', 'asesor_id');
    }

    public function vendedor(){
        return $this->belongsTo('App\Models\User', 'vendedor_id');
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

    public function linea(){
        return $this->belongsTo('App\Models\Linea');
    }

    public function mensajes(){
        return $this->hasMany('App\Models\Mensaje');
    }

}
