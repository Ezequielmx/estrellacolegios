@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')

    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    

    <div style="display: flex; justify-content: space-between; align-items:center">
        <h1 style="padding:7px"><i class="fas fa-truck"></i>&nbsp;&nbsp;Servicios</h1>
        <div>
            <a class="btn btn-success btn-sm" href="{{ route('admin.servicios.create', ['serv_tipo' => 2]) }}">Nuevo Evento Pago</a>
            <a class="btn btn-danger btn-sm" href="{{ route('admin.servicios.create', ['serv_tipo' => 3]) }}">Nuevo Evento al Cobro</a>
        </div>
    </div>
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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('deleteServ', servicioId =>{
                Swal.fire({
                    title: 'Está seguro que desea eliminar el Servicio?',
                    text: "No se puede revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Si. Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteServicio', servicioId);
                        Swal.fire(
                        'Eliminado!',
                        'El servicio ha sido eliminado.',
                        'success'
                        )
                    }
                })  
            });
            
    </script>
@stop


