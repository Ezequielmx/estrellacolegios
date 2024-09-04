@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    @livewire('mapa-ruta')
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
@stop