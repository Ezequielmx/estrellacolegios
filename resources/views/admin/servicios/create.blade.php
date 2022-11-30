@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-bullhorn"></i>&nbsp;&nbsp;Crear Servicio</h1>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                        <label>CUE</label>
                        <input class="form-control" value="{{ $establecimiento->cue }}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre del establecimiento</label>
                        <input class="form-control" value="{{ $establecimiento->nombre }}" disabled>
                    </div>
                   
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Domicilio</label>
                        <input class="form-control" value="{{ $establecimiento->domicilio }}" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input class="form-control" value="{{ $establecimiento->tel }}" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Provincia</label>
                        <input class="form-control" value="{{ $establecimiento->prov }}" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Departamento</label>
                        <input class="form-control" value="{{ $establecimiento->depto }}" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Ciudad</label>
                        <input class="form-control" value="{{ $establecimiento->ciudad }}" disabled>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                     <div class="form-group">
                        <label>Sector</label>
                        <input class="form-control" value="{{ $establecimiento->sector }}" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Ambito</label>
                        <input class="form-control" value="{{ $establecimiento->ambito }}" disabled>
                    </div>
                </div>
                    
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipo</label>
                        <input class="form-control" value="{{ $establecimiento->tipo }}" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Niveles</label>
                        <input class="form-control" value="{{ $establecimiento->niveles }}" disabled>
                    </div>
                </div>
            </div>



            

           

         


        </div>
        <div class="card-body">
            {!! Form::open(['route' =>'admin.servicios.store']) !!}
            
            @include('admin.servicios.partials.form')

                {!! Form::submit('Crear Servicio', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.servicios.index') }}"  class="btn btn-secondary">Cancelar</a>
                
            {!! Form::close() !!}
        </div>
    </div>

        
@stop