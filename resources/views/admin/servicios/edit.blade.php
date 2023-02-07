@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-bullhorn"></i>&nbsp;&nbsp;Editar Servicio</h1>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                        <label>CUE</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->cue }}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre del establecimiento</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->nombre }}" disabled>
                    </div>
                   
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Domicilio</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->domicilio }}" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->tel }}" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Provincia</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->prov }}" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Departamento</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->depto }}" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Ciudad</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->ciudad }}" disabled>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                     <div class="form-group">
                        <label>Sector</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->sector }}" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Ambito</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->ambito }}" disabled>
                    </div>
                </div>
                    
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipo</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->tipo }}" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Niveles</label>
                        <input class="form-control" value="{{ $servicio->establecimiento()->first()->niveles }}" disabled>
                    </div>
                </div>
            </div>


        </div>
        <div class="card-body">
            {!! Form::model($servicio, ['route' => ['admin.servicios.update', $servicio], 'method' => 'put']) !!}
            
            @include('admin.servicios.partials.form')

                {!! Form::submit('Actualizar Servicio', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.servicios.index') }}"  class="btn btn-secondary">Cancelar</a>
                
            {!! Form::close() !!}
        </div>
    </div>

        
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop