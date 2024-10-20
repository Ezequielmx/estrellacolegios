@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
<div style="position: sticky; top: 65px; margin-left: -40px; z-index:5 ">
    <a style="width: 30px; height: 30px; padding: 0;" class="btn btn-secondary rounded-circle position-absolute"
        data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
        aria-controls="collapseExample">
        <i class="fa fa-info" style="font-size: 10px;"></i>
    </a>
</div>

<div class="collapse" id="collapseExample">


    <div class="leyenda_lineas">
        <div class="card">
            <div class="card-body" style="padding: 10px; box-shadow: 0 0 10px #5f5f5f;">
                <div class="row">
                    <div class="col">
                        <div class="color" style="background-color: white; color:#363636; border: 1px solid rgb(141, 141, 141)">
                            ⭕ Grande
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="color" style="background-color: white; color:#363636; border: 1px solid rgb(141, 141, 141)">
                            ❌ Mediano
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="color" style="background-color: white; color:#363636; border: 1px solid rgb(141, 141, 141)">
                            ❗ Chico
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="leyenda_estados">
        <div class="card">
            <div class="card-body" style="padding: 10px; box-shadow: 0 0 10px #5f5f5f;">
                <div class="row">
                    <div class="col ley_est">VENDIDO </div>
                    <div class="col" style="max-width: 30px; padding-left:0">
                        <div class="estado_color" style="background-color:  #ffffff; color:  #ffffff; padding:5px">.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col ley_est">WPP ENVIADO </div>
                    <div class="col" style="max-width: 30px; padding-left:0">
                        <div class="estado_color" style="background-color:  #f0f182; color:  #f0f182; padding:5px">.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col ley_est">WPP CONFIRM </div>
                    <div class="col" style="max-width: 30px; padding-left:0">
                        <div class="estado_color" style="background-color:  #82f1eb; color:  #82f1eb; padding:5px">.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col ley_est">WPP LLAMAR </div>
                    <div class="col" style="max-width: 30px; padding-left:0">
                        <div class="estado_color" style="background-color:  #f59a5d; color:  #f59a5d; padding:5px">.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col ley_est">CONFIRMADO</div>
                    <div class="col" style="max-width: 30px; padding-left:0">
                        <div class="estado_color" style="background-color:  #8bd475; color:  #8bd475; padding:5px">.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col ley_est">LISTO</div>
                    <div class="col" style="max-width: 30px; padding-left:0">
                        <div class="estado_color" style="background-color:  #0099ff; color:  #0099ff; padding:5px">.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col ley_est">REALIZADO</div>
                    <div class="col" style="max-width: 30px; padding-left:0">
                        <div class="estado_color" style="background-color:  #047a31; color:  047a31; padding:5px">.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col ley_est" >CAIDA</div>
                    <div class="col" style="max-width: 30px; padding-left:0">
                        <div class="estado_color" style="background-color:  #da4343; color:  #da4343; padding:5px">.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>@livewire('admin.grilla')</div>

@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@stop

