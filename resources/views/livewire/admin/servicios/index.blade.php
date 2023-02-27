<div>
    <div class="card">

        <div class="card-header">
            <div class="row" >
                <div class="col" style="max-width: 200px">
                    
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" wire:model="showCaida" name="showCaida"
                            id="showCaida">
                        <label class="form-check-label" for="showCaida">Mostrar Caídas</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" wire:model="showFinal" name="showFinal"
                            id="showFinal">
                        <label class="form-check-label" for="showFinal">Mostrar Realizados</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Establecimiento/s</th>
                        <th>Provincia</th>
                        <th>Localidad</th>
                        <th>Estado</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                @foreach ($servicios as $servicio)
                <tr class={{ "est" . $servicio->estado_id }}>
                    <td>{{ $servicio->id }}</td>
                    <td>{{ strftime("%d/%m/%Y", strtotime($servicio->fecha_ini_serv)) }}</td>
                    <td>

                        @foreach ($servicio->establecimientos as $establecimiento)
                        ◼ {{ $establecimiento->nombre . " " }}
                        @endforeach
                    </td>
                    <td>{{ $servicio->establecimientos->first()->prov }}</td>
                    <td>{{ $servicio->establecimientos->first()->ciudad }}</td>
                    <td>{{ $servicio->estado()->first()->estado }}</td>
                    <td width="10px">
                        <a class="btn btn-primary btn-sm"
                            href="{{ route('admin.servicios.edit', $servicio) }}">Editar</a>
                    </td>
                    <td width="10px">
                        <form action="{{ route('admin.servicios.destroy', $servicio) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>

                @endforeach

            </table>
        </div>
    </div>
</div>