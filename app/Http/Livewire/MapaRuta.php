<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Linea;
use App\Services\obtenerRuta;



class MapaRuta extends Component
{
    public $lineaSeleccionada;
    public $lineas;
    public $fechaInicio;
    public $fechaFin;

    public $servicios;

    public function mount()
    {
        $this->lineas = Linea::where('activa', 1)->orderBy('nombre')->get();
    }

    public function render()
    {
        return view('livewire.mapa-ruta');
    }

    public function actualizarRuta()
    {
        $this->validate([
            'lineaSeleccionada' => 'required',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
        ]);


        if ($this->lineaSeleccionada) {
            $linea = Linea::find($this->lineaSeleccionada);
            $this->servicios = $linea->servicios->whereBetween('fecha_ini_serv', [$this->fechaInicio, $this->fechaFin])->whereNotIn('estado_id', [8, 10])->sortBy('fecha_ini_serv');

            $rutaService = new obtenerRuta($this->servicios);
            $data = $rutaService->obtenerDatosRuta();

            if (isset($data['ruta'])) {
                $ruta = $data['ruta'];
                $distancia = $data['distanciaTotalKm'];
                $ciudades = $data['ciudades'];
                $distanciasPorTramo = $data['distanciasPorTramo'];

                // Emitir evento a JavaScript
                $this->emit('rutaActualizada', [
                    'ruta' => $ruta,
                    'distancia' => $distancia,
                    'ciudades' => $ciudades,
                    'distanciasPorTramo' => $distanciasPorTramo
                ]);
            } else {
                $ruta = null;
                $distancia = null;
                $ciudades = null;
                $distanciasPorTramo = null;
            }
        }
    }
}
