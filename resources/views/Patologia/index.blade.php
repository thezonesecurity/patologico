@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Solicitud Citologia
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/librerias/Select2/css/select2.css') }}">
<style>
    #este {
  height: 40em;
  line-height: 1em;
  overflow-x: scroll;
  overflow-y: scroll;
  width: 100%;
  border: 1px solid;
  border-color: rgba(0, 191, 255, 0.695);
}
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: 99;
    display: flex;
    align-items: center;
    justify-content: center;
}

.overlay-content {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    max-width: 80%;
}
.error {
    color: red;
}
</style>
@stop


@section('contenido')  

{!! Form::open(array('id'=>'form_solicitud_patologico','autocomplete'=>'off', 'class'=>'border border-5 form-control-sm')) !!}

   @csrf
    <table class="table table-sm" >
        <tr>
            <th> 
                <div class="row" >
                    <div class="col-md-3">
                        <table class="table table-sm border border-success">
                            <div class="text-center font-weight-bold m-2">Registro de Solicitud Citologia</div>
                            <tr>
                                <div style="background: #94E0FF;" class="border border-5">
                                   
                                    <div class="form-row " class="mt-2">
                                        <div class="form-group col-md-3">
                                            <label for="fecha_solicitud">Fecha Solicitud</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="date" class="form-control" name="fec_solicitud" id="fec_solicitud" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_municipio">Municipio</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <select class="form-control-sm custom-select text-uppercase select2 controlMunicipio" name="p_municipio" id="p_municipio" style="width: 100%">
                                                <option value="Elegir opcion" disabled selected >Selecione una opcion</option> 
                                                @foreach($municipios as $id => $item)
                                                    <option value="{{$id}}" > {{$item}} </option>                      
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label class="form-check-label" for="secer_area" >Establecimiento</label>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label  style="display: none;">Esta</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <select class="form-control-sm custom-select text-uppercase select2" style="width: 100%" name="p_establecimiento" id="p_establecimiento" >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <label for="hora de inicio" class="m-1">Detalle de Pacientes</label>
                                <div style="background: #FFB3B9;" class="border border-5">
                                   
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_nombre_pac">cedula de identidad</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control PcontrolCedula PcontrolCi" name="p_ci" id="p_ci" >
                                            <small id="PvalidacionCi" class="form-text font-weight-bold"></small>
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_nombre_pac">Nombres</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control" name="p_nombre_paciente" id="p_nombre_paciente" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_apellidos_pac">Apellidos</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control" name="p_apellido_paciente" id="p_apellido_paciente" readonly>
                                            <input type="hidden" class="form-control" name="p_id_paciente" id="p_id_paciente" readonly style="display: none;">
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_fecha_nacimiento_pac">Fecha nacimiento</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control" name="p_fecha_nac" id="p_fecha_nac" readonly>
                                        </div>
                                    </div>
                                    <small id="validacionPacienteR" class="form-text m-1 font-weight-bold"></small>
                                    <small id="validacionAgregar" class="form-text m-1 font-weight-bold"></small>
                                </div>
                                <div class="row justify-content-center align-content-center" style="margin-top: -1x;">
                                    <button id="adicionarForm" class="btn btn-success btn-sm add" type="button"> Agregar</button>
                                    <button id="limpiarForm" class="btn btn-danger btn-sm ml-4 cancelar" type="button" > Cancelar</button>                                  
                                </div>
                            </tr>
                        </table> <!--REGISTRAR ROL TURNO-->
                    </div>
                    <div class="col-md-9" id="este"> {{--listar tabla--}}
                        <div class="text-center font-weight-bold mt-2">Lista Temporal de Solicitudes Citologia</div> <br>
                        <table id="mytable" class="table table-sm table-striped border" style="font-size: 12px;  table-layout: fixed;" width="">
                                <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                                    <th width="40px">Nro.</th>
                                    <th style="" width="70px">Fecha solicitud</th>
                                    <th style="" width="70px">Cedula</th>
                                    <th style="" width="90px">Nombres</th>
                                    <th style="" width="90px">Apellidos</th>
                                    <th style="" width="70px">Fecha nacimiento</th>
                                    <th style="" width="60px">Accion</th>
                                </tr>
                                <tr class="vacio">
                                    <td colspan="7" >No hay datos agregados ...</td>
                                </tr> 
                        </table> 
                    </div>
                </div>
            </th>
        </tr>
    </table>
    <div class="col col-md-12" style="margin-top: -10px;">
        <div class="text-center">
            <button type="button" id="registrarBTN" class="btn btn-success btn-sm ml-4">Registrar</button>
        </div>
    </div>

{!!Form::Close()!!}

@include('Patologia.modalPacienteRegsistrar');
@include('Patologia.modalRegistroSolicitudes');

@stop

@section('scripts')
<script src="{{asset('assets/librerias/jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/librerias/Select2/js/select2.js') }}"></script>

<script type="text/javascript">
    $('.select2').select2({
        placeholder: "Seleccione una opcion",
        allowClear: true,
        ancho : 'resolver'
    });
</script>

<script type="text/javascript" src="{{ asset('assets/scripts/user/patologia/solicitudC.js') }}"></script>
<script>
    $(document).ready(function() {
        var  exitePaciente = 0;  
        // PROCESO PARA LISTAR ESTABLECIMIENTOS DE UN MUNICPIO ESPECIFICO
        $('.controlMunicipio').change(function() {
            const establecimiento_municipio = $('#p_establecimiento');
            $.ajax({
                url: "{{ route('lista.establecimientos.municipios') }}",
                data: { id_municipio: $('#p_municipio').val() }, //$(this).val() 
                success: function(data){
                    //alert(data);
                    establecimiento_municipio.html('<option value="Elegir opcion" selected disabled >Selecione una opcion</option>');
                    $.each(data, function(id, value) {
                        establecimiento_municipio.append('<option value="' + id + '">' + value + '</option>');
                    });
                }
            });
        });
         //PROCESO PARA MOSTRAS NOMBRE, APELLIDO Y FECHA_NACIMIENTO MEDIANTE EL CI
        $('.PcontrolCedula').change(function() {
            $.ajax({
                url: "{{ route('lista.registrados.pacientes') }}",
                data: { cedula: $('#p_ci').val() }, //$(this).val() 
                success: function(data){
                    if(data == 'No existe'){
                        //  alert('El paciente no existe');
                        $(".PcontrolCi").addClass('is-invalid');
                        $('#PvalidacionCi').text('El C.I. del paciente no existe, registrelo !!!').addClass('text-danger').show();
                        
                        $('#c_cedula').val( $('#p_ci').val() );
                        $('#registrarPaciente').modal('show');
                    
                        document.getElementById("p_nombre_paciente").value = "";
                        document.getElementById("p_apellido_paciente").value = "";
                        document.getElementById("p_fecha_nac").value = "";
                        document.getElementById("p_id_paciente").value = "";
                        exitePaciente = 1;
                    }else{
                        //var data = JSON.parse(data);  
                       // console.log('-> '+ data['estado']);
                        if(data['estado'] == true){
                        // console.log('<- '+ data['id']);
                            $('#validacionPacienteR').hide();
                            //pasos
                            $(".PcontrolCi").removeClass('is-invalid');
                            $('#PvalidacionCi').text('El C.I. del paciente no existe, registrelo !!!').removeClass('text-danger').hide();
                            $('#validacionAgregar').text('Error verifique los errores del formulario !!!').addClass('text-danger').hide();
                            $(".vistaModal").hide();

                           $('#p_nombre_paciente').val(data['nombre']);
                            $('#p_apellido_paciente').val(data['apellido']);
                            $('#p_fecha_nac').val(data['fecha_nacimiento']);
                            $('#p_id_paciente').val(data['id']);
                            exitePaciente = 0;   

                        }else{
                        //  console.log('eliminado');
                            $('#cedula').val('');
                            document.getElementById("p_nombre_paciente").value = "";
                            document.getElementById("p_apellido_paciente").value = "";
                            document.getElementById("p_fecha_nac").value = "";
                            document.getElementById("p_id_paciente").value = "";
                            $('#validacionPacienteR').text('El paciente esta eliminado, incapaz de agregar !!').addClass('text-danger').show();
                            exitePaciente = 1;
                        }
                    }
                   /* if(data == 'No existe'){
                    //  alert('El paciente no existe');
                        $(".PcontrolCi").addClass('is-invalid');
                        $('#PvalidacionCi').text('El C.I. del paciente no existe, registrelo !!!').addClass('text-danger').show();
                        
                        $('#c_cedula').val( $('#p_ci').val() );
                        $('#registrarPaciente').modal('show');
                    
                        document.getElementById("p_nombre_paciente").value = "";
                        document.getElementById("p_apellido_paciente").value = "";
                        document.getElementById("p_fecha_nac").value = "";
                        document.getElementById("p_id_paciente").value = "";
                        exitePaciente = 1;
                    }
                    else{ 
                    //  alert(data[0]['nombre']);
                        $(".PcontrolCi").removeClass('is-invalid');
                        $('#PvalidacionCi').text('El C.I. del paciente no existe, registrelo !!!').removeClass('text-danger').hide();
                        $('#validacionAgregar').text('Error verifique los errores del formulario !!!').addClass('text-danger').hide();
                        $(".vistaModal").hide();

                        $('#p_nombre_paciente').val(data[0]['nombre']);
                        $('#p_apellido_paciente').val(data[0]['apellido']);
                        $('#p_fecha_nac').val(data[0]['fecha_nacimiento']);
                        $('#p_id_paciente').val(data[0]['id']);
                        exitePaciente = 0;   
                    }*/
                }
            });
        });
         //funcion para registrar paciente por ajax
        $('#BtnPacienteRegistrarP').click(function(e) {
            e.preventDefault();
            var ci_pac = $('#c_cedula').val();
            var nombre = $('#c_nombres').val();
            var apellido = $('#c_apellidos').val();
            var fec_nac = $('#c_fec_nac').val();
            var sexo = $('input[name=c_sexo]:checked').val(); //$('#sexo').val();
            var _token = $('input[name="_token"]').val();
            if ($('#form-registrar-paciente_cito').valid()) {
            $.ajax({
                url:"{{route('modal.registrar.paciente')}}",
                method:"POST",
                data:{ _token:_token, ci_pac: ci_pac, nombre_pac: nombre, apellido_pac: apellido, fecha_nac: fec_nac, sexo_pac: sexo},
                success:function(data){
                    if(data != 'error Paciente'){
                       // console.log(data);
                        $('#registrarPaciente').modal('hide');
                        $('#form-registrar-paciente_cito')[0].reset(); 
                        notificaciones("Paciente registrado correctamente..!!", "Felicidades", 'success');
                        $(".PcontrolCi").removeClass('is-invalid');
                        $('#PvalidacionCi').text('El C.I. del paciente no existe, registrelo !!!').removeClass('text-danger').hide();
                        $('#p_ci').val(ci_pac);
                        $('#p_nombre_paciente').val(nombre);
                        $('#p_apellido_paciente').val(apellido);
                        $('#p_fecha_nac').val(fec_nac);
                        $('#p_id_paciente').val(data);
                        $("#BtnPacienteRegistrarP").prop("disabled", false);
                        exitePaciente = 0;              
                    }else{
                        $('#registrarPaciente').modal('hide');
                         $('#form-registrar-paciente_cito')[0].reset();
                        notificaciones("ERROR NO SE REGISTRO Al PACIENTE..!!", "CONTACTE CON SOPORTE", 'error');
                        document.getElementById("p_nombre_paciente").value = "";
                        document.getElementById("p_apellido_paciente").value = "";
                        document.getElementById("p_fecha_nac").value = "";
                        document.getElementById("p_id_paciente").value = "";
                        exitePaciente = 1;
                    }
                }
            });
            $("#BtnPacienteRegistrarP").prop("disabled", true);
            }
        });
        //PROCESO PARA ADICIONAR LOS DATOS DEL FORMUALRIO A LA TABLA TEMPORAL y VALIDACION DEL FORMULARIO
        var i = 1, fila; //contador para asignar id al boton que borrara la fila
        $('#adicionarForm').click(function() {
            //obtenemos el valor de todos los input
            var fec_solicitud = $('#fec_solicitud').val();
            var municipio = $('#p_municipio :selected').text();
            var municipio_id = $('#p_municipio').val();
            var establecimiento = $('#p_establecimiento :selected').text();
            var establecimiento_id = $('#p_establecimiento').val();
            var id_paciente = $('#p_id_paciente').val();
            var nombre_pac = $('#p_nombre_paciente').val();
            var ci_paciente = $('#p_ci').val();
            var apellido_pac = $('#p_apellido_paciente').val();
            var fec_nac_pac = $('#p_fecha_nac').val();

            if (fec_solicitud == '') {
                notificaciones("Ingrese fecha de solicitud !!", "ERROR DE FORMULARIO", 'error');  
                return false;
            } 
           if (municipio == 'Selecione una opcion') {
                notificaciones("Seleccione un municipio !!", "ERROR DE FORMULARIO", 'error'); //('#gestion').focus();
                return false;
            } 
            if (establecimiento == 'Selecione una opcion') {
                notificaciones("Seleccione un establecimiento !!", "ERROR DE FORMULARIO", 'error');
                return false;
            } 
          
            /*if (nombre_pac  == '') {
                notificaciones("Campo nombre vacio, registre un paciente !!", "ERROR DE FORMULARIO", 'error');
                return false;
            } 
            if (apellido_pac  == '') {
                notificaciones("Campo apellido vacio, registre un paciente !!", "ERROR DE FORMULARIO", 'error');
                return false;
            } */

            control=-1;
            var existe;

            $("input[name^='id_paciente']").each(function(){
                if ($(this).val() == fec_solicitud) {
                existe=true;
                }
            });

            fila = '<tr  id="row' + i + '"><td>' + i + '</td> <td>'+fec_solicitud+'<input type="hidden" name="id_paciente[]" class="form-control" value="'+id_paciente+'"></td> <td>'+ci_paciente+'<input type="hidden" name="ci_pac[]" class="form-control" value="'+ci_paciente+'"></td><td>'+nombre_pac+'<input type="hidden" name="nombre_pac[]" class="form-control" value="'+nombre_pac+'"></td><td>'+apellido_pac+'<input type="hidden" name="apellido_pac[]" class="form-control" value="'+apellido_pac+'"></td><td>'+fec_nac_pac+'<input type="hidden" name="f_nac_pac[]" class="form-control" value="'+fec_nac_pac+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';  
          
            $('.vacio').hide();//para oculta la fila de NO EXISTEN DATOS en la tabla
           
            if(exitePaciente == 0 ){
                $('#mytable .titulo').after(fila); //before //se añade los datos a la lista
                limpiarformParcialP(); //para limpiar el formulario despues de registrarlo
                 document.getElementById("p_id_paciente").value = "";
                $('#validacionAgregar').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
                $('#validacionPacienteR').hide(); 
                i++;
            }else{
                $('#validacionAgregar').text('Error verifique los errores del formulario !!!').addClass('text-danger').show();
                $('#validacionPacienteR').hide(); 
            }
           
        });
        $(document).on('click', '.btn_remove', function() { //limpia el formulario para que vuelva a contar las filas de la tabla
             var button_id = $(this).attr("id");
             $('#row' + button_id + '').remove(); //borra la fila
        });
         //PROCESO PARA REGISTRAR MULTIPLES FILAS DE LA TABLA  TEMPORAL
         $("#registrarBTN").click(function(e){
            e.preventDefault();
            var fec_solicitud = $('#fec_solicitud').val();
            var municipio = $('#p_municipio :selected').text();
            var establecimiento = $('#p_establecimiento :selected').text();
            var cant=0;
            
            $("input[name^='id_paciente']").each(function(){
                cant++;
            });
            if (cant == 0) {
                notificaciones("Agregue datos mediante el formulario !!", "NO EXISTE REGISTROS EN LA TABLA TEMPORAL", 'error');
                return false;
            }

            if (fec_solicitud != '' && municipio != 'Selecione una opcion' && establecimiento != 'Selecione una opcion') {
                var formData = new FormData(document.getElementById("form_solicitud_patologico"));
                $.ajax({
                    url:"{{route('SolicitudCitolgia.store')}}",
                    type:'POST',
                    dataType: "html",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData
                }).done(function(data){ //alert(resp);
                 //   console.log('-> '+data)
                    if(data=='error_registro_solicitud_citologico'){ //resp=='error'	
                        notificaciones("ERROR NO SE PUDO REALIZAR EL REGISTRO !!", "CONTACTE CON SOPORTE", 'error');
                        setTimeout(function(){	
                            window.location="{{ route('SolicitudCitolgia.index') }}";
                        },4000);
                    }
                    else {//paa Registro Exitoso
                        console.log(data);
                        var data = JSON.parse(data);
                        var cuerpoTabla = $('#tablaDatos_p');
                        cuerpoTabla.empty();
                        data.forEach(function(datos, index) { // Iterar sobre los datos devueltos y agregarlos a la tabla
                            var nuevaFila = $('<tr>');
                            nuevaFila.append('<td>' + (index + 1) + '</td>');
                            nuevaFila.append('<td>' + datos.ci + '</td>');
                            nuevaFila.append('<td>' + datos.nombre + '</td>');
                            nuevaFila.append('<td>' + datos.apellido + '</td>');
                            nuevaFila.append('<td>' + datos.nro_examen + '</td>');
                            cuerpoTabla.append(nuevaFila);
                        });
                        $('#ModalListaExamenesCitologia').modal('show');
                        notificaciones("Se registro correctamente !!", "FELICIDADES", 'success');
                    }
                });
                $('#form_solicitud_patologico"')[0].reset();
                $('#municipio').val('Elegir opcion').trigger('change.select2');
                $('#establecimiento').val('Elegir opcion').trigger('change.select2');
                
           }else{
                notificaciones("Verifique los campos fecha solicitud, municipio y establecimiento !!", "ERROR DE FORMULARIO", 'error');
                return false;
           }
           
        }); 
        //se recarga la pagina cuando se cierra el modal de lista de solicitudes
        $('#ModalListaExamenesCitologia').on('hidden.bs.modal', function () {
            setTimeout(function(){
            window.location="{{ route('SolicitudCitolgia.index') }}";
            },1000);
        });  
        //focus para los input
        $("#fec_solicitud").keypress(function() {
        if ( event.which == 13 ) { $('#p_municipio').focus(); }   
        });
        $("#p_municipio").keypress(function() {
            if ( event.which == 13 ) { $('#p_establecimiento').focus(); }   
        });
        $("#p_establecimiento").keypress(function() {
            if ( event.which == 13 ) { $('#p_ci').focus(); }   
        });
        $("#p_ci").keypress(function() {
            if ( event.which == 13 &&  exitePaciente == 0 ) { $('#adicionarForm').focus(); }   
        });
        $("#adicionarForm").keypress(function() {
            if ( event.which == 13 ) { $('#p_ci').focus(); }   
        });
          //focus para el modal registrar paciente
        $("#ci").keypress(function() {
            if ( event.which == 13  && exitePaciente == 1) { $('#cedula').focus(); }  
        });
        $("#c_cedula").keypress(function() {
            if ( event.which == 13  && exitePaciente == 1) { $('#c_nombres').focus(); }  
        });
        $("#c_nombres").keypress(function() {
            if ( event.which == 13  && exitePaciente == 1) { $('#c_apellidos').focus(); }  
        });
        $("#c_apellidos").keypress(function() {
            if ( event.which == 13 ) { $('#c_fec_nac').focus(); }  
        });   
        $("#c_fec_nac").keypress(function() {
            if ( event.which == 13 ) { $('#radiofemeninoC').focus(); }  
        });    
        $("#radiofemeninoC").keypress(function() {
            if ( event.which == 13 ) {  $('#BtnPacienteRegistrarP').focus(); }  
        });         
        $("#radioMasculinoC").keypress(function() {
            if ( event.which == 13 ) {  $('#BtnPacienteRegistrarP').focus(); }  
        });  

       /* $('input[name="c_sexo"]').last().on('change', function() {
            $('#BtnPacienteRegistrarP').focus();
        });*/

        $('#registrarPaciente').on('shown.bs.modal', function () {
            $('#c_cedula').focus();
        });
       
    });
</script>

@stop