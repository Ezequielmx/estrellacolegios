<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
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
                        <th>Asesor</th>
                        <th>Estado</th>
                        <th>Cambio Estado</th>
                        <th colspan="3"></th>
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
                    <td>{{ $servicio->asesor? $servicio->asesor->name : '' }}</td>
                    <td>{{ $servicio->estado()->first()->estado }}</td>
                    <td>{{ floor((strtotime(now()) - strtotime($servicio->cambio_estado))  / 86400) . ' días' }}</td>

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

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="padding:0">
                    <div class="card card-danger direct-chat direct-chat-danger" style="margin-bottom:0">
                        
                        <div class="card-header">
                            <h3 class="card-title"><b>{{ $servAct->cont_1 }}</b> - {{
                                $servAct->establecimientos->first()->nombre}}</h3>
                        </div>

                        <div class="card-body">
                            <div class="direct-chat-messages" style="height:70vh">
                                @foreach ($mensAct as $ms)
                                    <div class="direct-chat-msg {{ ($ms->flow == 'inbound')? 'left' : 'right' }}">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-timestamp float-left">{{ $ms->date }}</span>
                                        </div>
                                        <div class="direct-chat-text">
                                            {{ $ms->body}}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>                         
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="text" name="message" placeholder="Mensaje ..."
                                        class="form-control">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-danger">Enviar</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>
            </div>
        </div>
    </div>
</div>