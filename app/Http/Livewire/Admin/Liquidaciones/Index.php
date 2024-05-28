<?php

namespace App\Http\Livewire\Admin\Liquidaciones;

use Livewire\Component;
use App\Models\User;
use App\Models\Comisione;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;


class Index extends Component
{
    public $users;
    public $userId;
    public $desde;
    public $hasta;

    public $vales = [];

    public $totalFrentes;
    public $totalFichas;
    public $totalDoble;
    public $totalTriple;
    public $totalVales;
    public $totalPluses;

    public $dias_trab;
    public $dias_libres;
    public $dias_viaje;
    public $dias_cancelados;

    public $liquidaciondetalles=[];

    public function mount()
    {
        $this->users = User::role(['asesor', 'instructor','instructor nuevo', 'cobrador'])->where('activo',1)->orderBy('name')->get();
        $this->desde = date('Y-m-01');
        $this->hasta = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.admin.liquidaciones.index');
    }

    public function generarLiqui()
    {
        $servicios = User::find($this->userId)->servicios()->where('fecha_ini_serv', '>=', $this->desde)->where('fecha_ini_serv', '<=', $this->hasta)->orderBy('fecha_ini_serv')->get();
        $pluses = User::find($this->userId)->pluses()->where('fecha', '>=', $this->desde)->where('fecha', '<=', $this->hasta)->get();
        $vales = User::find($this->userId)->vales()->where('fecha', '>=', $this->desde)->where('fecha', '<=', $this->hasta)->get();
        $this->vales = $vales;

        //create a array of liquidaciondetalle
        $liquidaciondetalles = [];
        foreach ($servicios as $servicio) {
            //dd($servicio);
            $servicioubicacione_id = $servicio->linea->servicioubicacione_id;
            $tiposervicio_id = $servicio->tipo;
            $role_id = $servicio->pivot->role_id;
            //dd($servicio->pivot);

            $fecha_ini = Carbon::parse($servicio->fecha_ini_serv);
            $dias = $fecha_ini->diffInDays($servicio->fecha_fin_serv);

            if ($servicio->estado_id != 7 && $servicio->estado_id != 9) {
                continue;
            }

            for ($i = 0; $i <= $dias; $i++) {
                $fecha = $i==0? $fecha_ini->format('Y-m-d') : $fecha_ini->addDays()->format('Y-m-d');
                if ($tiposervicio_id == 1) {
                    $frente = Comisione::where('role_id', $role_id)->where('servicioubicacione_id', $servicioubicacione_id)->first()->colegio_frente;
                    $ficha = Comisione::where('role_id', $role_id)->where('servicioubicacione_id', $servicioubicacione_id)->first()->colegio_ficha;
                } elseif ($tiposervicio_id == 2) {
                    if(date('w', strtotime(date($fecha)))==0 || date('w', strtotime(date($fecha)))==6){
                        $frente = Comisione::where('role_id', $role_id)->where('servicioubicacione_id', $servicioubicacione_id)->first()->evento_frente;
                        $ficha = Comisione::where('role_id', $role_id)->where('servicioubicacione_id', $servicioubicacione_id)->first()->evento_ficha;
                    }else{
                        $frente = Comisione::where('role_id', $role_id)->where('servicioubicacione_id', $servicioubicacione_id)->first()->colegio_frente;
                        $ficha = Comisione::where('role_id', $role_id)->where('servicioubicacione_id', $servicioubicacione_id)->first()->colegio_ficha;
                    }
                }
                else{
                    //dd($role_id, $servicioubicacione_id);
                    $frente = Comisione::where('role_id', $role_id)->where('servicioubicacione_id', $servicioubicacione_id)->first()->evento_frente;
                    $ficha = Comisione::where('role_id', $role_id)->where('servicioubicacione_id', $servicioubicacione_id)->first()->evento_ficha;
                }


                $liquidaciondetalles[] = [
                    'servicio' => $servicio,
                    'fecha' => $fecha,
                    'puesto' => Role::find($role_id),
                    'frente' => $frente,
                    'ficha' => $ficha,
                    'plus_doble_serv' => 0,
                    'plus_triple_serv' => 0,
                    'tipo' => 'servicio'
                ];
            }
        }
        //order the array by fecha
        usort($liquidaciondetalles, function ($a, $b) {
            return $a['fecha'] <=> $b['fecha'];
        });

        $plus_doble = Comisione::first()->servicio_doble;
        $plus_triple = Comisione::first()->servicio_triple;
        $fechaCont = '';
        $cont_serv = 0;
        for($i=0; $i<count($liquidaciondetalles); $i++) {
            if($fechaCont != $liquidaciondetalles[$i]['fecha']){
                if($cont_serv==2){
                    //set plus_doble_serv=500 in the previous liquidaciondetalle
                    $liquidaciondetalles[$i-1]['plus_doble_serv']=$plus_doble;
                }elseif($cont_serv==3){
                    //set plus_triple_serv=1000 in the previous liquidaciondetalle
                    $liquidaciondetalles[$i-1]['plus_triple_serv']=$plus_triple;
                }
                $fechaCont = $liquidaciondetalles[$i]['fecha'];
                $cont_serv = 1;
            }
            else{
                $cont_serv++;  
            }
        }

        foreach($pluses as $plus)
        {
            if($plus->tipo->id == 4){
                $frente = 0;
                $ficha = $plus->monto;
            }else{
                $frente = $plus->monto;
                $ficha = 0;
            }
            $liquidaciondetalles[] = [
                'servicio' => $plus,
                'fecha' => $plus->fecha,
                'puesto' => null,
                'frente' => $frente,
                'ficha' => $ficha,
                'plus_doble_serv' => 0,
                'plus_triple_serv' => 0,
                'tipo' => 'plus'
            ];
        }

        usort($liquidaciondetalles, function ($a, $b) {
            return $a['fecha'] <=> $b['fecha'];
        });

        // $this->totalFrentes sum all the frentes of the liquidaciondetalles
        $this->totalFrentes = array_sum(array_column($liquidaciondetalles, 'frente'));
        $this->totalFichas = array_sum(array_column($liquidaciondetalles, 'ficha'));
        $this->totalDoble = array_sum(array_column($liquidaciondetalles, 'plus_doble_serv'));
        $this->totalTriple = array_sum(array_column($liquidaciondetalles, 'plus_triple_serv'));
        $this->totalVales = $vales->sum('monto');
        $this->totalPluses = $pluses->sum('monto');

        // count distinct fechas on liquidaciondetalles
        $this->dias_trab = count(array_unique(array_column($liquidaciondetalles, 'fecha')));

        // count of liquidaciondetalles if tipo='plus' and servicio->tipo->tipo = 'Día Libre'
        $this->dias_libres = 0;
        $this->dias_viaje = 0;
        $this->dias_cancelados = 0;
        foreach($liquidaciondetalles as $liquidaciondetalle)
        {
            if($liquidaciondetalle['tipo']=='plus' && $liquidaciondetalle['servicio']->tipo->id == 1)
            {
                $this->dias_libres++;
            }

            if($liquidaciondetalle['tipo']=='plus' && $liquidaciondetalle['servicio']->tipo->id == 2)
            {
                $this->dias_viaje++;
            }

            if($liquidaciondetalle['tipo']=='plus' && $liquidaciondetalle['servicio']->tipo->id == 3)
            {
                $this->dias_cancelados++;
            }
        }
        $this->liquidaciondetalles = $liquidaciondetalles;
    } 
}
