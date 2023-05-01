<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Servicio;
use Carbon\Carbon;

class Ventas extends Component
{
    public $servicios;
    public $filtro = 'hoy';
    public $cantidad;

    public function render()
    {
        switch ($this->filtro) {
            case 'hoy':
                $servicios = Servicio::whereDate('fecha_venta', Carbon::today())->get();
                break;
            case 'ayer':
                $servicios = Servicio::whereDate('fecha_venta', Carbon::yesterday())->get();
                break;
            case 'ultima_semana':
                $servicios = Servicio::where('fecha_venta', '>=', Carbon::now()->subWeek())->get();
                break;
            case 'ultimo_mes':
                $servicios = Servicio::where('fecha_venta', '>=', Carbon::now()->subMonth())->get();
                break;
            case 'ultimo_anio':
                $servicios = Servicio::where('fecha_venta', '>=', Carbon::now()->subYear())->get();
                break;
            default:
                $servicios = Servicio::all();
                break;
        }

        $this->servicios = $servicios->sortBy('vendedor_id')->sortBy('date');
        $this->cantidad = $servicios->count();
        return view('livewire.admin.ventas');
    }
}
