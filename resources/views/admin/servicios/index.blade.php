@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')

    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    <h1 style="padding:7px"><i class="fas fa-truck"></i>&nbsp;&nbsp;Servicios</h1>
    @livewire('admin.servicios.index')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        window.addEventListener('show-form', event => {
            $('#form').modal('show');
        });
    </script>
@stop
