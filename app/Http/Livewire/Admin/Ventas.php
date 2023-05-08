<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Servicio;
use Carbon\Carbon;
use App\Services\aprobVentaAviso;

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

        
        if (auth()->user()->hasAnyRole(['Super Admin', 'Administrador', 'Usuario Administrativo'])){
            $this->servicios = $servicios->sortBy('vendedor_id')->sortBy('fecha_venta');
        }
        else{
            $this->servicios = $servicios->where('vendedor_id', auth()->user()->id)->sortBy('fecha_venta');
        }

        //$this->servicios = $servicios->sortBy('vendedor_id')->sortBy('fecha_venta');
        $this->cantidad = $this->servicios->count();
        return view('livewire.admin.ventas');
    }

    public function aprobarVenta(Servicio $servicio)
    {
        $servicio->update([
            'estado_id' => '1',
            'asesor_id' => '13'
        ]);

        new aprobVentaAviso($servicio);
    }
}
