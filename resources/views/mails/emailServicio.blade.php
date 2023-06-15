<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Servicio de interés</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* .card {
            border: 1px solid #cccccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            background: rgb(252, 207, 124);
        }

        .card-image {
            width: 100px;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .card-content {
            flex-grow: 1;
        } */

        h1, h2 {
            color: #333333;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        p {
            color: #555555;
            margin-bottom: 15px;
        }

        .signature {
            margin-top: 30px;
        }

        .signature p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{$servicio->nombre}}</h1>
        <p>Estimado/a {{$cliente->nombre}} {{$cliente->apellido}},</p>

        <p>Gracias por mostrar interés en nuestro servicio. Nos complace informarte que tenemos justo lo que estás buscando.</p>

        <img src="{{ $message->embed($servicio->imagen) }}" alt="Imagen del Servicio" style="width: 100%;" class="rounded">

        {{-- <div class="card">
            <div class="card-content">
                <h2>Detalles del servicio:</h2>
                <p><strong>Nombre:</strong> {{$servicio->nombre}}</p>
                <p style="width: 100%"><strong>Descripción:</strong> {{$servicio->descripcion}}</p>
                <p><strong>Precio:</strong> {{$servicio->facturacion}}</p>
                <p><strong>Ciudad:</strong> {{$servicio->ciudad}}</p>
                <p><strong>Fecha:</strong> {{$servicio->fecha}}</p>
            </div>
        </div> --}}
        <div class="card" style="background: rgb(252, 207, 124);">
            <div class="card-body" style=" margin-left: 8px;">
                <h3 class="card-title">Detalles del servicio:</h3>
                <h4 class="card-subtitle mb-2 text-body-secondary"><strong>Nombre:</strong> {{$servicio->nombre}}</h4>
                <p class="card-text"><strong>Descripción:</strong> {{$servicio->descripcion}}</p>
                <p class="card-text"><strong>Precio:</strong> {{$servicio->facturacion}}</p>
                <p class="card-text"><strong>Ciudad:</strong> {{$servicio->ciudad}}</p>
                <p class="card-text"><strong>Fecha:</strong> {{$servicio->fecha}}</p>
            </div>
          </div>

        <p>No dudes en contactarnos si tienes alguna pregunta o si deseas más información sobre este servicio. Estamos aquí para ayudarte.</p>

        <div class="signature">
            <p>Atentamente, {{$dueño->nombre}} {{$dueño->apellido}}</p>
            <p>Correo: {{$dueño->email}}</p>
            <p>Telefono: {{$dueño->telefono}}</p>
            <p>El Equipo del Servicio</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>