@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
<h1 style="padding:7px"><i class="fas fa-igloo"></i> </i>&nbsp;&nbsp;Ventas</h1>
<div class="row">
    <div class="col">
        @livewire('admin.ventas')
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@stop

