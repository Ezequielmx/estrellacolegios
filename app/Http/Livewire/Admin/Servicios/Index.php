<?php

namespace App\Http\Livewire\Admin\Servicios;

use Livewire\Component;
use App\Models\Servicio;
use App\Services\simpleMensWpp;

class Index extends Component
{
    protected $listeners = ['deleteServicio'];

    public $servicios;
    public $servAct;

    public $mensAct = [];
    public $mensNew;

    public $showCaida = false;
    public $showFinal = false;
    public $showUnread = false;
    public $nombusq;
    public $filter = false;

    public function render()
    {
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

    public function updShow(){
        $this->nombusq = "";
        $this->servicios = Servicio::orderBy('fecha_ini_serv')->get();
        
        if (!$this->showCaida)
            $this->servicios = $this->servicios->where('estado_id','!=', 8);
        
        if (!$this->showFinal)
            $this->servicios = $this->servicios->where('estado_id','!=', 7);
        
        if ($this->showUnread)
            $this->servicios = $this->servicios->where('unreadwpp','=', 1);
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
        $this->servicios = Servicio::orderBy('fecha_ini_serv')->get();
        $this->servicios = $this->servicios->where('estado_id','!=', 8);
        $this->servicios = $this->servicios->where('estado_id','!=', 7);
        $this->servAct = Servicio::first();
    }

    public function sendMsj()
    {
        
        $this->showForm($this->servAct);
        $res = new simpleMensWpp($this->servAct->cel_cont_1, $this->mensNew);
    }

    public function busqNombre(){
        $this->servicios = Servicio::orderBy('fecha_ini_serv')->get();

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
    }
}