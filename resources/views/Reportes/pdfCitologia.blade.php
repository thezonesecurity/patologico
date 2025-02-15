<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{ asset("assets/librerias/bootstrap5/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <style>
    .cabecera{
        background-color: #E0E0E0;
        color: black;
        }
        .numsolicitud {
            border-top: 6px double black; /* Borde superior doble */
            border-bottom: 2px solid black; /* Borde inferior simple */
            text-align: left;
        }
        .establecim{
            border-top: 2px solid black; /* Borde superior doble */
        }
        .cabnsol{
            text-align: left;
            /*font-size: 16px; /* Ajusta el tamaño de texto según tus preferencias */
            width: 90px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #ECECEC;
            color: black;
        }
        .cabnsol2{    
            width: 45px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #FFFFFF;
            color: black;
        }
        .cabfsol{    
            width: 115px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #ECECEC;
            color: black;
        }
        .cabfsol2{    
            width: 95px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #FFFFFF;
            color: black;
        }
        .cabnex{    
            width: 86px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #ECECEC;
            color: black;
        }
        .cabnex2{    
            width: 60px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #FFFFFF;
            color: black;
        }
        .cabfres{    
            width: 120px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #ECECEC;
            color: black;
        }
        .cab2{
            background-color: #FFFFFF;
            color: black;
        }
        .cabregional{    
            width: 70px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #ECECEC;
            color: black;
        }
        .cabregional2{    
            width: 120px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #FFFFFF;
            color: black;
        }
        .cabdistrito{    
            width: 70px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #ECECEC;
            color: black;
        }
        .cabdistrito2{    
            width: 90px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #FFFFFF;
            color: black;
        }
        .cabestablecimiento{    
            width: 70px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #ECECEC;
            color: black;
        }
        .cabestablecimiento2{    
            width: 900px; /* Ajusta el tamaño de la caja según tus preferencias */
            background-color: #FFFFFF;
            color: black;
        }
        .hola {
            border: 1px solid black; /* Línea cuadriculada */
            padding: 8px; /* Añade espacio interno para mejorar la apariencia */
            text-align: left;
        }

        .logo-cell {
            width: 20%;
        }

        .text-cell {
            width: 80%;
        }

        tr.even {
            background-color: #f2f2f2; /* Color de fondo para filas pares */
        }
        tr.odd {
            background-color: #ffffff; /* Color de fondo para filas impares (puedes ajustar el color) */
        }



        h3.text-center:first-child {
            margin-bottom: 0;
        }

        h3.text-center:last-child {
            margin-top: 0;
        }
        @page{
        margin: 0.5cm 1cm;  
        }

    </style>

</head>
<body>
    @foreach($resultado as $examenes)
       
    <table style="width: 100%; border-top: 2px solid black;">
        <tr >
            <th rowspan="3"  style="float: center"><img src="{{asset("assets/img/hdb.jpg")}}" width="110px" height="90px"></th>      
            <th class="text-center" style="margin-bottom: 0; vertical-align: middle;">SERVICIO DE DIAGNOSTICO MEDICO DE</th>            
        </tr>
        <tr>      
            <th class="text-center" style="margin-top: 0; vertical-align: down;">ANATOMIA PATOLOGICA - CITOLOGIA</th>      
        </tr>
        <tr>      
            <th class="text-center" style="margin-top: 0;">Resultado Informe Patológico - Citologico
            </th>     
        </tr>
    </table>
    <!--<div style="text-align: center;">
        <img src="images/HBhospitalamigo.jpg" alt="" width="100px" height="100px" style="float: left;">      
        <br><br>
    </div>
        <h3 class="text-center" style="margin-bottom: 0;">SERVICIO DE DIAGNOSTICO MEDICO DE</h3>
        <h3 class="text-center" style="margin-top: 0;">ANATOMIA PATOLOGICA - CITOLOGIA</h3>
        <h3 class="text-center" style="margin-top: 0;">Resultado Informe Patológico</h3>
        <br>-->
        <table class="table table-striped numsolicitud">
            <thead class="cabecera">                    
                <th class="cabfsol" style="text-align:left">Fecha Solicitud:</th>
                <th class="cabfsol2" style="text-align:center">{{$examenes->examen_solCitologia->fecha_solicitud}}</th>
                <th class="cabnex" style="text-align:left">Nº Examen:</th>
                <th class="cabnex2" style="text-align:center">{{$examenes->num_examen}}-{{-2023}}</th>
                <th class="cabfres" style="text-align:left">Fecha Resultado:</th>
                <th class="cab2" style="text-align:center">{{$examenes->fecha_resultado}}</th>
            </thead>        
        </table>
        <table class="table table-striped">
            <thead class="cabecera">                    
                <th class="cabregional" style="text-align:left">Municipio:</th>
                <th class="cabregional2" style="text-align:center">{{$examenes->examen_solCitologia->solicitudCito_municipios->nombre_municipio}}</th>                                          
                <th class="cabestablecimiento" style="text-align:left">Establecimiento:</th>
                <th class="cabestablecimiento2" style="text-align:center" colspan="3">{{$examenes->examen_solCitologia->solicitudCito_establecimientos->nombre_establecimiento}}</th>          
            </thead>  
        </table>

        <table class="table table-striped numsolicitud">      
            <tr>
                <th style="text-align: left">CI:</th>
                <th style="text-align: left">Nombre(s):</th>
                <th style="text-align: left">Apellidos:</th>
                <th style="text-align: left">Edad:</th>
            </tr>  
            <tr>
                <td style="text-align: left">{{$examenes->examen_citoPacientes->ci}}</td>
                <td style="text-align: left">{{$examenes->examen_citoPacientes->nombre}}</td>
                <td style="text-align: left">{{$examenes->examen_citoPacientes->apellido}}</td>
                <td style="text-align: left">{{$examenes->examen_citoPacientes->edad}}</td>
            </tr>  
        </table>
            <h4 class="text-left">RESULTADOS:</h4>
            <table class="table table-striped">
                <thead class="cabecera numsolicitud">
                    <tr>
                        <th style="text-align: center">Código</th>
                        <th style="text-align: center">Descripcion del Diagnóstico</th>              
                    </tr>            
                </thead>
                <tbody>
                    <?php  $resultadoExamenes=App\Models\Examen::where('paciente_id',$examenes->paciente_id)->get();  ?>
                   
                    @if (count($resultadoExamenes) > 0)
                        <?php  
                                $diagnosticos = DB::table('sispatologico.resultados as R')
                                ->select( 'D.id','D.codigo_diagnostico','D.descripcion_diagnostico') // 'R.id','R.examen_id','R.diagnostico_id','R.fecha_resultado')
                                ->join('sispatologico.diagnosticos as D', 'D.id', '=', 'R.diagnostico_id')
                                ->where('R.examen_id', '=', $resultadoExamenes[0]->num_examen)
                                ->where('R.estado','TRUE')
                                ->get();
                        ?>
                        @foreach($diagnosticos as $item)
                            <tr >
                                <td class="min-width" style="text-align: center; font-size: 12px; vertical-align: middle; height: 10px;">
                                    <p>{{$item->codigo_diagnostico}}</p>
                                </td>
                                <td class="min-width" style="font-size: 12px; vertical-align: middle; height: 10px;">
                                    <p>{{$item->descripcion_diagnostico}}</p>
                                </td>
                            </tr>
                        @endforeach   
                    @else
                        <tr >
                            <td class="min-width" style="text-align: center; font-size: 12px; vertical-align: middle; height: 10px;">
                                <p>No existe</p>
                            </td>
                            <td class="min-width" style="font-size: 12px; vertical-align: middle; height: 10px;">
                                <p>No existe</p>
                            </td>
                        </tr>
                    @endif

                              
                </tbody>
            </table><br><br><br><br>
        <table>
            <h4 class="text-center" style="text-align:center; font-size: 12px;">CITOTECNÓLOGO(A)</h4>        
        </table>  
    @endforeach

    <script src="{{ asset("assets/librerias/bootstrap4/js/popper.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("assets/librerias/bootstrap5/js/bootstrap.min.js")}}" type="text/javascript"></script> 

</body>

</html>
{{--
< ?php  $resultadoExamenes=App\Models\Examen::where('paciente_id',$examenes->paciente_id)->get(); 
$diagnosticos = DB::table('sispatologico.resultados as R')
->select( 'D.id','D.codigo_diagnostico','D.descripcion_diagnostico') // 'R.id','R.examen_id','R.diagnostico_id','R.fecha_resultado')
->join('sispatologico.diagnosticos as D', 'D.id', '=', 'R.diagnostico_id')
->where('R.examen_id', '=', $resultadoExamenes[0]->num_examen)
->where('R.estado','TRUE')
->get();
?>
{{ --dd($resultadoExamenes->examenesResultados)-- }}
@foreach($diagnosticos as $item)
<tr >
<td class="min-width" style="text-align: center; font-size: 12px; vertical-align: middle; height: 10px;">
    <p>{{$item->codigo_diagnostico}}</p>
</td>
<td class="min-width" style="font-size: 12px; vertical-align: middle; height: 10px;">
    <p>{{$item->descripcion_diagnostico}}</p>
</td>
</tr>
@endforeach   
--}}