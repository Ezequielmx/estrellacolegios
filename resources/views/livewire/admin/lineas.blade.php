<div>
    <div class="card mb-3">
        <div class="card-body">
            <form wire:submit.prevent="createLinea">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                            placeholder="Nombre" wire:model.defer="nombre">
                        @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <!-- select for servicioubicacione -->
                        <select class="form-control @error('servicioubicacione_id') is-invalid @enderror"
                            wire:model.defer="servicioubicacione_id">
                            @foreach ($ubicaciones as $servicioubicacion)
                            <option value="{{ $servicioubicacion->id }}">{{ $servicioubicacion->ubicacion }}</option>
                            @endforeach
                        </select>
                        @error('servicioubicacione_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control @error('inicio') is-invalid @enderror"
                            placeholder="Inicio" wire:model.defer="inicio">
                        @error('inicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control @error('fin') is-invalid @enderror" placeholder="Fin"
                            wire:model.defer="fin">
                        @error('fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-1">
                        <input type="color" class="form-control @error('color') is-invalid @enderror"
                            wire:model.defer="color" style="padding:0px; border:0px;">
                        @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Color</th>
                        <th>Activa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lineas as $linea)
                    <tr>
                        <td>
                            <input type="text" class="form-control {{ $linea->activa? '' : 'inputdisabled' }}"
                                value="{{ $linea->nombre }}"
                                wire:change='changeNombre({{ $linea->id }}, $event.target.value)'>
                        </td>

                        <td>
                            <!-- select for servicioubicacione -->
                            <select class="form-control {{ $linea->activa? '' : 'inputdisabled' }}"
                                wire:change='changeServicioUbicacion({{ $linea->id }}, $event.target.value)'>
                                @foreach ($ubicaciones as $servicioubicacion)
                                <option value="{{ $servicioubicacion->id }}" {{
                                    $linea->servicioubicacione_id==$servicioubicacion->id? 'selected' : '' }}>
                                    {{ $servicioubicacion->ubicacion }}</option>
                                @endforeach
                            </select>

                        </td>

                        <td>
                            <input type="date" class="form-control {{ $linea->activa? '' : 'inputdisabled' }}"
                                value="{{ $linea->inicio }}"
                                wire:change='changeInicio({{ $linea->id }}, $event.target.value)'>
                        </td>
                        <td>
                            <input type="date" class="form-control {{ $linea->activa? '' : 'inputdisabled' }}"
                                value="{{ $linea->fin }}"
                                wire:change='changeFin({{ $linea->id }}, $event.target.value)'>
                        </td>
                        <td>
                            <input type="color" class="form-control {{ $linea->activa? '' : 'inputdisabled' }}"
                                value="{{ $linea->color }}" style="padding:0px; border:0px;"
                                wire:change='changeColor({{ $linea->id }}, $event.target.value)'>
                        </td>
                        <td>
                            <input type="checkbox" class="form-control {{ $linea->activa? '' : 'inputdisabled' }}" {{
                                $linea->activa==1? 'checked' : '' }}
                            wire:change='changeActiva({{ $linea->id }}, $event.target.checked)'>
                        </td>
                        <td>
                            <button class="btn btn-danger"
                                wire:click="$emit('deleteLin', {{ $linea->id }})">Eliminar</button>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>