<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Servicio;
use Illuminate\Support\Carbon;
use App\Models\Linea;

class Grilla extends Component
{
    public $servicios;
    protected $meses = array();
    public $lineas;
    public $mesSel;

    public function render()
    {
        $fecha_ini = '2023-' . $this->mesSel . '-01';
        $fecha_fin = '2023-' . $this->mesSel . '-31';
        $this->lineas = Linea::conServiciosEntreFechas($fecha_ini, $fecha_fin)->orderBy('nombre')->get();

        $this->servicios = Servicio::whereBetween('fecha_ini_serv', [$fecha_ini, $fecha_fin])
            ->where('estado_id', '>', 0)->get();

        $this->meses = [];
            foreach ($this->servicios as $servicio) {
                $fecha_ini_serv = Carbon::parse($servicio->fecha_ini_serv);
                //$mes = $fecha_ini_serv->format('m');
                $dia = intval($fecha_ini_serv->format('d'));
                $linea_id = $servicio->linea_id;
                //$meses[$mes][$dia][$linea_id][] = $servicio;
                $this->meses[$dia][$linea_id][] = $servicio;
            }

        $meses = $this->meses;
        return view('livewire.admin.grilla', compact('meses'));
    }

    public function mount()
    {
        $this->lineas = Linea::all();
        $this->mesSel = Carbon::now()->format('m');
    }


}
