<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <title>memorandum revision alumno {{$datosmemo[0]->Anombres}}</title>
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
            padding: 2.5rem;
            padding-top: .2.5rem;
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
    
        <table width="90%" cellspacing="0" cellspacing="1" align="center">

            <tr>
                <td WIDTH="200">
                <img src="{{$logo}}" alt="Logo UCM" class="logo", width="200" height="80">
                </td>
                <td >FACULTAD DE CIENCIAS DE LA INGENIERIA <br> ESCUELA DE {{$datosmemo[0]->escuelaname}}</td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellspacing="1" align="center">
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center;">MEMORANDUM REVISION DE TESIS</td>
            </tr>
        </table>
        <br>
        <br>
       
        <table width="90%" cellspacing="1" cellspacing="1" align="center">
            <tr>
                <td width="50">A  :  </td>
                <td>{{$datosmemo[0]->P1nombres}} <br> {{$datosmemo[0]->P2nombres}} </td>
            </tr>
            <tr>
                <td></td>
                <td>{{$datosmemo[0]->p_externo}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>DE :</td>
                <td>MG. Roberto Ahumada Garcia <br>Coordinador de Tesis y Memoria</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>Ref. </td>
                <td>Envia tesis a revision de alumno {{$datosmemo[0]->Anombres}}</td>
            </tr>
            <tr>
                <td style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td>Fecha :</td>
                <td>TALCA, {{$datosmemo[0]->fechainicial}}</td>
            </tr>
            <br>
        </table>

            <table width="90%" cellspacing="0" cellspacing="1" align="center">
                <tr>
                    <td>__________________________________________________________________________________________</td>
                </tr>
                <tr>
                    <td>Estimado Docente:</td>
                </tr>
                <tr>
                    <td style="text-align: center;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: justify;">Junto con saludarle, y como integrante de la comision de examen de Titulo "{{$datosmemo[0]->titulo}}", del alumno
                        {{$datosmemo[0]->Anombres}}, rut {{$datosmemo[0]->rut_int1}}, quisiera solicitar a Ud. que una vez que recepcionado el documento, en el plazo de 
                        15 dias habiles ({{$datosmemo[0]->fechafinal}}), entregue el informe de evaluacion de este trabajo al profesor guia, {{$datosmemo[0]->Pnombres}}.</td>
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
                    <td style="text-align: center;">A la espera de una favorable recepcion y respuesta, saluda atentamente a usted,</td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellspacing="1" align="center">
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
                    <td>_________________________________</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="text-align: left;">MG.-ROBERTO AHUMADA GARCIA</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="text-align: left;">Coordinador de Tesis y Memorias</td>
                </tr>
            </table>

    </div>
    
</body>
</html>