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
        return $this->belongsTo('App\Models\Espacio', 'espacio_montaje');
    }

    public function tamano(){
        return $this->belongsTo('App\Models\Tamano');
    }

    public function linea(){
        return $this->belongsTo('App\Models\Linea');
    }

    public function mensajes(){
        return $this->hasMany('App\Models\Mensaje');
    }

    public function cobradoTxt(){
        return $this->numero_a_texto($this->cobrado);
        return $this->cobrado;
    }

    function numero_a_texto($numero) {
        $unidades = array("", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve");
        $decenas = array("", "diez", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa");
        $especiales = array("once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve");
        $centenas = array("", "ciento", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos");
     
        if ($numero == 0) {
            return "cero";
        } else if ($numero < 0) {
            return "menos " . $this->numero_a_texto(abs($numero));
        }
     
        $texto = "";
     
        if (($numero / 1000) >= 1) {
            $texto .= $this->numero_a_texto(floor($numero / 1000)) . " mil ";
            $numero %= 1000;
        }
     
        if (($numero / 100) >= 1) {
            $texto .= $centenas[floor($numero / 100)] . " ";
            $numero %= 100;
        }
     
        if (($numero / 10) >= 1) {
            if ($numero >= 11 && $numero <= 19) {
                $texto .= $especiales[$numero - 11] . " ";
                return $texto;
            } else if ($numero % 10 == 0) {
                $texto .= $decenas[$numero / 10] . " ";
                return $texto;
            } else {
                $texto .= $decenas[floor($numero / 10)] . " y ";
                $numero %= 10;
            }
        }
     
        if ($numero > 0) {
            $texto .= $unidades[$numero];
        }
     
        return trim($texto);
    }
    

}
