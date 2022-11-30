
    <div class="row">
        <div class="col">
            {!! Form::label('fecha_venta', 'Fecha de Venta') !!}
            {!! Form::date('fecha_venta', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Fecha de Venta']) !!}
            @error('fecha_venta')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col">
            {!! Form::label('fecha_ini_serv', 'Fecha de Inicio Servicio') !!}
            {!! Form::date('fecha_ini_serv', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Inicio']) !!}
            @error('fecha_ini_serv')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col">
            {!! Form::label('fecha_fin_serv', 'Fecha de Fin Servicio') !!}
            {!! Form::date('fecha_fin_serv', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Fin']) !!}
        </div>

        <div class="col">
            <div class="form-group">
                {!! Form::label('estado_id', 'Estado') !!}
                {!! Form::select('estado_id', $estados, null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    
    <hr>
    {!! Form::label('cont_1', 'Contacto 1') !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::text('cont_1', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::text('puesto_cont_1', null, ['class' => 'form-control', 'placeholder' => 'Puesto']) !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::text('cel_cont_1', null, ['class' => 'form-control', 'placeholder' => 'Celular']) !!}
            </div>
        </div>
    </div>
    

    {!! Form::label('cont_2', 'Contacto 2') !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::text('cont_2', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::text('puesto_cont_2', null, ['class' => 'form-control', 'placeholder' => 'Puesto']) !!}
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::text('cel_cont_2', null, ['class' => 'form-control', 'placeholder' => 'Celular']) !!}
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-3">
            {!! Form::label('Matricula Jardín') !!}
            <div class="form-group row">
                {!! Form::label('matricula_tmj', 'Mañana', ['class' => 'col-sm-4 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('matricula_tmj', null , ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('matricula_ttj', 'Tarde', ['class' => 'col-sm-4 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('matricula_ttj', null , ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('matricula_tnj', 'Noche', ['class' => 'col-sm-4 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('matricula_tnj', null , ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            {!! Form::label('Matricula Primaria') !!}
            <div class="form-group row">
                {!! Form::label('matricula_tmp', 'Mañana', ['class' => 'col-sm-4 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('matricula_tmp', null , ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('matricula_ttp', 'Tarde', ['class' => 'col-sm-4 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('matricula_ttp', null , ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('matricula_tnp', 'Noche', ['class' => 'col-sm-4 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('matricula_tnp', null , ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            {!! Form::label('Matricula Secundaria') !!}
            <div class="form-group row">
                {!! Form::label('matricula_tms', 'Mañana', ['class' => 'col-sm-4 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('matricula_tms', null , ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('matricula_tts', 'Tarde', ['class' => 'col-sm-4 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('matricula_tts', null , ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('matricula_tns', 'Noche', ['class' => 'col-sm-4 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('matricula_tns', null , ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            {!! Form::label('Horario Servicio') !!}
            <div class="form-check form-switch">
                <label>
                    @isset($servicio)
                        @if ($servicio->servicio_tm==0)
                            {!! Form::checkbox('servicio_tm', null, null) !!}
                        @else
                            {!! Form::checkbox('servicio_tm', null, 'checked') !!}
                        @endif
                    @else
                        {!! Form::checkbox('servicio_tm', null, null) !!}
                    @endisset
                    Mañana
                </label>
            </div>

            <div class="form-check form-switch">
                <label>
                    @isset($servicio)
                        @if ($servicio->servicio_tt==0)
                            {!! Form::checkbox('servicio_tt', null, null) !!}
                        @else
                            {!! Form::checkbox('servicio_tt', null, 'checked') !!}
                        @endif
                    @else
                        {!! Form::checkbox('servicio_tt', null, null) !!}
                    @endisset
                    Tarde
                </label>
            </div>

            <div class="form-check form-switch">
                <label>
                    @isset($servicio)
                        @if ($servicio->servicio_tn==0)
                            {!! Form::checkbox('servicio_tn', null, null) !!}
                        @else
                            {!! Form::checkbox('servicio_tn', null, 'checked') !!}
                        @endif
                    @else
                        {!! Form::checkbox('servicio_tn', null, null) !!}
                    @endisset
                    Noche
                </label>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('espacio_montaje_id', 'Espacio Montaje') !!}
                        {!! Form::select('espacio_montaje_id', $espacios, null, ['class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('planetario_id', 'Planetario') !!}
                        {!! Form::select('planetario_id', $planetarios, null, ['class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('asesor_id', 'Asesor') !!}
                        {!! Form::select('asesor_id', $asesores, null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    {!! Form::label('observaciones', 'Observaciones') !!}
                    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'placeholder' => 'Observaciones']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('precio_alumno', 'Precio por alumno') !!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    {!! Form::number('precio_alumno', null, ['class' => 'form-control', 'placeholder' => 'Precio Alumno']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('precio_total', 'Precio Total') !!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    {!! Form::number('precio_total', null, ['class' => 'form-control', 'placeholder' => 'Precio Total']) !!}
                </div>
            </div>           
        </div>
    </div>

    {!! Form::text('establecimiento_id', $establecimiento->id, ['class' => 'd-none']) !!}