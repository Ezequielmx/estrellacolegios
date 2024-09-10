<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Comisione;
use App\Models\Servicioubicacione;
use Spatie\Permission\Models\Role;

class Comisionesb extends Component
{
    public $comisiones;
    public $roles;
    public $ubicaciones;

    public $editing_id;
    public $role_id;
    public $servicioubicacione_id;
    public $colegio_frente;
    public $colegio_ficha;
    public $plus_sin_ayudante;
    public $servicio_doble;
    public $servicio_triple;
    public $evento_frente;
    public $evento_ficha;
    public $servicio_suspendido;
    public $dia_libre;
    public $dia_viaje;


    public function render()
    {
        $this->comisiones = Comisione::all();
        return view('livewire.admin.comisionesb');
    }

    public function mount(){
        $this->roles = Role::all();
        $this->ubicaciones = Servicioubicacione::all();   

    }

    public function editClose(){
        $this->editing_id = null;
    }

    public function editing(Comisione $comision){
        $this->editing_id = $comision->id;
        $this->role_id = $comision->role_id;
        $this->servicioubicacione_id = $comision->servicioubicacione_id;
        $this->colegio_frente = $comision->colegio_frente;
        $this->colegio_ficha = $comision->colegio_ficha;
        $this->servicio_doble = $comision->servicio_doble;
        $this->servicio_triple = $comision->servicio_triple;
        $this->evento_frente = $comision->evento_frente;
        $this->evento_ficha = $comision->evento_ficha;
        $this->plus_sin_ayudante = $comision->plus_sin_ayudante;
        $this->servicio_suspendido = $comision->servicio_suspendido;
        $this->dia_libre = $comision->dia_libre;
        $this->dia_viaje = $comision->dia_viaje;
    }

    public function updateComision(){
        $this->validate([
            'role_id' => 'required',
            'servicioubicacione_id' => 'required'
        ]);

        $comision = Comisione::find($this->editing_id);
        $comision->role_id = $this->role_id;
        $comision->servicioubicacione_id = $this->servicioubicacione_id;
        $comision->colegio_frente = $this->colegio_frente=="" ? null : $this->colegio_frente;
        $comision->colegio_ficha = $this->colegio_ficha=="" ? null : $this->colegio_ficha;
        $comision->servicio_doble = $this->servicio_doble=="" ? null : $this->servicio_doble;
        $comision->servicio_triple = $this->servicio_triple=="" ? null : $this->servicio_triple;
        $comision->evento_frente = $this->evento_frente=="" ? null : $this->evento_frente;
        $comision->evento_ficha = $this->evento_ficha=="" ? null : $this->evento_ficha;
        $comision->plus_sin_ayudante = $this->plus_sin_ayudante=="" ? null : $this->plus_sin_ayudante;
        $comision->servicio_suspendido = $this->servicio_suspendido=="" ? null : $this->servicio_suspendido;
        $comision->dia_libre = $this->dia_libre=="" ? null : $this->dia_libre;
        $comision->dia_viaje = $this->dia_viaje=="" ? null : $this->dia_viaje;
        $comision->save();

        $this->editClose();
    }



    public function changeComision(Comisione $comision , $field, $value){
        if($value==""){
            $value = null;
        }

        $comision->$field = $value;
        $comision->save();
    }
}
