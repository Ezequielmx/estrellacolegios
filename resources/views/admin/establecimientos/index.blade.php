@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    <div style="display: flex; align-items: flex-end; justify-content: space-between;">
        <h1 style="padding:7px"><i class="fas fa-school"></i>&nbsp;&nbsp;Establecimientos</h1>
    <a href="{{ route('admin.establecimientos.create') }}" class="btn btn-primary mb-3">Nuevo Establecimiento</a>
    </div>
    
   
    <div class="card">
        @livewire('admin.establecimientos')
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop