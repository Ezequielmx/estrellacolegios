<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Concurrencia y control de alumnos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .logo {
            display: block;
            margin: 0 auto;
            width: 150px;
            height: 150px;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }

        .total span {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="logo" src="{{ public_path('images/logo.png') }}" alt="Logo">
        <h1>Concurrencia y control de alumnos</h1>
        <table>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
            </tr>
            <tr>
                <td>Servicio del Planetario Móvil</td>
                <td>{{ $alumnos }}</td>
            </tr>
            <tr>
                <td>Total abonado</td>
                <td>{{ $cobrado }}</td>
            </tr>
        </table>
        <div class="total">
            Total: <span>{{ $cobrado }}</span>
        </div>
    </div>
</body>
</html>
