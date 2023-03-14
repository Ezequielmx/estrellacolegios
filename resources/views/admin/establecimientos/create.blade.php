@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-school"></i>&nbsp;&nbsp;Nuevo Establecimiento</h1>
   
    @livewire('admin.new-establecimiento')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop