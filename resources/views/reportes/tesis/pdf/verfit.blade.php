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
                <td style="text-align: center;">ESCUELA DE {{$datosfit[0]->escuela_name}}</td>
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
       
        <table width="100%" cellspacing="0" cellspacing="1" align="center">
            <tr>
                <td> <strong>NOMBRE COMPLETO:</strong>  {{$datosfit[0]->nombre_int1}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td> <strong>RUT:</strong>  {{$datosfit[0]->rut_int1}}</td>
                <td> <strong>AÑO DE INGRESO:</strong>  {{$datosfit[0]->ingreso_int1}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td> <strong>CARRERA:</strong>  {{$datosfit[0]->escuela_name}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td> <strong>EMAIL:</strong>  {{$datosfit[0]->email_int1}}</td>
                <td> <strong>TELEFONO:</strong>  {{$datosfit[0]->telefono_int1}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellspacing="1" align="center">
            <tr>
                <td style="text-align: justify;"> <strong>NOMBRE TESIS/MEMORIA:</strong>  {{$datosfit[0]->titulo}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: justify;"> <strong>BREVE DESCRIPCION DEL TEMA:</strong>  {{$datosfit[0]->objetivo}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: justify;"> <strong>OBJETIVOS:</strong>  {{$datosfit[0]->objetivo}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: justify;"> <strong>CONTRIBUCION ESPERADA:</strong>  {{$datosfit[0]->contribucion}}</td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellspacing="1" align="center">
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">FIRMA ALUMNO</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>FECHA:..../..../.....-</td>
            </tr>
        </table>

        <div style="page-break-after:always;"></div>

        <table width="100%" cellspacing="0" cellspacing="1" align="center">
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td> <strong>PROFESOR GUIA:</strong>  {{$datosfit[0]->pg_fullname}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td> <strong>COMISION SUGERIDA POR EL PROFESOR GUIA:</strong> </td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td> <strong>1.-</strong>  {{$datosfit[0]->p1_fullname}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td> <strong>2.-</strong>  {{$datosfit[0]->p2_fullname}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td> <strong>3.-(EXTERNOS U OTROS SI ES REQUERIDO. INDICAR CORREOS E INSTITUCION EN CASO DE SER EXTERNO):</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td><strong>NOMBRE:</strong> {{$datosfit[0]->p_externo}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td> <strong>CORREO:</strong>  {{$datosfit[0]->correo_p_externo}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td> <strong>INSTITUCION:</strong>  {{$datosfit[0]->institucion_p_externo}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>

        </table>
        <table width="100%" cellspacing="0" cellspacing="1" align="center">
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">FIRMA PROFESOR GUIA</td>
                <td style="text-align: center;">FIRMA DIRECTOR DE ESCUELA</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">FECHA:...../...../......-</td>
                <td style="text-align: center;">FECHA:...../...../......-</td>
            </tr>
        </table>
        <br>
        <table width="100%" cellspacing="0" cellspacing="1" align="center">
            
            <tr>
                <td style="text-align: center;">*************************************************************************</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">(A COMPLETAR POR EL DIRECTOR DEL DEPARTAMENTO)</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellspacing="1" align="center">
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>OBSERVACIONES DEL DIRECTOR DE DEPARTAMENTO:</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style="text-align: left;">FIRMA DIRECTOR DEL DEPARTAMENTO</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style="text-align: left;">FECHA:...../...../......-</td>
            </tr>
        </table>
    </div>
    
</body>
</html>