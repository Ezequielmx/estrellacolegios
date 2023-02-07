@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    <h1 style="padding:7px"><i class="fas fa-school"></i>&nbsp;&nbsp;Establecimientos</h1>
   
    <div class="card">
        @livewire('admin.establecimientos')
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop