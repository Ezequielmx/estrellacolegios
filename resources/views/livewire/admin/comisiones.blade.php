<div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Puesto</th>
                        <th>Ubicacion</th>
                        <th>Colegio Frente</th>
                        <th>Colegio Ficha</th>
                        <th>Servicio Doble</th>
                        <th>Servicio Triple</th>
                        <th>Plus sin Ayudante</th>
                        <th>Evento Frente</th>
                        <th>Evento Ficha</th>
                        <th>Servicio Suspendido</th>
                        <th>Día Libre</th>
                        <th>Día de Viaje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comisiones as $comision)
                    <tr>
                        <!--select for roles-->
                        <td style="min-width: 140px;">
                            <select class="form-control"
                            wire:change="changeComision({{ $comision->id }}, 'role_id', $event.target.value)">
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $comision->role_id ? 'selected' : ''
                                    }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('puesto')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <!--select for ubicaciones-->
                        <td style="min-width: 125px;">
                            <select class="form-control"
                                wire:change="changeComision({{ $comision->id }}, 'servicioubicacione_id', $event.target.value)">
                                @foreach ($ubicaciones as $ubicacion)
                                <option value="{{ $ubicacion->id }}" {{ $ubicacion->id ==
                                    $comision->servicioubicacione_id ? 'selected' : '' }}>{{ $ubicacion->ubicacion }}
                                </option>
                                @endforeach
                            </select>
                            @error('ubicacion')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" value="{{ $comision->colegio_frente }}"
                                    wire:change="changeComision({{ $comision->id }}, 'colegio_frente', $event.target.value)">
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" value="{{ $comision->colegio_ficha }}"
                                    wire:change="changeComision({{ $comision->id }}, 'colegio_ficha', $event.target.value)">
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" value="{{ $comision->servicio_doble }}"
                                    wire:change="changeComision({{ $comision->id }}, 'servicio_doble', $event.target.value)">
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" value="{{ $comision->servicio_triple }}"
                                    wire:change="changeComision({{ $comision->id }}, 'servicio_triple', $event.target.value)">
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" value="{{ $comision->evento_frente }}"
                                    wire:change="changeComision({{ $comision->id }}, 'evento_frente', $event.target.value)">
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" value="{{ $comision->evento_ficha }}"
                                    wire:change="changeComision({{ $comision->id }}, 'evento_ficha', $event.target.value)">
                            </div>
                        </td>

                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" value="{{ $comision->plus_sin_ayudante }}"
                                    wire:change="changeComision({{ $comision->id }}, 'plus_sin_ayudante', $event.target.value)">
                            </div>
                        </td>

                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" value="{{ $comision->servicio_suspendido }}"
                                    wire:change="changeComision({{ $comision->id }}, 'servicio_suspendido', $event.target.value)">
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" value="{{ $comision->dia_libre }}"
                                    wire:change="changeComision({{ $comision->id }}, 'dia_libre', $event.target.value)">
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" class="form-control" value="{{ $comision->dia_viaje }}"
                                    wire:change="changeComision({{ $comision->id }}, 'dia_viaje', $event.target.value)">
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>