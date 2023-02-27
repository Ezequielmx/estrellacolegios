@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
<h1 style="padding:7px"><i class="fas fa-igloo"></i> </i>&nbsp;&nbsp;Líneas</h1>
<div class="row">
    <div class="col">
        @livewire('admin.lineas')
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('deleteLin', lineaId =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar la Línea?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteLinea', lineaId);
                    Swal.fire(
                    'Eliminado!',
                    'la Línea ha sido eliminada.',
                    'success'
                    )
                }
            })  
        });
        
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js">
</script>
<script>
    $('.colorpicker').colorpicker();
</script>


@stop