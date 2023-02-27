<?php

namespace App\Http\Livewire\Admin\Servicios;

use Livewire\Component;
use App\Models\Servicio;

class Index extends Component
{
    public $servicios;

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
}
