<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th>Nombre Alumno1</th>
            <th>Rut Alumno1</th>
            <th>Nombre Alumno2</th>
            <th>Rut Alumno2</th>
            <th>Profesor Tutor</th>
            <th>Tipo</th>
            <th>Fecha ultima Bitacora</th>
            <th>Comentario bitacora</th>
            <th>Fecha ultimo Avance </th>
            <th>Estado</th>
            <th>Fecha Aceptacion de formulario</th>
            <th>Fecha Nota Pendiente</th>
            <th>Fecha Prorroga nota P</th>
            <th>Año que curso su ultimo ramo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reportefit as $datatesis)
            <tr>
                <td>{{ $datatesis->nombre_int1 }}</td>
                <td>{{ $datatesis->rut_int1 }}</td>
                <td>{{ $datatesis->nombre_int2 }}</td>
                <td>{{ $datatesis->rut_int2 }}</td>
                <td>{{ $datatesis->nombre_pt }}</td>
                <td>{{ $datatesis->tipo_trabajo }}</td>
                <td>{{ $datatesis->fecha_bitacora }}</td>
                <td>{{ $datatesis->comentario_bitacora }}</td>
                <td>{{ $datatesis->fecha_avance }}</td>
                <td>{{ $datatesis->estado }}</td>
                <td>{{ $datatesis->fecha_inscripcion }}</td>
                <td>{{ $datatesis->fecha_notap }}</td>
                <td>{{ $datatesis->prorroga_notap }}</td>
                <td>{{ $datatesis->fecha_ultimoramo }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
</body>
</html>