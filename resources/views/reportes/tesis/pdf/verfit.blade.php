<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <title>fit del alumno {{$datosfit[0]->nombre_int1}}</title>
    <style>
        @page{
            margin: 1.3rem;
            margin-top:1.9rem;
            padding: 1rem;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: "Times New Roman", Times, serif;
        }
        .cabecera {
            background-color: #FEFEFE;
            color: #000000;
            padding: 2rem;
            padding-top: .2rem;
            padding-bottom: 0px;
        }
        .cabecera .logo{
            margin: 5px;
        }
        .cabecera table {
            padding: 1px;
            margin-bottom: .2rem;
        }
        table {
            font-size: small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
    </style>


</head>
<body>
    <div class="cabecera">
    
        <table width="100%" cellspacing="0" cellspacing="1" align="center">
            <tr>
                <td style="text-align: center;">UNIVERSIDAD CATOLICA DEL MAULE</td>
            </tr>
            <tr>
                <td style="text-align: center;">FACULTAD DE CIENCIAS DE LA INGENIERIA</td>
            </tr>
            <tr>
                <td style="text-align: center;">ESCUELA DE INGENIERIA CIVIL INFORMATICA</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">FORMULARIO DE INSCRIPCION DE TEMA DE TESIS Y MEMORIAS DE TITULO</td>
            </tr>
        </table>
        <br>
        <br>
       
        <table width="100%" cellspacing="1" cellspacing="1" align="center">
            <tr>
                <td>Nombre Completo: {{$datosfit[0]->nombre_int1}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>Rut: {{$datosfit[0]->rut_int1}}</td>
                <td>Año de ingreso: {{$datosfit[0]->ingreso_int1}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>Carrera: {{$datosfit[0]->carrera}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>Email: {{$datosfit[0]->email_int1}}</td>
                <td>Telefono: {{$datosfit[0]->telefono_int1}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>Nombre Tesis/Memoria: {{$datosfit[0]->titulo}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>Objetivos: {{$datosfit[0]->objetivo}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>Contribucion esperada: {{$datosfit[0]->contribucion}}</td>
            </tr>
        </table>


    </div>
    
</body>
</html>