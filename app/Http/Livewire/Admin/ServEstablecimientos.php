<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Servicio;
use App\Models\Establecimiento;

class ServEstablecimientos extends Component
{
    public $servicio;

    public $cueNew;
    public $nombreNew;
    public $provinciaNew;
    public $deptoNew;
    public $localidadNew;

    public $validCue;
    public $idNew;


    protected $listeners = ['deleteEst', 'refreshComponent' => '$refresh'];

    public function mount(Servicio $servicio)
    {
        $this->servicio=$servicio;
    }


    public function render()
    {
        return view('livewire.admin.serv-establecimientos');
    }

    public function buscCue()
    {

        $estNew = Establecimiento::where('cue', $this->cueNew)->first();

        if ($estNew) {
            $this->validCue = true;
            $this->idNew = $estNew->id;
            $this->nombreNew = $estNew->nombre;
            $this->provinciaNew = $estNew->prov;
            $this->deptoNew = $estNew->depto;
            $this->localidadNew = $estNew->ciudad;
        } else {
            $this->validCue = false;
            $this->idNew = null;
            $this->nombreNew = 'No encontrado';
            $this->provinciaNew = 'No encontrado';
            $this->deptoNew = 'No encontrado';
            $this->localidadNew = 'No encontrado';
        }
    }

    public function agregar()
    {
        $this->servicio->establecimientos()->attach($this->idNew);
        
        $this->cueNew = null;
        $this->nombreNew = null;
        $this->provinciaNew = null;
        $this->deptoNew = null;
        $this->localidadNew = null;
        $this->validCue = false;
        $this->idNew = null;

        $this->emit('refreshComponent');
    }

    public function deleteEst($id)
    {
        $this->servicio->establecimientos()->detach($id);
        $this->emit('refreshComponent');

    }
}
