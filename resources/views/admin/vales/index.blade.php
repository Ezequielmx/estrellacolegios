@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
<h1 style="padding:7px"><i class="fas fa-file-invoice-dollar"></i> </i>&nbsp;&nbsp;Vales - Pluses</h1>

<div class="row">
    <div class="col">
        @livewire('admin.vales')
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
<!-- boostrap 5 cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"></script>
<!-- boostrap 5 cdn -->
@stop

