<div>
    @php
    setlocale(LC_TIME, "spanish");
    @endphp
    <h1 style="padding:7px"><i class="fas fa-bullhorn"></i>&nbsp;&nbsp;Crear Servicio
        @if ($serv_tipo == 1)
        <span
            style="background-color: rgb(44, 129, 199); border-radius:10px; padding:0 10px; color:white; font-size: 0.7em;">Colegios</span>
        @else
        @if ($serv_tipo == 2)
        <span
            style="background-color: rgb(34, 163, 88); border-radius:10px; padding:0 10px; color:white; font-size: 0.7em;">Evento
            Pago</span>
        @else
        <span
            style="background-color: rgb(216, 99, 64); border-radius:10px; padding:0 10px; color:white; font-size: 0.7em;">Evento
            al Cobro</span>
        @endif
        @endif
    </h1>
    <div class="card">

        @if ($serv_tipo == 1)
        <div class="card-header">
            <h3><b> Establecimientos</h3></b>

            @foreach ($establecimientos as $establecimiento)
            <div class="row" style="align-items: flex-end;">
                <div class="col" style="max-width: 115px !important">
                    <div class="form-group">
                        <label>CUE</label>
                        <input class="form-control" value="{{ $establecimiento['cue'] }}" disabled>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Nombre del establecimiento</label>
                        <input class="form-control" value="{{ $establecimiento['nombre'] }}" disabled>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Provincia</label>
                        <input class="form-control" value="{{ $establecimiento['prov'] }}" disabled>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Departamento</label>
                        <input class="form-control" value="{{ $establecimiento['depto'] }}" disabled>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Ciudad</label>
                        <input class="form-control" value="{{ $establecimiento['ciudad'] }}" disabled>
                    </div>
                </div>

                <div class="col" style="max-width:45px; margin-bottom: 1rem;">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target={{ "#collapse" .
                        $establecimiento['id'] }} aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-info" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="col" style="max-width:95px; margin-bottom: 1rem;">
                    <button class="btn btn-danger" type="button" wire:click="$emit('deleteEstabl', {{ $loop->index }})"
                        {{ count($establecimientos)==1? 'disabled' : '' }}>
                        Eliminar
                    </button>
                </div>
            </div>
            <div class="collapse" id={{ "collapse" . $establecimiento['id'] }}>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Domicilio</label>
                            <input class="form-control" value="{{ $establecimiento['domicilio'] }}" disabled>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Teléfono</label>
                            <input class="form-control" value="{{ $establecimiento['tel'] }}" disabled>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Sector</label>
                            <input class="form-control" value="{{ $establecimiento['sector'] }}" disabled>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Ambito</label>
                            <input class="form-control" value="{{ $establecimiento['ambito'] }}" disabled>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Tipo</label>
                            <input class="form-control" value="{{ $establecimiento['tipo'] }}" disabled>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Niveles</label>
                            <input class="form-control" value="{{ $establecimiento['niveles'] }}" disabled>
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            @endforeach

            <div class="row" style="align-items: flex-end;">
                <div class="col">
                    <div class="form-group">
                        <label>CUE</label>
                        <div class="input-group">
                            <input class="form-control" wire:model.defer="cueNew">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" wire:click="buscCue()">
                                    Buscar
                                </button>
                            </span>
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="form-group">
                        <label>Nombre del establecimiento</label>
                        <input class="form-control" wire:model="nombreNew" disabled>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Provincia</label>
                        <input class="form-control" wire:model="provinciaNew" disabled>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Departamento</label>
                        <input class="form-control" wire:model="deptoNew" disabled>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Ciudad</label>
                        <input class="form-control" wire:model="localidadNew" disabled>
                    </div>
                </div>

                <div class="col" style="max-width:95px; margin-bottom: 1rem;" wire:click="agregar()">
                    <button class="btn btn-success" type="button" {{ $validCue? '' : 'disabled' }}>
                        Agregar
                    </button>
                </div>


            </div>
        </div>
        @else
        <div class="card-header">
            <h3><b> Lugar </h3></b>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="lugar" placeholder="Lugar">
                    </div>
                    @error('lugar')
                    <span class=" text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="vendedor_id">Vendedor</label>
                        <select class="form-control" wire:model="vendedor_id">
                            <option value="">Seleccione un vendedor</option>
                            @foreach ($vendedores as $vendedor)
                            <option value="{{ $vendedor->id }}" {{ $vendedor->id == $userReg? 'selected' : '' }}
                                >{{ $vendedor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('vendedor_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="fecha_venta">Fecha de Venta</label>
                        <input type="date" class="form-control" wire:model="fecha_venta">
                    </div>
                    @error('fecha_venta')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="fecha_ini_serv">Fecha de Inicio Servicio</label>
                        <input type="date" class="form-control" wire:model="fecha_ini_serv">
                    </div>
                    @error('fecha_ini_serv')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="fecha_fin_serv">Fecha de Fin Servicio</label>
                        <input type="date" class="form-control" wire:model="fecha_fin_serv">
                    </div>
                    @error('fecha_fin_serv')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="estado_id">Estado</label>
                        <select class="form-control" wire:model.defer="estado_id">
                            @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('estado_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="linea_id">Línea</label>
                        <select class="form-control" wire:model.defer="linea_id">
                            <option>Seleccione una línea</option>
                            @foreach ($lineas as $linea)
                            <option value="{{ $linea->id }}">
                                {{ $linea->nombre . "- ". utf8_encode(strftime("%d/%m/%Y",
                                strtotime($linea->inicio)))
                                ."-". utf8_encode(strftime("%d/%m/%Y", strtotime($linea->fin))) }}
                            </option>
                            @endforeach
                        </select>
                        @error('linea_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>
            <h4>Contacto 1</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="cont_1" placeholder="Nombre Contacto 1">
                    </div>
                    @error('cont_1')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="cel_cont_1"
                            placeholder="Celular Contacto 1">
                    </div>
                    @error('cel_cont_1')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="puesto_cont1"
                            placeholder="Puesto Contacto 1">
                    </div>
                    @error('puesto_cont1')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <h4>Contacto 2</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="cont_2"
                            placeholder="Nombre Contacto 2">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="cel_cont_2"
                            placeholder="Celular Contacto 2">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="puesto_cont2"
                            placeholder="Puesto Contacto 2">
                    </div>
                </div>
            </div>
            <hr>

            @if($serv_tipo == 1)
            <div class="row">
                <div class="col-md-3">
                    <h4>Matricula Jardín</h4>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <b><label for="matricula_total_j">Total</label></b>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_total_j">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tmj">Mañana</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_tmj">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_ttj">Tarde</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_ttj">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tnj">Noche</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_tnj">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <h4>Matricula Primaria</h4>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <b><label for="matricula_total_p">Total</label></b>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_total_p">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tmp">Mañana</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_tmp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_ttp">Tarde</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_ttp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tnp">Noche</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_tnp">
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <h4>Matricula Secundaria</h4>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <b><label for="matricula_total_s">Total</label></b>
                        </div>

                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_total_s">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tms">Mañana</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_tms">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tts">Tarde</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_tts">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tns">Noche</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="matricula_tns">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <h4>Horario Servicio</h4>
                    <label>
                        <input type="checkbox" wire:model.defer="servicio_tm"> Mañana
                    </label>
                    <label>
                        <input type="checkbox" wire:model.defer="servicio_tt"> Tarde
                    </label>
                    <label>
                        <input type="checkbox" wire:model.defer="servicio_tn"> Noche
                    </label>
                </div>
            </div>
            @endif

            <hr>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="espacio_montaje">Espacio Montaje</label>
                                <select class="form-control" wire:model.defer="espacio_montaje">
                                    <option value="0">Selecciona</option>
                                    @foreach ($espacios as $espacio)
                                    <option value="{{ $espacio->id }}">{{ $espacio->espacio }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('espacio_montaje')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tamano_id">Planetario Tamaño</label>
                                <select class="form-control" wire:model.defer="tamano_id">
                                    <option value="0">Selecciona</option>
                                    @foreach ($tamanos as $tamano)
                                    <option value="{{ $tamano->id }}">{{ $tamano->tamano }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tamano_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="asesor_id">Asesor</label>
                                <select class="form-control" wire:model.defer="asesor_id">
                                    <option value="0">Selecciona</option>
                                    @foreach ($asesores as $asesor)
                                    <option value="{{ $asesor->id }}">{{ $asesor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" wire:model.defer="observaciones" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @if($serv_tipo ==1)
                    <div class="form-group">
                        <label for="precio_alumno">Precio por alumno</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" wire:model.defer="precio_alumno">
                        </div>
                    </div>
                    @endif
                    @if($serv_tipo < 3) <div class="form-group">
                        <label for="precio_total">Precio Total</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" wire:model.defer="precio_total">
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" wire:click="crear()">Crear Servicio </button>
        <a href="{{ route('admin.servicios.index') }}" class="btn btn-danger">Cancelar</a>

    </div>
</div>
</div>