<?php

namespace App\Http\Livewire\Admin\Servicios;

use Livewire\Component;
use App\Models\Servicio;

class Index extends Component
{
    public $servicios;
    public $servAct;

    public $mensAct = [];

    public $showCaida = false;
    public $showFinal = false;

    public function render()
    {
        $this->servicios = Servicio::orderBy('fecha_ini_serv')->get();
        if (!$this->showCaida) {
            $this->servicios = $this->servicios->where('estado_id','!=', 7);
        }
        if (!$this->showFinal) {
            $this->servicios = $this->servicios->where('estado_id','!=', 6);
        }
        return view('livewire.admin.servicios.index');
    }

    public function showForm(Servicio $servicio)
    {
        $this->servAct = $servicio;
        $this->mensAct = [];
        $this->dispatchBrowserEvent('show-form');
        foreach ($servicio->mensajes as $mensaje) {
            $this->mensAct[] = json_decode($mensaje->data);
        }
        //order array $this->mensAct by timestamp
       
        usort($this->mensAct, function( $elem1, $elem2 ) {
            return $elem1->timestamp <=> $elem2->timestamp;
        });

        $servicio->unreadwpp = 0;
        $servicio->save();
        
    }

    public function mount()
    {
        $this->servAct = Servicio::first();
    }
}
