@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
<div class="card">
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>
<div class="leyenda_lineas">
    <div class="card">
        <div class="card-body" style="padding: 10px; box-shadow: 0 0 10px #5f5f5f;">
            @foreach ($lineas as $linea)
            <div class="row">
                <div class="col">
                    <div class="color" style="background-color: {{$linea->color}}">
                        {{$linea->nombre}}
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col">
                    <div class="color" style="background-color: white; color:#363636; border: 1px solid rgb(141, 141, 141)">
                        ⭕ Grande
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="color" style="background-color: white; color:#363636; border: 1px solid rgb(141, 141, 141)">
                        ❌ Mediano
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="color" style="background-color: white; color:#363636; border: 1px solid rgb(141, 141, 141)">
                        ❗ Chico
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="leyenda_estados">
    <div class="card">
        <div class="card-body" style="padding: 10px; box-shadow: 0 0 10px #5f5f5f;">
            <div class="row">
                <div class="col ley_est">VENDIDO </div>
                <div class="col" style="max-width: 30px; padding-left:0">
                    <div class="estado_color" style="background-color:  #ffffff; color:  #ffffff; padding:5px">.</div>
                </div>
            </div>
            <div class="row">
                <div class="col ley_est">WPP ENVIADO </div>
                <div class="col" style="max-width: 30px; padding-left:0">
                    <div class="estado_color" style="background-color:  #f0f182; color:  #f0f182; padding:5px">.</div>
                </div>
            </div>
            <div class="row">
                <div class="col ley_est">WPP CONFIRM </div>
                <div class="col" style="max-width: 30px; padding-left:0">
                    <div class="estado_color" style="background-color:  #82f1eb; color:  #82f1eb; padding:5px">.</div>
                </div>
            </div>
            <div class="row">
                <div class="col ley_est">WPP LLAMAR </div>
                <div class="col" style="max-width: 30px; padding-left:0">
                    <div class="estado_color" style="background-color:  #f59a5d; color:  #f59a5d; padding:5px">.</div>
                </div>
            </div>
            <div class="row">
                <div class="col ley_est">CONFIRMADO</div>
                <div class="col" style="max-width: 30px; padding-left:0">
                    <div class="estado_color" style="background-color:  #8bd475; color:  #8bd475; padding:5px">.</div>
                </div>
            </div>
            <div class="row">
                <div class="col ley_est">LISTO</div>
                <div class="col" style="max-width: 30px; padding-left:0">
                    <div class="estado_color" style="background-color:  #0099ff; color:  #0099ff; padding:5px">.</div>
                </div>
            </div>
            <div class="row">
                <div class="col ley_est">REALIZADO</div>
                <div class="col" style="max-width: 30px; padding-left:0">
                    <div class="estado_color" style="background-color:  #047a31; color:  047a31; padding:5px">.</div>
                </div>
            </div>
            <div class="row">
                <div class="col ley_est" >CAIDA</div>
                <div class="col" style="max-width: 30px; padding-left:0">
                    <div class="estado_color" style="background-color:  #da4343; color:  #da4343; padding:5px">.</div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@stop
@push('js')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
          const calendarEl = document.getElementById('calendar');

          const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            themeSystem: 'bootstrap5',
            events: @json($events),
            eventOrder: 'linea,title',
            
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'dayGridYear,dayGridMonth' // user can switch between the two
            },
            businessHours: {
                // days of week. an array of zero-based day of week integers (0=Sunday)
                daysOfWeek: [ 1, 2, 3, 4, 5 ] // Monday - Thursday
            }
          });

          calendar.render();
          

        });
  
</script>
@endpush