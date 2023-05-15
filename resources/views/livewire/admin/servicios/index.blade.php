<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <b><label for="nombre">Buscar Establecimiento</label></b>
                    <div class="input-group">
                        <input class="form-control" type="text" name="nombre" wire:model.defer="nombusq">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" wire:click="busqNombre()">
                                Buscar
                            </button>
                            <button class="btn btn-danger" wire:click="limpNombre()">
                                X
                            </button>
                        </span>
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="estado">Estado</label>
                    <select class="form-control" wire:model="estadoSel">
                        <option value="-1">Todos</option>
                        @foreach ($estados as $estado)

                        <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="asesor_id">Asesor</label>
                        <select class="form-control" wire:model="asesorSel">
                            <option value="0">Todos</option>
                            @foreach ($asesores as $asesor)
                            <option value="{{ $asesor->id }}">{{ $asesor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col text-center" style="max-width: 200px">
                    <b><label for="showCaida">Mostrar caidas</label></b>
                    <div class="form-check">
                        <input type="checkbox" class="form-control" wire:model="showCaida" name="showCaida"
                            id="showCaida">
                    </div>
                </div>
                <div class="col text-center" style="max-width: 200px">
                    <b><label for="showFinal">Mostrar Finalizados</label></b>
                    <div class="form-check">
                        <input type="checkbox" class="form-control" wire:model="showFinal" name="showFinal"
                            id="showFinal">
                    </div>
                </div>
                <div class="col text-center" style="max-width: 200px">
                    <b><label for="showFinal">WhatsApp</label></b>
                    <div class="form-check">
                        <input type="checkbox" class="form-control" wire:model="showUnread" name="showUnread"
                            id="showUnread">
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
                        <th>Asesor</th>
                        <th>Estado</th>
                        <th>Cambio Estado</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                @foreach ($servicios as $servicio)
                <tr class={{ "est" . $servicio->estado_id }}>
                    <td>{{ $servicio->id }}</td>
                    <td style="white-space: nowrap;">{{ $servicio->fecha_ini_serv != $servicio->fecha_orig_ini? '🔄 ' :
                        '' }}{{ strftime("%d/%m/%Y", strtotime($servicio->fecha_ini_serv)) }}</td>
                    <td>
                        @if ($servicio->tipo == 1)
                        🏫
                        @foreach ($servicio->establecimientos as $establecimiento)
                        ◼ {{ $establecimiento->nombre . " " }}
                        @endforeach
                        @else
                        @if ($servicio->tipo == 2)
                        💰
                        @else
                        🎫
                        @endif
                        {{ $servicio->lugar }}
                        @endif

                    </td>
                    @if ($servicio->tipo == 1)
                    <td>{{ $servicio->establecimientos->first()->prov }}</td>
                    <td>{{ $servicio->establecimientos->first()->ciudad }}</td>
                    @else
                    <td></td>
                    <td></td>
                    @endif
                    <td>{{ $servicio->asesor? $servicio->asesor->name : '' }}</td>
                    <td>{{ $servicio->estado()->first()->estado }}</td>
                    <td>{{ floor((strtotime(now()) - strtotime($servicio->cambio_estado)) / 86400) . ' días' }}</td>

                    @if ($servicio->unreadwpp > 0)
                    <td>
                        <a class="btn" style="color: green;" wire:click.prevent="showForm({{ $servicio}})">
                            <div id="ex2">
                                <span class="fa-stack fa-1x has-badge" data-count={{ $servicio->unreadwpp }}>
                                    <i class="fa fa-circle fa-stack-2x"
                                        style="text-shadow: -1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff;"></i>
                                    <i class="fab fa-whatsapp fa-stack-1x fa-inverse"></i>
                                </span>
                            </div>
                        </a>
                    </td>
                    @else
                    <td>
                        <a class="btn" style="color: rgb(130, 138, 130);" wire:click.prevent="showForm({{ $servicio}})">
                            <div id="ex2">
                                <span class="fa-stack fa-1x">
                                    <i class="fa fa-circle fa-stack-2x"
                                        style="text-shadow: -1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff;"></i>
                                    <i class="fab fa-whatsapp fa-stack-1x fa-inverse"></i>
                                </span>
                            </div>
                        </a>
                    </td>
                    @endif
                    <td width="10px" style="white-space: nowrap">
                        @can('rendiciones')
                            <a class="btn btn-success btn-sm"
                                href="{{ route('admin.servicios.edit', $servicio) }}">Rendicion</a>
                        @endcan
                        @can('editar servicios')
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('admin.servicios.edit', $servicio) }}">Editar</a>
                        @endcan
                        @can('eliminar servicios')
                            <button class="btn btn-danger btn-sm"
                                wire:click="$emit('deleteServ', {{ $servicio->id }})">Eliminar</button>
                        @endcan
                            <a class="btn btn-secondary btn-sm" href="{{ route('servicioprint', $servicio->id) }}"
                                target="_blank">Imprimir</a>
                        @can('editar servicios')
                            <a href="#" class="btn btn-warning btn-sm" wire:click="duplicateServicio({{ $servicio->id }})">
                                <i class="fas fa-copy"></i>
                            </a>
                        @endcan
                    </td>
                </tr>

                @endforeach

            </table>
        </div>
    </div>

    <!-- Modal -->
    <div>
        <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="padding:0">
                        <div class="card card-danger direct-chat direct-chat-danger" style="margin-bottom:0">
                            <div class="card-header">
                                <h3 class="card-title"><b>{{ $servAct->cont_1 }}</b>
                                    @if ($servAct->tipo == 1)
                                    - {{ $servAct->establecimientos->first()->nombre}}<br>
                                    @else
                                    - {{ $servAct->lugar }}<br>
                                    @endif
                                    {{ $servAct->cel_cont_1 }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="direct-chat-messages" style="height:70vh">
                                    @foreach ($mensAct as $ms)
                                    <div class="direct-chat-msg {{ ($ms->flow == 'inbound')? 'left' : 'right' }}">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-timestamp float-left">{{ $ms->date }}</span>
                                        </div>
                                        <div class="direct-chat-text">
                                            @if ($ms->type == 'text' || $ms->type == 'list_response' || $ms->type ==
                                            'list')
                                            {{ $ms->body}}
                                            @elseif ($ms->type == 'image')
                                            -multimedia- {{ $ms->media->caption }}
                                            @endif
                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="input-group">
                                    <a type="button" class="btn btn-danger {{ count($mensAct)==0? 'disabled' : '' }}"
                                        wire:click="marcLeidos({{ $servAct }})">
                                        {{ $servAct->unreadwpp==1? 'Marcar como leidos' : 'Marcar como no leidos' }}
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!--/.direct-chat -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:loading>
        <div class="modload">
            <div class="spinload">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </div>
</div>