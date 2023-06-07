<div>

    <div class="card">
        <div class="card-body">
            <!-- filter by user, fecha desde and fecha hasta -->
            <div class="row" style="align-items: flex-end;">
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="userIdFiltro">Filtrar por empleado</label>
                        <select class="form-control" wire:model="userIdFiltro">
                            <option value="">Todos</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-2">
                    <div class="form-group">
                        <label for="desdeFiltro">Desde</label>
                        <input type="date" class="form-control" wire:model="desdeFiltro">
                    </div>
                </div>
                <div class="col col-md-2">
                    <div class="form-group">
                        <label for="hastaFiltro">Hasta</label>
                        <input type="date" class="form-control" wire:model="hastaFiltro">
                    </div>

                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <!--buton clean filters with eraser icon-->
                        <button wire:click="borrarFiltros" class="btn btn-outline-secondary"><i
                                class="fas fa-eraser"></i>Borrar Filtros</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $tabActivo == 'vales'? 'active' : '' }}" id="vales-tab" data-bs-toggle="tab"
                data-bs-target="#vales" type="button" role="tab" aria-controls="vales" aria-selected="true"
                style="font-weight: bold;font-size: large;" wire:click="activaTab('vales')">
                Vales
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $tabActivo == 'pluses'? 'active' : '' }}" id="pluses-tab" data-bs-toggle="tab"
                data-bs-target="#pluses" type="button" role="tab" aria-controls="pluses" aria-selected="false"
                style="font-weight: bold;font-size: large;" wire:click="activaTab('pluses')">
                Pluses
            </button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade {{ $tabActivo == 'vales'? 'show active' : '' }}" id="vales" role="tabpanel"
            aria-labelledby="vales-tab">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>Fecha</th>
                            <th>Empleado</th>
                            <th>Detalle</th>
                            <th>Importe</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($vales as $vale)
                            <tr>
                                <td>{{ date('d-m-Y',strtotime($vale->fecha)) }}</td>
                                <td>{{ $vale->user->name }}</td>
                                <td>{{ $vale->descripcion }}</td>
                                <td>$ {{ number_format($vale->monto,2,",",".") }}</td>
                                <!--td with button for delete vale-->
                                <td>
                                    <button class="btn btn-danger btn-sm" wire:click="deleteVale({{ $vale->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            <!--tr for new vale-->
                            <tr>
                                <td>
                                    <input type="date" class="form-control" wire:model="fechaVale">
                                    @error('fechaVale')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" wire:model="user_idVale">
                                        <option value="">Seleccione un empleado</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_idVale')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model="descripcionVale">
                                </td>
                                <td>
                                    <input type="number" class="form-control" wire:model="montoVale">
                                    @error('montoVale')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" wire:click="agregarVale">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{ $tabActivo == 'pluses'? 'show active' : '' }}" id="pluses" role="tabpanel"
            aria-labelledby="pluses-tab">
            <div class="card">
                <div class="card-body">
                    <!--table for pluses-->
                    <table class="table table-striped">
                        <thead>
                            <th>Fecha</th>
                            <th>Empleado</th>
                            <th>Tipo</th>
                            <th>Detalle</th>
                            <th>Importe</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($pluses as $pluse)
                            <tr>
                                <td>{{ date('d-m-Y',strtotime($pluse->fecha)) }}</td>
                                <td>{{ $pluse->user->name }}</td>
                                <td>{{ $pluse->tipo->tipo }}</td>
                                <td>{{ $pluse->descripcion }}</td>
                                <td>$ {{ number_format($pluse->monto,2,",",".") }}</td>
                                <!--td with button for delete pluse-->
                                <td>
                                    <button class="btn btn-danger btn-sm" wire:click="deletePlus({{ $pluse->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            <!--tr for new pluse-->
                            <tr>
                                <td>
                                    <input type="date" class="form-control" wire:model="fechaPlus">
                                    @error('fechaPlus')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" wire:model="user_idPlus">
                                        <option value="">Seleccione un empleado</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_idPlus')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" wire:model="tipoidPlus">
                                        <option value="">Seleccione un tipo</option>
                                        @foreach ($plusTipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo_idPlus')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model="descripcionPlus">
                                </td>
                                <td>
                                    <input type="number" class="form-control" wire:model="montoPlus">
                                    @error('montoPlus')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" wire:click="agregarPlus">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

</div>