<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Recibo</title>
    <style>
        #header:after {
            content: '';
            display: block;
            clear: both
        }

    </style>
</head>

<body>
    <div id="container" style="font: 13px/1.4em 'Open Sans', sans-serif;
    padding: 40px;">
        <section id="header" style="padding-bottom: 20px; border-bottom: 1px solid #e2e2e2;">
            <div class="logo" style="float: left;
            margin-right: 20px; 
            margin-bottom: 3px" >
                <img style="height: 100px; width:auto" src="{{ asset('storage/logo.jpg') }}">
            </div>
            <div class="company-info1" style="float: left">
                <div style="font-weight: bold;
                font-size: 20px">Estrella del Plata</div>
                <div style="font-weight:500; font-size: 15px;">Planetario Móvil</div>
                <br>
                <div>info@estrelladelplata.com.ar</div>
                <div>www.estrelladelplata.com.ar</div>
            </div>
            <div class="company-info2" style="            float: right;
            text-align: right">
                <div style="font-weight: bold; font-size: 20px; margin-bottom: 3px">RECIBO</div>
                <div>N° 0000-{{ $servicio->id }}</div>
                <br>
                <div style="display: flex;justify-content: flex-end;">
                    <div style="margin: auto 10px">
                        Fecha
                    </div>
                    <div>
                        <table style="border: 1px solid #e2e2e2; text-align: right;             border-collapse: collapse;
                        border-spacing: 0">
                            <tr>
                                <td style="border: 1px solid #e2e2e2; padding: 5px;">21</td>
                                <td style="border: 1px solid #e2e2e2; padding: 5px;">04</td>
                                <td style="border: 1px solid #e2e2e2; padding: 5px;">2023</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="text" style="padding: 20px;
            font-family: monospace;
            font-size: 16px;
            line-height: 38px;
            border-bottom: 1px solid #e2e2e2;">
                En el día de la fecha se reciben de la institución 
                <span style="font-weight: bold;">{{ $servicio->establecimientos->first()->nombre }}</span> 
                de la ciudad de <span style="font-weight: bold;">{{ $servicio->establecimientos->first()->ciudad }}</span>
                la suma de pesos <span style="font-weight: bold;">{{ number_format($servicio->cobrado, 0, '.', ',') }}</span> (pesos {{ $servicio->cobradoTxt() }})
                en concepto de servicio de Planetario Movil, realizado en la instutución con la asistencia de 
                <span style="font-weight: bold;"> {{ $servicio->alumnos_ing }} alumnos</span>.
                <br>
        </section>
    </div>