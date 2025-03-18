<!doctype html>
<html lang="es">

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
            <?php $anio= date('Y'); ?>
            <thead class="cabecera">                    
                <th class="cabfsol" style="text-align:left">Fecha Solicitud:</th>
                <th class="cabfsol2" style="text-align:center">{{$examen->fec_soli}}</th>
                <th class="cabnex" style="text-align:left">Nº Examen:</th>
                <th class="cabnex2" style="text-align:center">{{$examen->num_examens}}-C{{$anio}}</th>
                <th class="cabfres" style="text-align:left">Fecha Resultado:</th>
                <th class="cab2" style="text-align:center">{{$examen->fec_results}}</th>
            </thead>        
        </table>
        <table class="table table-striped">
            <thead class="cabecera">                    
                <th class="cabregional" style="text-align:left">Municipio:</th>
                <th class="cabregional2" style="text-align:center">{{$examen->municipios}}</th>                                          
                <th class="cabestablecimiento" style="text-align:left">Establecimiento:</th>
                <th class="cabestablecimiento2" style="text-align:center" colspan="3">{{$examen->establecimientos}}</th>          
            </thead>  
        </table>

        <table class="table table-striped numsolicitud">      
            <tr>
                <th style="text-align: left">CI:</th>
                <th style="text-align: left">Nombre(s):</th>
                <th style="text-align: left">Apellidos:</th>
                <th style="text-align: left">Fecha de nacimiento:</th>
                <th style="text-align: left" style=" margin-left: -15px;">Edad:</th>
            </tr>  
            <tr>
                <td style="text-align: left">{{$examen->ci}}</td>
                <td style="text-align: left">{{$examen->nombre}}</td>
                <td style="text-align: left">{{$examen->apellido}}</td>
                <td style="text-align: left">{{$examen->fec_naci}}</td>
                <td style="text-align: left">{{$examen->edades}}</td>
            </tr>  
        </table>
            <h4 class="text-left">RESULTADOS:</h4>
            <div class="c" style="font-size: 17px; vertical-align: middle;">
                <div class="row ml-2 mt-2">
                    <label for=""> <span class="fw-bolder font-weight-bold">Medico:</span> {{ $examen->medicos}}  </label>
                  </div>
                  <div class="row ml-2 mt-2">
                    <label for=""> <span class="fw-bolder font-weight-bold">Servicio:</span> {{ $examen->servicios}} </label>
                  </div>
                  <div class="row ml-2 mt-2">
                    <label for=""> <span class="fw-bolder font-weight-bold">Diagnostico:</span> {{ $examen->diag}} </label>
                  </div>
                  <div class="row ml-2 mt-2">
                    <label for=""> <span class="fw-bolder font-weight-bold">Datos relevantes:</span> {{ $examen->dato}} </label>
                  </div>
                  <div class="row ml-2 mt-2">
                    <label for=""> <span class="fw-bolder font-weight-bold">Descripcion:</span> {{ $examen->des}} </label>
                  </div>
                  <div class="row ml-2 mt-2">
                    <label for=""> <span class="fw-bolder font-weight-bold">Conclucion:</span> {{ $examen->con}} </label>
                  </div>
                  <div class="row ml-2 mt-2">
                    <label for=""> <span class="fw-bolder font-weight-bold">Nota:</span> {{ $examen->notas}}</label>
                  </div>
            </div>
        
            <br><br><br><br>
        <table>
            <div class="text-center">
                <h4  style="text-align:center; font-size: 12px;">CITOTECNÓLOGO(A)</h4>   
            </div>   
        </table> 
        <br><br><br><br> 

    <script src="{{ asset("assets/librerias/bootstrap4/js/popper.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("assets/librerias/bootstrap5/js/bootstrap.min.js")}}" type="text/javascript"></script> 

</body>

</html>
