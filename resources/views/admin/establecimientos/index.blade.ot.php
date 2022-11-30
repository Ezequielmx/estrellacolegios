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
            <div class="card-header">
                <a href="{{ route('admin.establecimientos.create') }}" class="btn btn-primary">Agregar Establecimiento</a>    
            </div> 

            <div class="card-body">
                <div class="table-responsive">
                    <table id="establec" class="table table-striped">
                    <thead>
                        <tr>
                            <th>CUE</th>
                            <th>Nombre</th>
                            <th>Domicilio</th>
                            <th>Cod_Area</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Provincia</th>
                            <th>Departamento</th>
                            <th>Ciudad</th>
                            <th>Sector</th>
                            <th>Ámbito</th>
                            <th >Tipo</th>
                            <th>Niveles</th>
                            <th ></th>
                            <th ></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>CUE</th>
                            <th class="forBusq">Nombre</th>
                            <th class="forBusq">Domicilio</th>
                            <th class="forBusq">Cod_Area</th>
                            <th class="forBusq">Teléfono</th>
                            <th class="forBusq">Email</th>
                            <th class="forSelect">Provincia</th>
                            <th class="forSelect">Departamento</th>
                            <th class="forSelect">Ciudad</th>
                            <th>Sector</th>
                            <th>Ámbito</th>
                            <th>Tipo</th>
                            <th>Niveles</th>
                        </tr>
                    </tfoot>
                </table>

                </div>
            </div>
        </div>   
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"> 
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
         $(document).ready(function () {
            $('#establec').DataTable({
                ajax: "{{ route('admin.establecimientos.index') }}",
                columns: [{
                        "data": "cue",
                        "name": "cue"
                    },
                    {
                        "data": "nombre",
                        "name": "nombre"
                    },
                    				 {
                        data: 'domicilio',
                        name: 'domicilio'
                    },
                    {
                        data: 'cod_area',
                        name: 'cod_area'
                    },
                    {
                        data: 'tel',
                        name: 'tel'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'prov',
                        name: 'prov'
                    },
                    {
                        data: 'depto',
                        name: 'depto'
                    },
                    {
                        data: 'ciudad',
                        name: 'ciudad'
                    },
                    {
                        data: 'sector',
                        name: 'sector'
                    },
                    {
                        data: 'ambito',
                        name: 'ambito'
                    },
                    {
                        data: 'tipo',
                        name: 'tipo'
                    },
                    {
                        data: 'niveles',
                        name: 'niveles'
                    }],

                    initComplete: function () {
                        // Apply the search
                        this.api()
                            .columns()
                            .every(function () {
                                var that = this;
                                $('input', this.footer()).on('keyup change clear', function () {
                                    if (that.search() !== this.value) {
                                        that.search(this.value).draw();
                                    }
                                });
                            });

                            var r = $('#establec tfoot tr');
                            r.find('th').each(function(){
                                $(this).css('padding', 8);
                            });
                            $('#establec thead').append(r);
                            $('#search_0').css('text-align', 'center');

                            

                        }

            });


            $('#establec tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });
        }); 
    </script>
@endsection