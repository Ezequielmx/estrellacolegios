@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-igloo"></i> </i>&nbsp;&nbsp;Planetarios</h1>
    <div class="row">
        <div class="col-md-3">
            @livewire('admin.planetarios')
        </div>
    </div>
        
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

