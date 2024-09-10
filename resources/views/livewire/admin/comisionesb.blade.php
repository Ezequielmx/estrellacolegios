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
                        <th>Evento Frente</th>
                        <th>Evento Ficha</th>
                        <th>Plus sin Ayudante</th>
                        <th>Servicio Suspendido</th>
                        <th>Día Libre</th>
                        <th>Día de Viaje</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comisiones as $comision)
                    <tr>
                        <!--select for roles-->
                        <td style="min-width: 140px;">
                            @if($editing_id == $comision->id)
                                <select class="form-control" wire:model="role_id">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == $role_id ? 'selected' : ''
                                        }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('puesto')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            @else
                                @foreach ($roles as $role)
                                @if ($role->id == $comision->role_id)
                                    {{ $role->name }}   
                                @endif
                                @endforeach
                            @endif
                        </td>
                        <!--select for ubicaciones-->
                        <td style="min-width: 125px;">
                            @if($editing_id == $comision->id)
                                <select class="form-control" wire:model="servicioubicacione_id">
                                    @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}" {{ $ubicacion->id ==
                                        $servicioubicacione_id ? 'selected' : '' }}>{{ $ubicacion->ubicacion }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('ubicacion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            @else
                                @foreach ($ubicaciones as $ubicacion)
                                @if ($ubicacion->id == $comision->servicioubicacione_id)
                                    {{ $ubicacion->ubicacion }}   
                                @endif
                                @endforeach
                            @endif
                            @error('ubicacion')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            @if($editing_id == $comision->id)
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" wire:model="colegio_frente">
                                </div>
                                @error('colegio_frente')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            @else
                                ${{ number_format($comision->colegio_frente, 0, ',', '.') }}
                            @endif
                        </td>
                        <td>
                            @if($editing_id == $comision->id)
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" wire:model="colegio_ficha">
                                </div>
                                @error('colegio_ficha')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            @else
                                ${{ number_format($comision->colegio_ficha, 0, ',', '.') }}
                            @endif
                        </td>
        
                        <td>
                            @if($editing_id == $comision->id)
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" wire:model="servicio_doble">
                                </div>
                            @else
                                ${{ number_format($comision->servicio_doble, 0, ',', '.') }}
                            @endif
                        </td>
                        <td>
                            @if($editing_id == $comision->id)
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" wire:model="servicio_triple">
                                </div>
                            @else
                                ${{ number_format($comision->servicio_triple, 0, ',', '.') }}
                            @endif
                        </td>
                        <td>
                            @if($editing_id == $comision->id)
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" wire:model="evento_frente">
                                </div>
                            @else
                                ${{ number_format($comision->evento_frente, 0, ',', '.') }}
                            @endif
                        </td>

                        <td>
                            @if($editing_id == $comision->id)
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" wire:model="evento_ficha">
                                </div>
                            @else
                                ${{ number_format($comision->evento_ficha, 0, ',', '.') }}
                            @endif
                        </td>

                        <td>
                            @if($editing_id == $comision->id)
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" wire:model="plus_sin_ayudante">
                                </div>
                            @else
                                ${{ number_format($comision->plus_sin_ayudante, 0, ',', '.') }}
                            @endif
                        </td>


                        <td>
                            @if($editing_id == $comision->id)
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" wire:model="servicio_suspendido">
                                </div>
                            @else
                                ${{ number_format($comision->servicio_suspendido, 0, ',', '.') }}
                            @endif
                        </td>
                        <td>
                            @if($editing_id == $comision->id)
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" wire:model="dia_libre">
                                </div>
                            @else
                                ${{ number_format($comision->dia_libre, 0, ',', '.') }}
                            @endif
                        </td>

                        <td>
                            @if($editing_id == $comision->id)
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" class="form-control" wire:model="dia_viaje">
                                </div>
                            @else
                                ${{ number_format($comision->dia_viaje, 0, ',', '.') }}
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                @if($editing_id == $comision->id)
                                    <button wire:click="updateComision()" class="btn btn-success btn-sm mr-1"><i class="fa fa-check"></i></button>
                                    <button wire:click="editClose()" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                                @else
                                    <button wire:click="editing({{ $comision->id }})" class="btn btn-primary btn-sm mr-1"><i class="fa fa-edit"></i></button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>