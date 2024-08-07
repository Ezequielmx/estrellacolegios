@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
<h1 style="padding:7px"><i class="fas fa-book-open"></i>&nbsp;&nbsp;Editar Usuario</h1>
<div class="card">
    <div class="card-body">

        {!! Form::model($user, ['route' => ['admin.usuarios.update', $user], 'method' => 'put']) !!}
        <div class="row">
            <div class="col-11">
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre']) !!}

                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-1">
                <div class="form-group text-center">
                    <label for="activo">Activo</label>
                    <input type="checkbox" class="form-control" name="activo" id="activo" value="1" @if($user->activo == 1) checked @endif>
                </div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el email']) !!}

            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col">
            <div class="form-group">
                {!! Form::label('celular', 'Celular') !!}
                {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Celular']) !!}

                @error('celular')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <p>Roles</p>
            @foreach ($roles as $role)
            <div>
                <label>
                    {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                    {{ $role->name }}
                </label>
            </div>
            @endforeach
        </div>

        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
        {!! Form::close() !!}
    </div>
</div>

@stop

@section('css')

<link rel="stylesheet" href="/css/admin.css">

@stop