<?php

namespace App\Http\Livewire\Admin\Servicios;

use Livewire\Component;
use App\Models\Servicio;
use App\Models\Estado;
use App\Models\User;

class Index extends Component
{
    protected $listeners = ['deleteServicio', 'render'];

    public $servicios;
    public $servAct;

    public $mensAct = [];
    public $mensNew;

    public $showCaida = false;
    public $showFinal = false;
    public $showUnread = false;
    public $nombusq;
    public $filter = false;

    public $showModal = false;

    public $estados;
    public $asesores;
    public $asesorSel=0;
    public $estadoSel=-1;

    public function render()
    {
        //$this->mensAct = [];
        $this->dispatchBrowserEvent('hide-form');
        return view('livewire.admin.servicios.index');
    }

    public function updatedShowCaida(){
        $this->updShow();
    }

    public function updatedShowFinal(){
        $this->updShow();
    }

    public function updatedShowUnread(){
        $this->updShow();
    }

    public function updatedEstadoSel(){
        $this->updShow();
    }

    public function updatedAsesorSel(){
        $this->updShow();
    }

    public function updShow(){
        $this->nombusq = "";
        $this->servicios = Servicio::orderBy('fecha_ini_serv')
                            ->where('fecha_ini_serv','>=', '2023-01-01')
                            ->where('estado_id','>', 0)
                            ->get();
        
        if ($this->estadoSel != -1)
            $this->servicios = $this->servicios->where('estado_id','=', $this->estadoSel);

        if ($this->asesorSel != 0)
            $this->servicios = $this->servicios->where('asesor_id','=', $this->asesorSel);
        
        if (!$this->showCaida)
            $this->servicios = $this->servicios->where('estado_id','!=', 8);
        
        if (!$this->showFinal)
            $this->servicios = $this->servicios->where('estado_id','!=', 7)->where('estado_id','!=', 9);
        
        if ($this->showUnread)
            $this->servicios = $this->servicios->where('unreadwpp','=', 1);
    }

    public function showForm(Servicio $servicio)
    {
        $this->servAct = $servicio;
        $this->mensAct = [];
        
        
        foreach ($servicio->mensajes as $mensaje) {
            $this->mensAct[] = json_decode($mensaje->data);
        }

        //order array $this->mensAct by timestamp
        usort($this->mensAct, function( $elem1, $elem2 ) {
            return $elem1->timestamp <=> $elem2->timestamp;
        });

        $this->dispatchBrowserEvent('show-form');

        //$servicio->unreadwpp = 0;
        //$servicio->save();
        
    }

    public function mount()
    {
        //if user have permission to see all
        if (auth()->user()->can('Ver todos los Servicios')){
            $this->servicios = Servicio::orderBy('fecha_ini_serv')->get();
        }
        else{
            if (auth()->user()->hasRole('Vendedor')){
                $this->servicios = Servicio::where('vendedor_id', auth()->user()->id)->orderBy('fecha_ini_serv')->get();
            }
            elseif(auth()->user()->hasRole('Asesor')){
                $this->servicios = Servicio::where('asesor_id', auth()->user()->id)->orderBy('fecha_ini_serv')->get();
            }
            elseif(auth()->user()->hasRole('Instructor')){
                /**/;
            }
        }

        $this->estados = Estado::where('id','>', 0)->get();
        $this->servicios = $this->servicios->where('estado_id','<', 7);
        $this->servicios = $this->servicios->where('fecha_ini_serv','>=', '2023-01-01');
        $this->servicios = $this->servicios->where('estado_id','>', 0);
        $this->servAct = Servicio::first();
        $this->asesores = User::role('Asesor')->get();
        //asd;
    }

    public function marcLeidos(Servicio $servicio)
    {
        //dd($this->mensAct);
        $servicio->unreadwpp = !$servicio->unreadwpp;
        $servicio->save();

        //rerender component
        $this->mensAct = [];
        $this->emit('render');

    }


    public function busqNombre(){
        $this->servicios = Servicio::orderBy('fecha_ini_serv')->where('fecha_ini_serv','>=', '2023-01-01')->get();

        if ($this->nombusq=="")
            return;
            
        $this->servicios = $this->servicios->filter(function ($item) {
            //dd(stristr($item->establecimientos->first()->nombre, $this->nombusq));
            if($item->tipo == 1){
                return false !== stristr($item->establecimientos->first()->nombre, $this->nombusq);
            }
            else{
                return false !== stristr($item->lugar, $this->nombusq);
            }
        });

        //dd($this->servicios);
    }

    public function limpNombre(){
        $this->nombusq = "";
        $this->updShow();
    }

    public function deleteServicio(Servicio $servicio)
    {
        $servicio->delete();
        $this->emit('render');
    }

    public function duplicateServicio(Servicio $servicio)
    {
        $servDuplic = $servicio->replicate();
        $servDuplic->save();
        $establecimientosIds = $servicio->establecimientos->pluck('id')->toArray();
        $servDuplic->establecimientos()->sync($establecimientosIds);

        return redirect()->route('admin.servicios.edit', $servDuplic->id);
    }
}
