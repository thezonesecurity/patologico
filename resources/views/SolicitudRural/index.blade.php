@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Solicitud rural
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

{!! Form::open(array('id'=>'form_reg_solicitud','autocomplete'=>'off', 'class'=>'border border-5 form-control-sm')) !!}

   @csrf
    <table class="table table-sm" >
        <tr>
            <th> 
                <div class="row" >
                    <div class="col-md-3">
                        <table class="table table-sm border border-success">
                            <center class="font-weight-bold m-2">Registro de Solicitud</center>
                            <tr>
                                <div style="background: #e9f8da;" class="border border-5">
                                    <div class="form-row " class="mt-2">
                                        <div class="form-group col-md-4">
                                            <label for="fecha_solicitud">Tipo Solicitud</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input type="radio" name="tipo_soli" id="radioUrbano" value="U" checked class="ml-3">
                                            <label class="form-check-label" for="exampleRadios1F">Urbano</label>
                                            <input  type="radio" name="tipo_soli" id="radioRural" value="R" class="ml-3">
                                            <label class="form-check-label" for="exampleRadios1M">Rural</label>
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label for="fecha_solicitud">Fecha Solicitud</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="date" class="form-control" name="fecha_solicitud" id="fecha_solicitud" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_municipio">Municipio</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <select class="form-control-sm custom-select text-uppercase select2 controlEstablecimiento" name="municipio" id="municipio" style="width: 100%">
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
                                            <select class="form-control-sm custom-select text-uppercase select2" style="width: 100%" name="establecimiento" id="establecimiento" >
                                            </select>
                                           {{-- <select class="form-control-sm custom-select text-uppercase controlServicio select2" name="establecimiento" id="establecimiento">
                                                <option value="Elegir opcion" disabled selected>Selecione una opcion</option> 
                                                @foreach($establecimientos as $id => $item)
                                                    <option value="{{$id}}" > {{$item}} </option>                      
                                                @endforeach
                                            </select>--}}
                                        </div>
                                    </div>
                                </div>
                                <label for="hora de inicio" class="m-1">Detalle de Pacientes</label>
                                <div style="background: #dadef8;" class="border border-5">
                                   
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_nombre_pac">cedula de identidad</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control controlCedula ControlCi" name="ci" id="ci" >
                                            <small id="validacionCi" class="form-text"></small>
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_nombre_pac">Nombres</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control" name="nombre_paciente" id="nombre_paciente" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_apellidos_pac">Apellidos</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control" name="apellido_paciente" id="apellido_paciente" readonly>
                                            <input type="text" class="form-control" name="id_paciente" id="id_paciente" readonly style="display: none;">
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_fecha_nacimiento_pac">Fecha nacimiento</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control" name="fecha_nac_p" id="fecha_nac_p" readonly>
                                        </div>
                                    </div>
                                </div>

                                <small id="validacionAgregar" class="form-text m-1"></small>
                                <div class="row justify-content-center align-content-center" style="margin-top: -1x;">
                                    <small id="validacionAgregar" class="form-text"></small>
                                    <button id="adicionar" class="btn btn-success btn-sm add" type="button"> Agregar</button>
                                    <button id="limpiar" class="btn btn-danger btn-sm ml-4 cancelar" type="button" > Cancelar</button>                                  
                                </div>
                            </tr>
                        </table> <!--REGISTRAR ROL TURNO-->
                    </div>
                    <!---->
                    <div class="col-md-9" id="este"> {{--listar tabla--}}
                        <center class="font-weight-bold mt-2">Lista Temporal de Solicitudes</center> <br>
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
        <center>
            <button type="button" id="registrar" class="btn btn-success btn-sm ml-4">Registrar</button>
        </center>
    </div>

{!!Form::Close()!!}

@include('SolicitudRural.ModalRegistrarPaciente');
@include('SolicitudRural.modalListaExamenes');
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

<script type="text/javascript" src="{{ asset('assets/scripts/user/rural/solicitud.js') }}"></script>
<script>
 $(document).ready(function() {

    var exitePaciente = 0
     // PROCESO PARA LISTAR ESTABLECIMIENTOS DE UN MUNICPIO ESPECIFICO
    $('.controlEstablecimiento').change(function() {
        const establecimiento_municipio = $('#establecimiento');
        $.ajax({
            url: "{{ route('lista.establecimientos.municipios') }}",
            data: { id_municipio: $('#municipio').val() }, //$(this).val() 
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
    $('.controlCedula').change(function() {
        $.ajax({
            url: "{{ route('lista.registrados.pacientes') }}",
            data: { cedula: $('#ci').val() }, //$(this).val() 
            success: function(data){
                if(data == 'No existe'){
                   //  alert('El paciente no existe');
                     $(".controlCi").addClass('is-invalid');
                     $('#validacionCi').text('El C.I. del paciente no existe, registrelo !!!').addClass('text-danger').show();
                     
                     $('#cedula').focus();
                     $('#exampleModal').modal('show');
                   
                     document.getElementById("nombre_paciente").value = "";
                     document.getElementById("apellido_paciente").value = "";
                     document.getElementById("fecha_nac_p").value = "";
                     document.getElementById("id_paciente").value = "";
                     exitePaciente = 1;
                }
                 else{
                   //  alert(data[0]['nombre']);
                     $(".controlCi").removeClass('is-invalid');
                     $('#validacionCi').text('El C.I. del paciente no existe, registrelo !!!').removeClass('text-danger').hide();
                     $('#validacionAgregar').text('Error verifique los errores del formulario !!!').addClass('text-danger').hide();
                     $(".vistaModal").hide();
                     $('#nombre_paciente').val(data[0]['nombre']);
                     $('#apellido_paciente').val(data[0]['apellido']);
                     $('#fecha_nac_p').val(data[0]['fecha_nacimiento']);
                     $('#id_paciente').val(data[0]['id']);
                     exitePaciente = 0;   
                 }
             }
        });
    });
    //funcion para registrar paciente por ajax
    $('#BtnPacienteRegistrar').click(function(e) {
        e.preventDefault();
        console.log('click en  modal');
        var ci_pac = $('#cedula').val();
        var nombre = $('#nombres').val();
        var apellido = $('#apellidos').val();
        var fec_nac = $('#fec_nacimiento').val();
        var sexo = $('input[name=sexo]:checked').val(); //$('#sexo').val();
        //var formData = new FormData(document.getElementById("form-registrar-paciente")); 
        var _token = $('input[name="_token"]').val();
        if ($('#form-registrar-paciente').valid()) {
          $.ajax({
            url:"{{route('modal.registrar.paciente')}}",
            method:"POST",
            data:{ _token:_token, ci_pac: ci_pac, nombre_pac: nombre, apellido_pac: apellido, fecha_nac: fec_nac, sexo_pac: sexo},
            success:function(data){
                if(data == 'registrado'){
                    $('#exampleModal').modal('hide');
                    limpiarformModalPaciente();
                    notificaciones("Paciente registrado correctamente..!!", "Felicidades", 'success');
                    $(".controlCi").removeClass('is-invalid');
                     $('#validacionCi').text('El C.I. del paciente no existe, registrelo !!!').removeClass('text-danger').hide();
                    $('#ci').val(ci_pac);
                    $('#nombre_paciente').val(nombre);
                    $('#apellido_paciente').val(apellido);
                    $('#fecha_nac_p').val(fec_nac);
                    exitePaciente = 0;              
                }else{
                    $('#exampleModal').modal('hide');
                    limpiarformModalPaciente();
                    notificaciones("ERROR NO SE REGISTRO Al PACIENTE..!!", "CONTACTE CON SOPORTE", 'error');
                    document.getElementById("nombre_paciente").value = "";
                    document.getElementById("apellido_paciente").value = "";
                    document.getElementById("fecha_nac_p").value = "";
                    exitePaciente = 1;
                }
            }
          });
        }
    });

     //PROCESO PARA ADICIONAR LOS DATOS DEL FORMUALRIO A LA TABLA TEMPORAL y VALIDACION DEL FORMULARIO
         var i = 1, fila; //contador para asignar id al boton que borrara la fila
        $('#adicionar').click(function() {
            //obtenemos el valor de todos los input
            var fec_solicitud = $('#fecha_solicitud').val();
            var municipio = $('#municipio :selected').text();
            var municipio_id = $('#municipio').val();
            var establecimiento = $('#establecimiento :selected').text();
            var establecimiento_id = $('#establecimiento').val();

           var ci_paciente = $('#ci').val();
           var nombre_pac = $('#nombre_paciente').val();
           var id_paciente = $('#id_paciente').val();
           var apellido_pac = $('#apellido_paciente').val();
           var fec_nac_pac = $('#fecha_nac_p').val();
          
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
          
            if (nombre_pac  == '') {
                notificaciones("Campo nombre vacio, registre un paciente !!", "ERROR DE FORMULARIO", 'error');
                return false;
            } 
            if (apellido_pac  == '') {
                notificaciones("Campo apellido vacio, registre un paciente !!", "ERROR DE FORMULARIO", 'error');
                return false;
            } 
           /* if (ci_paciente  == '') {
                notificaciones("Ingrese cedula del paciente !!", "ERROR DE FORMULARIO", 'error');
                return false;
            } 
            if (fec_nac_pac  == '') {
                notificaciones("Ingrese fecha de nacimiento del paciente !!", "ERROR DE FORMULARIO", 'error');
                return false;
            } */
            //proceso para guardar los datos en la lista temporal
            //$('.titulo').after(fila);
            //$('.titulo').show();
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
                 limpiarformParcial(); //para limpiar el formulario despues de registrarlo
                 document.getElementById("id_paciente").value = "";
                $('#validacionAgregar').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
                i++;
            }else{
                $('#validacionAgregar').text('Error verifique los errores del formulario !!!').addClass('text-danger').show();
            }
           
        });
            
        $(document).on('click', '.btn_remove', function() { //limpia el formulario para que vuelva a contar las filas de la tabla
             var button_id = $(this).attr("id");
             $('#row' + button_id + '').remove(); //borra la fila
        });

        //PROCESO PARA REGISTRAR MULTIPLES FILAS DE LA TABLA  TEMPORAL
        $("#registrar").click(function(e){
            e.preventDefault();
            var fec_solicitud = $('#fecha_solicitud').val();
            var municipio = $('#municipio :selected').text();
            var municipio_id = $('#municipio').val();
            var establecimiento = $('#establecimiento :selected').text();
            var establecimiento_id = $('#establecimiento').val();
            var cant=0;
            $("input[name^='id_paciente']").each(function(){
                cant++;
            });
            if (cant == 0) {
                notificaciones("Agregue datos mediante el formulario !!", "NO EXISTE REGISTROS EN LA TABLA TEMPORAL", 'error');
                return false;
            }
           
            //SolicitudRural.store
            if (fec_solicitud != '' && municipio != 'Selecione una opcion' && establecimiento != 'Selecione una opcion') {
                var formData = new FormData(document.getElementById("form_reg_solicitud"));
                $.ajax({
                    url:"{{route('SolicitudRural.store')}}",
                    type:'POST',
                    dataType: "html",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData
                }).done(function(data){ //alert(resp);
                   // alert(data);
                    if(data=='error_registro_solicitud'){ //resp=='error'	
                        notificaciones("ERROR NO SE PUDO REALIZAR EL REGISTRO !!", "CONTACTE CON SOPORTE", 'error');
                        /*setTimeout(function(){	
                            window.location="{{ route('SolicitudRural.index') }}";
                        },4000);*/
                    }
                    else {//paa Registro Exitoso
                        console.log(data);
                        var data = JSON.parse(data);
                        var cuerpoTabla = $('#tablaDatos');
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
                        $('#ModalListaExamenes').modal('show');
                    }
                });
                $('#form_reg_solicitud')[0].reset(); 
                $('#municipio').val('Elegir opcion').trigger('change.select2');
                $('#establecimiento').val('Elegir opcion').trigger('change.select2');
                
           }else{
                notificaciones("Verifique los campos fecha solicitud, municipio y establecimiento !!", "ERROR DE FORMULARIO", 'error');
                return false;
           }
           
        });   
    //se recarga la pagina cuando se cierra el modal de lista de solicitudes
    $('#ModalListaExamenes').on('hidden.bs.modal', function () {
        setTimeout(function(){
        window.location="{{ route('SolicitudRural.index') }}";
        },1000);
    });

});

</script>
@stop

