<?php

namespace App\Http\Livewire\Admin;

use App\Models\Planetario;
use Livewire\Component;

class Planetarios extends Component
{
    public $numero;
    public $tamaño;
    public $activo = true;
    public $observaciones;

    protected $rules = [
        'numero' => 'required',
        'tamaño' => 'required'
    ];

    protected $listeners = ['deletePlanetario'];

    public function render()
    {
        $planetarios = Planetario::all();
        return view('livewire.admin.planetarios', compact('planetarios'));
    }

    public function deletePlanetario(Planetario $planetario)
    {
        $planetario->delete();
    }

    public function changeNumero(Planetario $planetario, $numero)
    {
        $planetario->numero = $numero;
        $planetario->save();
    }

    public function changeTamaño(Planetario $planetario, $tamaño)
    {
        $planetario->tamaño = $tamaño;
        $planetario->save();
    }

    public function changeActivo(Planetario $planetario, $activo)
    {
        $planetario->activo = $activo;
        $planetario->save();
    }

    public function store()
    {
        $this->validate();

        Planetario::create([
            'numero' => $this->numero,
            'tamaño' => $this->tamaño,
            'activo' => $this->activo,
        ]);

    
        $this->reset(['numero', 'tamaño', 'activo', 'observaciones']);
    }




}
