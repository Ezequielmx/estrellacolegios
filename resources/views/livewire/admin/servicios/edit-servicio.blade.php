<div>
    <div class="row" style="align-items: center;">
        <div class="col">
            <h1 style="padding:7px"><i class="fas fa-bullhorn"></i>&nbsp;&nbsp;Editar Servicio
                @if ($servicio->tipo == 1)
                <span
                    style="background-color: rgb(44, 129, 199); border-radius:10px; padding:0 10px; color:white; font-size: 0.7em;">Colegios</span>
                @else
                @if ($servicio->tipo == 2)
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

        </div>
        <div class="col text-right">
            <button class="btn btn-success btn-sm" wire:click="envWpp">
                <i class="fab fa-whatsapp"></i> Enviar Wpp Confirmación
            </button>
        </div>
    </div>



    <div class="card">
        @if ($servicio->tipo == 1)
        <div class="card-header">
            <h3><b> Establecimientos</h3></b>
        </div>
        <div class="card-body">
            @foreach ($servicio->establecimientos as $establecimiento)
            <div class="row" style="align-items: flex-end;">
                <div class="col" style="max-width: 115px !important">
                    <div class="form-group">
                        <label>CUE</label>
                        <input class="form-control" value="{{ $establecimiento->cue }}" disabled>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Nombre del establecimiento</label>
                        <input class="form-control" value="{{ $establecimiento->nombre }}" disabled>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Provincia</label>
                        <input class="form-control" value="{{ $establecimiento->prov }}" disabled>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Departamento</label>
                        <input class="form-control" value="{{ $establecimiento->depto }}" disabled>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Ciudad</label>
                        <input class="form-control" value="{{ $establecimiento->ciudad }}" disabled>
                    </div>
                </div>

                <div class="col" style="max-width:45px; margin-bottom: 1rem;">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target={{ "#collapse" .
                        $establecimiento->id }} aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-info" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="col" style="max-width:95px; margin-bottom: 1rem;">
                    <button class="btn btn-danger" type="button"
                        wire:click="$emit('deleteEstabl', {{ $establecimiento->id }})" {{
                        $servicio->establecimientos->count()==1? 'disabled' : '' }}>
                        Eliminar
                    </button>
                </div>
            </div>
            <div class="collapse" id={{ "collapse" . $establecimiento->id }}>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Domicilio</label>
                            <input class="form-control" value="{{ $establecimiento->domicilio }}" disabled>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Teléfono</label>
                            <input class="form-control" value="{{ $establecimiento['cod_area'] . " -" .
                                $establecimiento['tel'] }}" disabled>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Sector</label>
                            <input class="form-control" value="{{ $establecimiento->sector }}" disabled>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Ambito</label>
                            <input class="form-control" value="{{ $establecimiento->ambito }}" disabled>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Tipo</label>
                            <input class="form-control" value="{{ $establecimiento->tipo }}" disabled>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="col-form-label-sm">Niveles</label>
                            <input class="form-control" value="{{ $establecimiento->niveles }}" disabled>
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
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="servicio.lugar" placeholder="Lugar">
                    </div>
                    @error('servicio.lugar')
                    <span class=" text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="card">
        <div class="card-body {{'est' . $servicio->estado_id }}">
            <div class="row" style="align-items: flex-end;">
                <div class="col">
                    <div class="form-group">
                        <label for="vendedor_id">Vendedor</label>
                        <select class="form-control" wire:model="servicio.vendedor_id">
                            <option value="">Seleccione un vendedor</option>
                            @foreach ($vendedores as $vendedor)
                            <option value="{{ $vendedor->id }}">{{ $vendedor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('servicio.vendedor_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="fecha_venta">Fecha de Venta</label>
                        <input type="date" class="form-control" wire:model="servicio.fecha_venta">
                    </div>
                    @error('servicio.fecha_venta')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="fecha_ini_serv">Fecha Inicio Servicio</label>
                        <input type="date" class="form-control" wire:model="servicio.fecha_ini_serv"
                            wire:change="changeFechaIni()">
                    </div>
                    @error('servicio.fecha_ini_serv')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="fecha_fin_serv">Fecha Fin Servicio</label>
                        <input type="date" class="form-control" wire:model="servicio.fecha_fin_serv">
                    </div>
                    @error('servicio.fecha_fin_serv')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="fecha_orig_ini">Fecha Inicio Original</label>
                        <input type="date" class="form-control" wire:model="servicio.fecha_orig_ini" {{
                            (auth()->user()->cannot('cambiar fecha original'))? 'disabled' : '' }}>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="fecha_orig_fin">Fecha Fin Original</label>
                        <input type="date" class="form-control" wire:model="servicio.fecha_orig_fin" {{
                            (auth()->user()->cannot('cambiar fecha original'))? 'disabled' : '' }}>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="estado_id">Estado</label>
                        <select class="form-control" wire:model="servicio.estado_id">
                            <option value="0" @if (auth()->user()->cannot('asignar estado preventa'))
                                disabled
                                @endif>PRE-VENTA</option>
                            <option value="1">VENDIDO</option>
                            <option value="2">WPP ENVIADO</option>
                            <option value="3">WPP CONFIRMADO</option>
                            <option value="4">WPP LLAMAR</option>
                            <option value="5">CONFIRMADO</option>
                            <option value="6">LISTO</option>
                            <option value="7" @if (auth()->user()->cannot('asignar estado realizado'))
                                disabled
                                @endif>REALIZADO</option>
                            <option value="8" @if (auth()->user()->cannot('asignar estado caida'))
                                disabled
                                @endif>CAIDA</option>
                            <option value="9" @if (auth()->user()->cannot('asignar estado controlado'))
                                disabled
                                @endif>CONTROLADO</option>
                            <option value="10" @if (auth()->user()->cannot('asignar estado reprogramar'))
                                disabled
                                @endif>A REPROGRAMAR</option>
                            <option value="11" @if (auth()->user()->cannot('asignar estado a levantar'))
                                disabled
                                @endif>A LEVANTAR</option>
                            <option value="12" @if (auth()->user()->cannot('asignar estado suspendido'))
                                disabled
                                @endif>SUSPENDIDO</option>

                        </select>
                    </div>
                    @error('servicio.estado_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="linea_id">Línea</label>
                        <select class="form-control" wire:model.defer="servicio.linea_id">
                            <option value="">Seleccione una línea</option>
                            @foreach ($lineas as $linea)
                            <option value="{{ $linea->id }}">
                                {{ $linea->nombre . "- ". utf8_encode(strftime("%d/%m/%Y", strtotime($linea->inicio)))
                                ."-". utf8_encode(strftime("%d/%m/%Y", strtotime($linea->fin))) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4>Contacto 1</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="servicio.cont_1"
                            placeholder="Nombre Contacto 1">
                    </div>
                    @error('servicio.cont_1')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="servicio.cel_cont_1"
                            placeholder="Celular Contacto 1">
                    </div>
                    @error('servicio.cel_cont_1')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="servicio.puesto_cont1"
                            placeholder="Puesto Contacto 1">
                    </div>
                    @error('servicio.puesto_cont1')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <h4>Contacto 2</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="servicio.cont_2"
                            placeholder="Nombre Contacto 2">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="servicio.cel_cont_2"
                            placeholder="Celular Contacto 2">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.defer="servicio.puesto_cont2"
                            placeholder="Puesto Contacto 2">
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($servicio->tipo == 1)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h4>Matricula Jardín</h4>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <b><label for="matricula_total_j">Total</label></b>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_total_j">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tmj">Mañana</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_tmj">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_ttj">Tarde</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_ttj">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tnj">Noche</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_tnj">
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
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_total_p">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tmp">Mañana</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_tmp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_ttp">Tarde</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_ttp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tnp">Noche</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_tnp">
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
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_total_s">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tms">Mañana</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_tms">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tts">Tarde</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_tts">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="matricula_tns">Noche</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" wire:model.defer="servicio.matricula_tns">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <h4>Horario Servicio</h4>
                    <label>
                        <input type="checkbox" wire:model.defer="servicio.servicio_tm"> Mañana
                    </label>
                    <label>
                        <input type="checkbox" wire:model.defer="servicio.servicio_tt"> Tarde
                    </label>
                    <label>
                        <input type="checkbox" wire:model.defer="servicio.servicio_tn"> Noche
                    </label>
                </div>
            </div>
        </div>
    </div>
    @endif


    <!--ESPACIO MONTAJE - PRECIO --------------------------->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="espacio_montaje">Espacio Montaje</label>
                                <select class="form-control" wire:model.defer="servicio.espacio_montaje">
                                    <option value="0">Selecciona</option>
                                    @foreach ($espacios as $espacio)
                                    <option value="{{ $espacio->id }}">{{ $espacio->espacio }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('servicio.espacio_montaje')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tamano_id">Planetario Tamaño Venta</label>
                                <select class="form-control" wire:model.defer="servicio.tamano_id">
                                    @foreach ($tamanos as $tamano)
                                    <option value="{{ $tamano->id }}">{{ $tamano->tamano }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tamano_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="planetario_id">Planetario Asignado</label>
                                <select class="form-control" wire:model.defer="servicio.planetario_id">
                                    <option value="0">Selecciona</option>
                                    @foreach ($planetarios as $planetario)
                                    <option value="{{ $planetario->id }}">
                                        {{ $planetario->id }} - {{ $planetario->tamaño }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('servicio.planetario_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="asesor_id">Asesor</label>
                                <select class="form-control" wire:model.defer="servicio.asesor_id" {{
                                    (auth()->user()->cannot('asignar asesores'))? 'disabled' : '' }}>
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
                                <textarea class="form-control" wire:model.defer="servicio.observaciones"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @if($servicio->tipo ==1)
                    <div class="form-group">
                        <label for="precio_alumno">Precio por alumno</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" wire:model.defer="servicio.precio_alumno">
                        </div>
                    </div>
                    @endif

                    @if(($servicio->tipo == 2) || ($servicio->tipo == 1))
                    <!--La opcion ->tipo < 3 genera error en el formatter por apertura de etiqueta-->

                    <div class="form-group">
                        <label for="precio_total">Precio Total</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" wire:model.defer="servicio.precio_total">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    @livewire('admin.servicios.horarios.horario-servicio', ['servicio' => $servicio], key($servicio->id))

    <!--PERSONAL------------------------------------->
    <div class="card">
        <div class="card-header">
            <h3><b>Personal</b></h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Personal</th>
                        <th>Puesto</th>
                        <th class="text-center">Plus Sin Ayudante</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicio->personal as $servpersonal)
                    <tr>
                        <td>
                            {{ $servpersonal->name }}
                        </td>
                        <td>
                            @foreach ($puestos as $puesto)
                            @if($puesto->id==$servpersonal->pivot->role_id)
                            {{ $puesto->name }}
                            @endif
                            @endforeach
                        </td>
                        <td>
                            <!--checkbox para plus_sin_ayudante-->
                            <input type="checkbox" {{ $servpersonal->pivot->sin_ayudante? 'checked' : '' }}
                            class="form-control"
                                wire:change="changeAyud({{ $servpersonal->id}}, {{$servpersonal->pivot->sin_ayudante? '1' : '0' }})">
                                
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"
                                wire:click="eliminarPersonal({{ $servpersonal->id }})">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>
                            <select class="form-control" wire:model="newpers_id">
                                <option value="0">Selecciona</option>
                                @foreach ($personal as $pers)
                                <option value="{{ $pers->id }}">
                                    {{ $pers->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('newpers_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <select class="form-control" wire:model="newpers_rol_id">
                                <option value="0">Selecciona</option>
                                <option value="6">Instructor</option>
                                <option value="7">Cobrador</option>
                            </select>
                            @error('newpers_rol_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>

                        <td>
                            <!--checkbox para plus_sin_ayudante-->
                            <input type="checkbox" class="form-control" wire:model = "newpers_plus_ayud">
                        </td>

                        <td>
                            <button class="btn btn-success btn-sm" wire:click="agregarPersonal()">Agregar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <!--RENDICION------------------------------------->
    <div class="card">
        <div class="card-header">
            <h3><b>Rendicion - Evaluación</b></h3>
            <a class="btn btn-secondary btn-sm" href="{{ route('rendicionprint', $servicio->id) }}"
                target="_blank">Imprimir</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="alumnos_ing">Alumnos ingresados</label>
                        <input type="number" class="form-control" wire:model.defer="servicio.alumnos_ing"
                            wire:change='saveChange()'>
                    </div>

                    <div class="form-group">
                        <label for="cobrado">Total Cobrado</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="number" class="form-control" wire:model.defer="servicio.cobrado"
                                wire:change='saveChange()'>
                        </div>
                    </div>

                    <!--select para TipoPagos-->
                    <div class="form-group">
                        <label for="tipopago_id">Forma de Pago</label>
                        <select class="form-control" wire:model.defer="servicio.tipopago_id">
                            @foreach ($tipopagos as $tipopago)
                            <option value="{{ $tipopago->id }}">{{ $tipopago->tipo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!--textarea para observ_pago-->
                    <div class="form-group">
                        <label for="observ_pago">Observaciones Pago</label>
                        <textarea class="form-control" wire:model.defer="servicio.observ_pago" rows="3"></textarea>
                    </div>


                </div>
                <div class="col-md-4">
                    <div class="form-group row mb-1">
                        <label for="val_asesoramiento"
                            class="col-form-label col-md-5 mr-2 text-right">Asesoramiento</label>
                        <div class="col-md-6">
                            <select class="form-control" wire:model.defer="servicio.val_asesoramiento">
                                <option value="0">Selecciona</option>
                                @foreach ($valoraciones as $valoracion)
                                <option value="{{ $valoracion->id }}">{{ $valoracion->valoracion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label for="val_puntutalidad"
                            class="col-form-label col-md-5 mr-2 text-right">Puntualidad</label>
                        <div class="col-md-6">
                            <select class="form-control" wire:model.defer="servicio.val_puntutalidad">
                                <option value="0">Selecciona</option>
                                @foreach ($valoraciones as $valoracion)
                                <option value="{{ $valoracion->id }}">{{ $valoracion->valoracion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label for="val_trato" class="col-form-label col-md-5 mr-2 text-right">Trato</label>
                        <div class="col-md-6">
                            <select class="form-control" wire:model.defer="servicio.val_trato">
                                <option value="0">Selecciona</option>
                                @foreach ($valoraciones as $valoracion)
                                <option value="{{ $valoracion->id }}">{{ $valoracion->valoracion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label for="val_higiene" class="col-form-label col-md-5 mr-2 text-right">Higiene</label>
                        <div class="col-md-6">
                            <select class="form-control" wire:model.defer="servicio.val_higiene">
                                <option value="0">Selecciona</option>
                                @foreach ($valoraciones as $valoracion)
                                <option value="{{ $valoracion->id }}">{{ $valoracion->valoracion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label for="val_material" class="col-form-label col-md-5 mr-2 text-right">Material</label>
                        <div class="col-md-6">
                            <select class="form-control" wire:model.defer="servicio.val_material">
                                <option value="0">Selecciona</option>
                                @foreach ($valoraciones as $valoracion)
                                <option value="{{ $valoracion->id }}">{{ $valoracion->valoracion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label for="val_general" class="col-form-label col-md-5 mr-2 text-right">Calidad General</label>
                        <div class="col-md-6">
                            <select class="form-control font-weight-bold" wire:model.defer="servicio.val_general">
                                <option value="0">Selecciona</option>
                                @foreach ($valoraciones as $valoracion)
                                <option value="{{ $valoracion->id }}">{{ $valoracion->valoracion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rend_fte">Rendición frente:</label>
                        <input type="file" id="rend_fte" name="rend_fte" wire:model="rend_fte">
                        @error('rend_fte')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        @if ($servicio->rend_fte)
                        <a href="{{ asset('storage/' . $servicio->rend_fte) }}" target="_blank">
                            <img style="max-width: 100%" src="{{ asset('storage/' . $servicio->rend_fte) }}"
                                alt="Rendición de frente">
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rend_dorso">Rendición dorso:</label>
                        <input type="file" id="rend_dorso" name="rend_dorso" wire:model="rend_dorso">
                        @error('rend_dorso')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        @if ($servicio->rend_dorso)
                        <a href="{{ asset('storage/' . $servicio->rend_dorso) }}" target="_blank">
                            <img style="max-width: 100%" src="{{ asset('storage/' . $servicio->rend_dorso) }}"
                                alt="Rendición de dorso">
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="basebot">
        <button class="btn btn-primary" wire:click="guardar()">Guardar</button>&nbsp;&nbsp;
        <a href="{{ route('admin.servicios.index') }}" class="btn btn-danger">Cancelar</a>&nbsp;&nbsp;
        <a class="btn btn-secondary" href="{{ route('servicioprint', $servicio->id) }}" target="_blank">Imprimir</a>
    </div>
</div>