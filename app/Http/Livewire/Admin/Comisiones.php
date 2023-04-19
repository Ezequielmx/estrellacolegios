<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Comisione;
use App\Models\Servicioubicacione;
use Spatie\Permission\Models\Role;

class Comisiones extends Component
{
    public $comisiones;
    public $roles;
    public $ubicaciones;

    public function render()
    {
        $this->comisiones = Comisione::all();
        return view('livewire.admin.comisiones');
    }

    public function mount(){
        $this->roles = Role::all();
        $this->ubicaciones = Servicioubicacione::all();   

    }

    public function changeComision(Comisione $comision , $field, $value){
        if($value==""){
            $value = null;
        }

        $comision->$field = $value;
        $comision->save();
    }
}
