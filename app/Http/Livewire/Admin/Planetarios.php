<?php

namespace App\Http\Livewire\Admin;

use App\Models\Planetario;
use Livewire\Component;

class Planetarios extends Component
{
    
    public $cantidad;

    public function render()
    {
        $planetarios = Planetario::all();
        return view('livewire.admin.planetarios', compact('planetarios'));
    }


    public function changeCantidad(Planetario $planetario, $cantidad)
    { 
        if($cantidad == "") {
            $cantidad = 0;
        }    
        $planetario->cantidad = $cantidad;   
        $planetario->save();
    }

}
