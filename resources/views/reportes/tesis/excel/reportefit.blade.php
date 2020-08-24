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
            <th>Titulo</th>
            <th>Alumno</th>
            <th>Tipo</th>
            <th>Vinculacion</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Rut</th>
            <th>Estado</th>
            <th>Fecha ingreso</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reportefit as $datatesis)
            <tr>
                <td>{{ $datatesis->titulo }}</td>
                <td>{{ $datatesis->nombre_int1 }}</td>
                <td>{{ $datatesis->tipo }}</td>
                <td>{{ $datatesis->namevinculacion }}</td>
                <td>{{ $datatesis->email_int1 }}</td>
                <td>{{ $datatesis->telefono_int1 }}</td>
                <td>{{ $datatesis->rut_int1 }}</td>
                <td>{{ $datatesis->estado }}</td>
                <td>{{ $datatesis->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
</body>
</html>