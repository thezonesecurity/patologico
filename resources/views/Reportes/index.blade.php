@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Reportes
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/librerias/Select2/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/librerias/datatables/dataTables.bootstrap4.min.css') }}">
<style>
    form label.error {
	float: left;
	color: red;
	font-weight: normal;
	padding-left: .5em;
	vertical-align: top; }
</style>
@stop

@section('contenido')  
@if (session('error'))
  <div class="alert alert-danger" role="alert">
    {{session('error')}}
  </div>
@endif

{{--  --}}
<div class="m-2">
    <form action="{{route('generar.reportes.index')}}" method="POST"  class="border border-5 border-info" id="form-list" autocomplete="off" target='_Blank'  >
        @csrf
        <h5 class="box-title text-center font-weight-bold ">Formulario de reportes</h5>
        <div class="row m-1">
            <div class="form-group col-md-2 col-sm-2 font-weight-bol" >
                <label  class="font-weight-bold ">Reporte</label><br>
                <input type="radio" name="reporte" id="solicitud" value="solicitud" class="ml-1" checked>
                <label class="form-check-label" for="exampleRadios1F">Solicitud</label>
                <input type="radio" name="reporte" id="resultado" value="resultado" class="ml-2">
                <label class="form-check-label" for="exampleRadios1M">Resultados</label>
            </div>
            <div class="form-group col-md-2 col-sm-2 font-weight-bold">
                <label for="formGroup_fecha ">Fecha <span id="seguido"></span> </label>
                <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha') }}">
                <small id="val_fecha" class="form-text text-danger"></small>
            </div>
            <div class="col-md-3 col-sm-3">
                <label class="font-weight-bold">Usuario</label>
                <select title="Seleccione una opcion" class="form-control custom-select select2 " name="user" id="user" style="width: 100%">
                    <option value="valor" disabled selected >Selecione una opcion</option> 
                    <option value="todos">Todos los usuarios</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{old('user') == $user->id ? 'selected' : ''}} >{{ $user->persona->nombres}} {{ $user->persona->apellidos}}</option>
                    @endforeach
                </select>
                <small id="val_user" class="form-text text-danger"></small>
            </div>
            <div class="col-md-2 col-sm-2">
                <label for="form_tipo_report">Tipo Reporte</label>
                <select class="form-control custom-select" style="width: 100%" name="tipo" id="tipo">
                    <option value="valor" disabled  selected>Selecione una opcion</option> 
                    <option value="U">Urbano</option>
                    <option value="R">Rural</option>
                    <option value="C">Citologia</option>
                </select>
                <small id="val_tipo" class="form-text text-danger"></small>
            </div>
            <div class="col-md-3 col-sm-3">
                <label for="formGroupExampleInput">Accion</label>
                <div class="row">
                    {{--<button type="submit" id="miEnlace" class="btn btn-outline-success btn-sm" >Imprimir</button>--}}
                    <button type="submit" id="imprimir" class="btn btn-outline-success btn-sm" >Imprimir</button>
                    {{--<a  id="enlaceEnviar" type="submit" class="btn btn-outline-success " href="{{route('generar.reportes.index')}}" target='_Blank' >Imprimir</a>
                   {{-- <button type="submit" class="btn btn-outline-success" target='_Blank'>Imprimir</button>  --}}
                    <button type="button"  id="templist" class="btn btn-outline-info btn-sm ml-2">Vista previa</button>
                    <button type="button"  id="cancelarBtn" class="btn btn-outline-secondary btn-sm ml-2"  style="display: non e;">Cancelar</button>
                </div>
               
            </div>
        
        </div>
    </form>
    @include('Reportes.lista_resultado')
    @include('reportes.confirmacionSolicitud')
    @include('Reportes.lista_solicitud')
    @include('reportes.modalVer')
    @include('reportes.modalVerCitologia')
    @include('reportes.confirmacionResultado')
   
</div>

@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/scripts/user/print/report.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/librerias/Select2/js/select2.js') }}"></script>
<script src="{{asset('assets/librerias/jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/librerias/datatables/jquery.dataTables.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Seleccione una opcion",
            allowClear: true,
            ancho : 'resolver'
        });        
    });
</script>
<script>
    $(document).ready(function() {
        let tabla;
        //PROCESO PARA MOSTRAR TABLA DE LA VISTA PREVIA 
        $("#templist").click(function(e){
            e.preventDefault();
            $('#lista_solicitud'). DataTable(). destroy();
            $('#listatemp_resultado'). DataTable(). destroy();
            var fecha = $('#fecha').val();
            //var user = $('#user :selected').text();  // var tipo = $('#tipo :selected').text();
            var user_id = $('#user').val();
            var tipo_id = $('#tipo').val();
           // console.log('user'+tipo_id);
            
            if (fecha  == '') {
               // notificaciones("Campo apellido vacio, registre un paciente !!", "ERROR DE FORMULARIO", 'error');
                $('#val_fecha').text('El campo fecha es requerido ...!!').show();
            }else{
                $('#val_fecha').text('El campo fecha es requerido ..!!').hide();
            }
            if (user_id == null) {
                $('#val_user').text('El campo usuario es requerido ...!!').show();
            }else{
                $('#val_user').text('El campo usuario es requerido ..!!').hide();
            }
            if (tipo_id == null) {
                $('#val_tipo').text('El campo tipo reporte es requerido ...!!').show();
            }else{
                $('#val_tipo').text('El campo tipo reporte es requerido ..!!').hide();
            }

            if (fecha != '' && user_id != null && tipo_id != null) {
                var formData = new FormData(document.getElementById("form-list"));
                $.ajax({
                    url:"{{route('lista.reportes.index')}}",
                    type:'POST',
                    dataType: "html",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData
                }).done(function(data){
                    //console.log('data-> '+data );
                    if(data != "sin_resultados"){
                        var data = JSON.parse(data);
                        var cuerpoTabla_resultado = $('#tablaLista_resultado');//para resultados
                        cuerpoTabla_resultado.empty();
                        var cuerpoTabla_solicitudes = $('#tablaLista_solicitud'); //para solicitudes
                        cuerpoTabla_solicitudes.empty();
                        data.forEach(function(datos, index) { // Iterar sobre los datos devueltos y agregarlos a la tabla
                           // console.log('data-> '+datos['reporte']);
                            if(datos['reporte'] == 'solicitud'){
                                $('#titulo').hide();
                                $('#listatemp_resultado').hide();
                                var nuevaFila = $('<tr>');
                                nuevaFila.append('<td>' + (index + 1) + '</td>');
                                nuevaFila.append('<td>' + datos.nro_examen +'-'+datos.tipo + '</td>');
                                nuevaFila.append('<td>' + datos.fecha_solicitud + '</td>');
                                nuevaFila.append('<td>' + datos.paciente + '</td>');
                                nuevaFila.append('<td>' + datos.cedula + '</td>');
                                nuevaFila.append('<td>' + datos.fecha_nacimiento + '</td>');
                                nuevaFila.append('<td>' + datos.edad + '</td>');
                                nuevaFila.append('<td>' + datos.municipio + '</td>');
                                nuevaFila.append('<td>' + datos.establecimiento + '</td>');
                                nuevaFila.append('<td>' + (datos.estado === true ? 'Habilitado' : 'Eliminado') + '</td>');
                                nuevaFila.append((datos.estado == true ? '<td> <button type="button" name="delete" id="' + datos.id + '" class="btn btn-outline-danger btn-sm btn_deleteS">Dar baja</button> </td>' : '<td> <button type="button" name="delete" id="' + datos.id + '" class="btn btn-danger btn-sm btn_deleteS" disabled >Dar baja</button> </td>'));
                               // nuevaFila.append('<td> <button type="button" name="delete" id="' + datos.id + '" class="btn btn-outline-danger btn-sm btn_deleteS">Dar baja</button> </td>');
        
                                cuerpoTabla_solicitudes.append(nuevaFila);
                                 //PROCESO PARA EL MODAL ELIMINAR UN REGISTRO
                                $(".btn_deleteS").click(function(e) {
                                    var id = $(this).attr('id');  // Usamos el ID del botón para saber qué examen mostrar
                                   // console.log('id ' + id);
                                    var examen = data.find(function(item) {  // Buscar el objeto de datos correspondiente con el mismo ID
                                        return item.id == id;
                                    });
                                   // $('#examen_id').text(examen.id); no usado
                                    $('#pac_mcs').text(examen.paciente);
                                    $('#nac_mcs').text(examen.fecha_nacimiento);
                                    $('#ci_mcs').text(examen.cedula);
                                    $('#examen_mcs').text(examen.nro_examen + '-' + examen.tipo);
                                    $('#fecha_mcs').text(examen.fecha_solicitud);
                                    $('#llave').val(examen.id);
                                    $('#tipoMS').val(examen.tipo);
                                    $('#fechaMS').val(examen.fecha_solicitud);
                                    $('#confirmarSolicitud').modal('show'); // Mostrar el modal
                                });
                                $('#titulo').text('Lista de reporte '+datos['reporte']).show();
                                $('#lista_solicitud').show();
                            }
                            else{ //para resultados
                                $('#titulo').hide();
                                $('#lista_solicitud').hide();
                                var nuevaFila = $('<tr>');
                                nuevaFila.append('<td>' + (index + 1) + '</td>');
                                nuevaFila.append('<td>' + datos.nro_examen +'-'+datos.tipo + '</td>');
                                nuevaFila.append('<td>' + datos.paciente + '</td>');
                                nuevaFila.append('<td>' + datos.cedula + '</td>');
                                nuevaFila.append('<td>' + datos.edad + '</td>');
                                nuevaFila.append('<td>' + datos.fecha_solicitud + '</td>');
                                nuevaFila.append('<td>' + datos.fecha_resultado + '</td>');
                                nuevaFila.append('<td>' + (datos.estado === true ? 'Habilitado' : 'Eliminado') + '</td>');
                               // nuevaFila.append('<td> <button type="button" name="ver" id="' + datos.id + '" class="btn btn-outline-info btn-sm btn_ver">Ver</button> <button type="button" name="delete" id="' + datos.id + '" class="btn btn-outline-danger btn-sm btn_deleteR">Dar baja</button> </td>');
                                nuevaFila.append((datos.estado == true ? '<td> <button type="button" name="ver" id="' + datos.id + '" class="btn btn-outline-info btn-sm btn_ver">Ver</button> <button type="button" name="delete" id="' + datos.id + '" class="btn btn-outline-danger btn-sm btn_deleteR">Dar baja</button> </td>' : '<td> <button type="button" name="ver" id="' + datos.id + '" class="btn btn-info btn-sm btn_ver" disabled>Ver</button> <button type="button" name="delete" id="' + datos.id + '" class="btn btn-danger btn-sm btn_deleteR" disabled>Dar baja</button> </td>'));
                               
                                cuerpoTabla_resultado.append(nuevaFila);
                                //PROCESO PARA MOSTAR EL MODAL VER
                                $(".btn_ver").click(function(e) {
                                    var id = $(this).attr('id');  // Usamos el ID del botón para saber qué examen mostrar
                                    //console.log('id ' + id);
                                    var examen = data.find(function(item) { // Buscar el objeto de datos correspondiente con el mismo ID
                                        return item.id == id;
                                    });
                                    // Si encontramos el examen con ese ID, rellenamos el modal con los datos
                                    if (examen && examen.tipo != 'C') {
                                        $('#nro_examen').text(examen.nro_examen + '-'+examen.tipo);
                                        $('#paciente').text(examen.paciente);
                                        $('#cedula').text(examen.cedula); 
                                        $('#nacimiento').text(examen.fecha_nacimiento)
                                        $('#edad').text(examen.edad); 
                                        $('#direccion').text((examen.direccion != null ? examen.direccion : 'No tiene'));
                                        $('#fecha_solicitud').text(examen.fecha_solicitud); 
                                        $('#fecha_resultado').text(examen.fecha_resultado); 
                                        $('#municipio').text(examen.municipio); 
                                        $('#establecimiento').text(examen.establecimiento); 
                                        //$('#modalEstado').text(examen.estado === true ? 'Habilitado' : 'Eliminado'); // Mostrar estado
                                        var diagnosticosHTML = '';
                                        examen.diagnosticos.forEach(function(diagnostico, index) {
                                            diagnosticosHTML += '<p><strong>' + (index + 1) + ' Código: </strong> ' + diagnostico.codigo + ' - <strong> Descripción: </strong> ' + diagnostico.descripcion + '</p>';
                                        });
                                        // Insertar los diagnósticos en el modal
                                        $('#diagnosticos').html(diagnosticosHTML);
                                        $('#exampleModalver').modal('show'); // Mostrar el modal
                                    }else{
                                        $('#nro_examenC').text(examen.nro_examen + '-'+examen.tipo);
                                        $('#pacienteC').text(examen.paciente);
                                        $('#cedulaC').text(examen.cedula); 
                                        $('#nacimientoC').text(examen.fecha_nacimiento)
                                        $('#edadC').text(examen.edad); 
                                        $('#direccionC').text((examen.direccion != null ? examen.direccion : 'No tiene'));
                                        $('#fecha_solicitudC').text(examen.fecha_solicitud); 
                                        $('#fecha_resultadoC').text(examen.fecha_resultado); 
                                        $('#municipioC').text(examen.municipio); 
                                        $('#establecimientoC').text(examen.establecimiento);
                                        $('#medicoC').text(examen.medico);//
                                        $('#servicioC').text(examen.servicio);
                                        $('#diagnosticoC').text((examen.diagnostico != '' ? examen.diagnostico : 'No tiene'));
                                        $('#datos_relevantesC').text((examen.datos_relevantes != '' ? examen.datos_relevantes : 'No tiene'));
                                        $('#descripcionC').text((examen.descripcion != '' ? examen.descripcion : 'No tiene'));
                                        $('#conclucionC').text((examen.conclucion != '' ? examen.conclucion : 'No tiene'));
                                        $('#notaC').text((examen.nota != '' ? examen.nota : 'No tiene'));
                                        $('#exampleModalverCito').modal('show'); // Mostrar el modal
                                    }
                                });
                                //PROCESP PARA EL MODAL ELIMINAR UN REGISTRO
                                $(".btn_deleteR").click(function(e) {
                                    var id = $(this).attr('id');  // Usamos el ID del botón para saber qué examen mostrar
                                    //console.log('id ' + id);
                                    var examen = data.find(function(item) {  // Buscar el objeto de datos correspondiente con el mismo ID
                                        return item.id == id;
                                    });
                                    //$('#nro_id').text(examen.id); no usado
                                    $('#pac_mcr').text(examen.paciente);
                                    $('#nac_mcr').text(examen.fecha_nacimiento);
                                    $('#ci_mcr').text(examen.cedula);
                                    $('#examen_mcr').text(examen.nro_examen + '-' + examen.tipo);
                                    $('#fechaS_mcr').text(examen.fecha_solicitud);
                                    $('#fechaR_mcr').text(examen.fecha_resultado);
                                    $('#llaveR').val(examen.id);
                                    $('#tipoMR').val(examen.tipo);
                                    $('#fechaRMR').val(examen.fecha_resultado);
                                    $('#fechaSMR').val(examen.fecha_solicitud);
                                    $('#confirmarResultado').modal('show'); // Mostrar el modal
                                });
                                $('#titulo').text('Lista de reporte '+datos['reporte']).show();
                                $('#listatemp_resultado').show();
                            } 
                        }); 
                        //
                        var esVisible = $("#lista_solicitud").is(":visible");
                        if(esVisible == true){ 
                             tabla = $("#lista_solicitud").DataTable({
                                "lengthMenu": [[ 10 , 20, 30, -1], [ 10 , 20, 30, "All"]],
                                language: {
                                    "sProcessing":"Procesando...",
                                    "lengthMenu": "Mostrar _MENU_ registros",
                                    "zeroRecords": "No se encontraron resultados",
                                    "emptyTable": "No hay datos disponibles en la Tabla",
                                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                    "loadingRecords": "Cargando...",
                                    "sSearch": "Buscar:",
                                    "oPaginate": {
                                        "sFirst": "Primero",
                                        "sLast":"Último",
                                        "sNext":"Siguiente",
                                        "sPrevious": "Anterior"
                                    },
                                    "aria": {
                                        "sortAscending": ": orden ascendente",
                                        "sortDescending": ": orden descendente"
                                    },
                                    "buttons": {
                                        "copy": "Copiar",
                                        "updateState": "Actualizar"
                                    }
                                },
                                "bDestroy": true,
                            });  
                        }
                        //
                        var esVisible = $("#listatemp_resultado").is(":visible");
                        if(esVisible == true){ 
                            tabla = $("#listatemp_resultado").DataTable({
                                "lengthMenu": [[ 10 , 20, 30, -1], [ 10 , 20, 30, "All"]],
                                language: {
                                    "sProcessing":"Procesando...",
                                    "lengthMenu": "Mostrar _MENU_ registros",
                                    "zeroRecords": "No se encontraron resultados",
                                    "emptyTable": "No hay datos disponibles en la Tabla",
                                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                    "loadingRecords": "Cargando...",
                                    "sSearch": "Buscar:",
                                    "oPaginate": {
                                        "sFirst": "Primero",
                                        "sLast":"Último",
                                        "sNext":"Siguiente",
                                        "sPrevious": "Anterior"
                                    },
                                    "aria": {
                                                "sortAscending": ": orden ascendente",
                                                "sortDescending": ": orden descendente"
                                    },
                                    "buttons": {
                                                "copy": "Copiar",
                                                "updateState": "Actualizar"
                                    }
                                },
                                "bDestroy": true,
                            }); 
                        }    
                    }else{
                        notificaciones("No existe resultado con esos parametros !!", "ERROR DE FORMULARIO", 'error');
                        var cuerpoTabla_resultado = $('#tablaLista_resultado');
                        cuerpoTabla_resultado.empty();
                        var cuerpoTabla_solicitudes = $('#tablaLista_solicitud'); //para solicitudes
                        cuerpoTabla_solicitudes.empty();
                        $('#titulo').hide();
                        $('#listatemp_resultado').hide();
                        $('#lista_solicitud').hide();
                        return false;
                    }
                });                
           }
        });   

        //PROCESO PARA ELIMINAR SOLICITUD
        $("#btnConfirmarS").click(function(e){
            var formData = new FormData(document.getElementById("form-modalEliminarS"));
            $.ajax({
                url:"{{route('solicitud.delete')}}",
                type:'POST',
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(data){
               // console.log('modal el -> '+data );
                if(data && data != 0 ){
                   // console.log('id '+ data)
                    $('#confirmarSolicitud').modal('hide');
                    var btnEliminar = $('.btn_deleteS[id="' + data + '"]');  // Usamos el ID del botón "Dar baja" para encontrar la fila
                    var fila = btnEliminar.closest('tr'); // Buscar la fila más cercana al botón
                    // Actualizar el estado en la fila
                    var estadoCell = fila.find('td').eq(9); // Suponiendo que la columna de "estado" está en la posición 7 (índice 7)
                    estadoCell.text('Eliminado');
                    btnEliminar.prop('disabled', true);
                    btnEliminar.removeClass('btn-outline-danger').addClass('btn-danger');
                    $('#tablaLista_solicitud tr[data-id="' + data + '"] td:nth-child(9)').val('eliminados');
                    notificaciones("correctamente ....", "Solicitud eliminada", 'success');
                }else{
                    $('#confirmarSolicitud').modal('hide');
                    notificaciones("Contacte con soporte !!", "Error al eliminar la solicitud !!", 'error');
                }
            }); 
        }); 
         //PROCESO PARA ELIMINAR RESULTADO
         $("#btnConfirmarR").click(function(e){
            var formData = new FormData(document.getElementById("form-modalEliminarR"));
            $.ajax({
                url:"{{route('resultado.delete')}}",
                type:'POST',
                dataType: "html",
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(data){
               //console.log('modal el -> '+data );
                if(data && data != 0 ){
                   // console.log('id '+ data)
                    $('#confirmarResultado').modal('hide');
                    var btnEliminar = $('.btn_deleteR[id="' + data + '"]');  // Usamos el ID del botón "Dar baja" para encontrar la fila
                    var btnVer = $('.btn_ver[id="' + data + '"]');
                    var fila = btnEliminar.closest('tr'); // Buscar la fila más cercana al botón
                    // Actualizar el estado en la fila
                    var estadoCell = fila.find('td').eq(7); // Suponiendo que la columna de "estado" está en la posición 7 (índice 7)
                    estadoCell.text('Eliminado');
                    btnEliminar.prop('disabled', true);
                    btnEliminar.removeClass('btn-outline-danger').addClass('btn-danger');
                    btnVer.prop('disabled', true);
                    btnVer.removeClass('btn-outline-info').addClass('btn-info');
                    $('#tablaLista_resultado tr[data-id="' + data + '"] td:nth-child(8)').val('eliminados');
                    notificaciones("correctamente ....", "Resultado eliminado", 'success');
                }else{
                    $('#confirmarResultado').modal('hide');
                    notificaciones("Contacte con soporte !!", "Error al eliminar el resultado !!", 'error');
                }
            }); 
        }); 

          //pruebas no usado
          $("#btn").click(function(e){
            $('#lista_solicitud'). DataTable(). destroy();
            $('#listatemp_resultado'). DataTable(). destroy();
            var fecha = $('#fecha').val();
            //var user = $('#user :selected').text();  // var tipo = $('#tipo :selected').text();
            var user_id = $('#user').val();
            var tipo_id = $('#tipo').val();
            if (fecha != '' && user_id != null && tipo_id != null) {
                var formData = new FormData(document.getElementById("form-list"));
                $.ajax({
                    url:"{{route('lista.reportes.index')}}",
                    type:'POST',
                    dataType: "html",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData
                }).done(function(data){
                    console.log('data-> '+data );
                    if(data != "sin_resultados"){
                        var data = JSON.parse(data);
                        var cuerpoTabla_resultado = $('#tablaLista_resultado');//para resultados
                        cuerpoTabla_resultado.empty();
                        data.forEach(function(datos, index) { // Iterar sobre los datos devueltos y agregarlos a la tabla                        
                            if(datos){ //para resultados
                                $('#titulo').hide();
                                $('#lista_solicitud').hide();
                                var nuevaFila = $('<tr>');
                                nuevaFila.append('<td>' + (index + 1) + '</td>');
                                nuevaFila.append('<td>' + datos.nro_examen +'-'+datos.tipo + '</td>');
                                nuevaFila.append('<td>' + datos.paciente + '</td>');
                                nuevaFila.append('<td>' + datos.cedula + '</td>');
                                nuevaFila.append('<td>' + datos.edad + '</td>');
                                nuevaFila.append('<td>' + datos.fecha_solicitud + '</td>');
                                nuevaFila.append('<td>' + datos.fecha_resultado + '</td>');
                                nuevaFila.append('<td>' + (datos.estado === true ? 'Habilitado' : 'Eliminado') + '</td>');
                                nuevaFila.append((datos.estado == true ? '<td> <button type="button" name="delete" id="' + datos.id + '" class="btn btn-outline-danger btn-sm btn_deleteS">Dar baja</button> </td>' : '<td> <button type="button" name="delete" id="' + datos.id + '" class="btn btn-danger btn-sm btn_deleteS" disabled >Dar baja</button> </td>'));
                              
                                cuerpoTabla_resultado.append(nuevaFila);
                                  //nuevaFila.append('<td> <button type="button" name="ver" id="' + datos.id + '" class="btn btn-outline-info btn-sm btn_ver">Ver</button> <button type="button" name="delete" id="' + datos.id + '" class="btn btn-outline-danger btn-sm btn_deleteR">Dar baja</button> </td>');
                                //..
                                //PROCESO PARA MOSTAR EL MODAL VER
                                $(".btn_ver").click(function(e) {
                                    var id = $(this).attr('id');  // Usamos el ID del botón para saber qué examen mostrar
                                    //console.log('id ' + id);
                                    var examen = data.find(function(item) { // Buscar el objeto de datos correspondiente con el mismo ID
                                        return item.id == id;
                                    });
                                    // Si encontramos el examen con ese ID, rellenamos el modal con los datos
                                    if (examen && examen.tipo != 'C') {
                                        $('#nro_examen').text(examen.nro_examen + '-'+examen.tipo);
                                        $('#paciente').text(examen.paciente);
                                        $('#cedula').text(examen.cedula); 
                                        $('#nacimiento').text(examen.fecha_nacimiento)
                                        $('#edad').text(examen.edad); 
                                        $('#direccion').text((examen.direccion != null ? examen.direccion : 'No tiene'));
                                        $('#fecha_solicitud').text(examen.fecha_solicitud); 
                                        $('#fecha_resultado').text(examen.fecha_resultado); 
                                        $('#municipio').text(examen.municipio); 
                                        $('#establecimiento').text(examen.establecimiento); 
                                        //$('#modalEstado').text(examen.estado === true ? 'Habilitado' : 'Eliminado'); // Mostrar estado
                                        var diagnosticosHTML = '';
                                        examen.diagnosticos.forEach(function(diagnostico, index) {
                                            diagnosticosHTML += '<p><strong>' + (index + 1) + ' Código: </strong> ' + diagnostico.codigo + ' - <strong> Descripción: </strong> ' + diagnostico.descripcion + '</p>';
                                        });
                                        // Insertar los diagnósticos en el modal
                                        $('#diagnosticos').html(diagnosticosHTML);
                                        $('#exampleModalver').modal('show'); // Mostrar el modal
                                    }else{
                                        $('#nro_examenC').text(examen.nro_examen + '-'+examen.tipo);
                                        $('#pacienteC').text(examen.paciente);
                                        $('#cedulaC').text(examen.cedula); 
                                        $('#nacimientoC').text(examen.fecha_nacimiento)
                                        $('#edadC').text(examen.edad); 
                                        $('#direccionC').text((examen.direccion != null ? examen.direccion : 'No tiene'));
                                        $('#fecha_solicitudC').text(examen.fecha_solicitud); 
                                        $('#fecha_resultadoC').text(examen.fecha_resultado); 
                                        $('#municipioC').text(examen.municipio); 
                                        $('#establecimientoC').text(examen.establecimiento);
                                        $('#medicoC').text(examen.medico);//
                                        $('#servicioC').text(examen.servicio);
                                        $('#diagnosticoC').text((examen.diagnostico != '' ? examen.diagnostico : 'No tiene'));
                                        $('#datos_relevantesC').text((examen.datos_relevantes != '' ? examen.datos_relevantes : 'No tiene'));
                                        $('#descripcionC').text((examen.descripcion != '' ? examen.descripcion : 'No tiene'));
                                        $('#conclucionC').text((examen.conclucion != '' ? examen.conclucion : 'No tiene'));
                                        $('#notaC').text((examen.nota != '' ? examen.nota : 'No tiene'));
                                        $('#exampleModalverCito').modal('show'); // Mostrar el modal
                                    }
                                });
                                 //..
                                //PROCESP PARA EL MODAL ELIMINAR / HABILITAR UN REGISTRO
                                $(".btn_deleteR").click(function(e) {
                                    var id = $(this).attr('id');  // Usamos el ID del botón para saber qué examen mostrar
                                    //console.log('id ' + id);
                                    var examen = data.find(function(item) {  // Buscar el objeto de datos correspondiente con el mismo ID
                                        return item.id == id;
                                    });
                                    $('#nro_id').text(examen.id); 
                                    $('#pac_mcr').text(examen.paciente);
                                    $('#nac_mcr').text(examen.fecha_nacimiento);
                                    $('#ci_mcr').text(examen.cedula);
                                    $('#examen_mcr').text(examen.nro_examen + '-' + examen.tipo);
                                    $('#fechaS_mcr').text(examen.fecha_solicitud);
                                    $('#fechaR_mcr').text(examen.fecha_resultado);
                                    $('#confirmarResultado').modal('show'); // Mostrar el modal
                                });
                                $('#titulo').text('Lista de reporte '+datos['reporte']).show();
                                $('#listatemp_resultado').show();
                               
                            } 
                        }); 
                        //.
                        var esVisible = $("#listatemp_resultado").is(":visible");
                                if(esVisible == true){ 
                                   // tabla = $("#listatemp_resultado").DataTable();
                                    tabla = $("#listatemp_resultado").DataTable({
                                        "lengthMenu": [[ 2 , 20, 30, -1], [ 2 , 20, 30, "All"]],
                                        language: {
                                            "sProcessing":"Procesando...",
                                            "lengthMenu": "Mostrar _MENU_ registros",
                                            "zeroRecords": "No se encontraron resultados",
                                            "emptyTable": "No hay datos disponibles en la Tabla",
                                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                            "loadingRecords": "Cargando...",
                                            "sSearch": "Buscar:",
                                            "oPaginate": {
                                                "sFirst": "Primero",
                                                "sLast":"Último",
                                                "sNext":"Siguiente",
                                                "sPrevious": "Anterior"
                                            },
                                            "aria": {
                                                "sortAscending": ": orden ascendente",
                                                "sortDescending": ": orden descendente"
                                            },
                                            "buttons": {
                                                "copy": "Copiar",
                                                "updateState": "Actualizar"
                                            }
                                        },
                                        "bDestroy": true,
                                    }); 
                                    
                                }
                            //
                    }else{
                        notificaciones("No existe resultado con esos parametros !!", "ERROR DE FORMULARIO", 'error');
                        return false;
                    }
                });                
           }
        }); 
        // no usado
      /*  $('#form-list').on('submit', function(e) {
            // Prevenir que el formulario se envíe en una nueva ventana
            e.preventDefault();

            // Obtenemos los valores del formulario
            var formData = $(this).serialize();

            // Hacemos la solicitud AJAX al servidor
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Si la respuesta es un PDF, crear un enlace para descargarlo
                    // Aquí puedes procesar la respuesta como necesites, ya sea para descargar el PDF o mostrar el mensaje de error.
                   // var pdfWindow = window.open();
                   // pdfWindow.document.write(response);
                },
                error: function() {
                    alert('Hubo un error al procesar la solicitud');
                }
            });
        });*/
        
    });
</script>
@stop

