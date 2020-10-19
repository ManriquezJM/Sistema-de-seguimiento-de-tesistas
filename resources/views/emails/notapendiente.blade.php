<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<p>Hola, con fecha y hora {{$DatosEmail->fecha}} el alumno {{$DatosEmail->full_name}} con rut {{$DatosEmail->rut_int1}} ha registrado una solicitud de nota pendiente con
     fecha propuesta {{$DatosEmail->fechapropuesta}}. </p>

    <ul>
        <p>Sistema de administracion de tesistas</p>
        <p>Universidad Catolica Del Maule</p>
    </ul>
    
</body>
</html>