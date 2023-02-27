<div>
    @foreach ($servicio->establecimientos as $establecimiento)
    <div class="row" style="align-items: flex-end;">
        <div class="col">
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
            <button class="btn btn-danger" type="button" wire:click="$emit('deleteEstabl', {{ $establecimiento->id }})"
                {{ $servicio->establecimientos->count()==1? 'disabled': '' }}>
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
                    <input class="form-control" value="{{ $establecimiento->tel }}" disabled>
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
                    <input class="form-control"  wire:model="cueNew">
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
                <input class="form-control"  wire:model="deptoNew" disabled>
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