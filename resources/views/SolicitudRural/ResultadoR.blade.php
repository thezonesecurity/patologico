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

{!! Form::open(array('id'=>'form_reg_ResultadoR','autocomplete'=>'off', 'class'=>'border border-5 form-control-sm')) !!}

   @csrf
    <table class="table table-sm" >
        <tr>
            <th> 
                <div class="row" >
                    <div class="col-md-3">
                        <table class="table table-sm border border-success">
                            <center class="font-weight-bold m-2">Registro de Resultado</center>
                            <tr>
                                <div style="background: #f8daee;" class="border border-5">
                                    <div class="form-row " style="margin-bottom: -15px;">
                                        <div class="form-group col-md-5">
                                            <label for="fecha_solicitud">Tipo Resultado</label>
                                        </div>
                                        <div class="form-group col-md-7">
                                            <input type="radio" name="tipo_soli" id="radioUrbano" value="Urbano" checked class="ml-3">
                                            <label class="form-check-label" for="exampleRadios1F">Urbano</label>
                                            <input  type="radio" name="tipo_soli" id="radioRrual" value="Rural" class="ml-3">
                                            <label class="form-check-label" for="exampleRadios1M">Rural</label>
                                        </div>
                                    </div>
                                    {{--<div class="form-row " >
                                        <div class="form-group col-md-4">
                                            <label for="nro_exa">Nro. Examen</label>
                                            <input type="text" class="form-control controlExamen" name="examen_nro" id="examen_nro" >
                                            <small id="validacionExamen" class="form-text"></small>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="fecha_resu">Fecha resultado</label>
                                            <input type="date" class="form-control" name="fec_result" id="fec_result" value="< ?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>--}}
                                   
                                    <div class="form-row " >
                                        <div class="form-group col-md-6">
                                            <div class="form-row">
                                                <div class="col-md-8">
                                                    <label for="nro_exa">Nro. Examen</label>
                                                    <input type="number" class="form-control controlExamen" name="examen_nro" id="examen_nro" >
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="nro_prefijo">Prefijo</label>
                                                    <input type="text" class="form-control" name="prefijo" id="prefijo" readonly>
                                                </div>
                                            </div>
                                            <small id="validacionExamen" class="form-text"></small>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="fecha_resu">Fecha resultado</label>
                                            <input type="date" class="form-control" name="fec_result" id="fec_result" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_cedula_identidad">Cedula identidad</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control controlCi" name="paciente_cedula" id="paciente_cedula" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_nombre_pac">Nombres</label>
                                        </div> 
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control" name="paciente_nombre" id="paciente_nombre" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_apellidos_pac">Apellidos</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control" name="paciente_apellido" id="paciente_apellido" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row " >
                                        <div class="form-group col-md-6">
                                            <label for="secer_nacimiento_pac">Fecha nacimiento</label>
                                            <input type="text" class="form-control" name="paciente_fec_nac" id="paciente_fec_nac" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="fecha_resu_edad">Edad</label>
                                            <input type="text" class="form-control" name="paciente_edad" id="paciente_edad" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row " style="displa y: none;">
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label" for="secer_id_examen">codigo examen</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control" name="id_examen" id="id_examen" readonly>
                                        </div>
                                    </div>
                                    
                                </div>
                                <label for="ho_diang" class="m-1">Diagnosticos</label>
                                <div style="background: #ddf8da;" class="border border-5">
                                    <div class="form-row mt-1" style="margin-bottom: -2px;">
                                        <div class="form-group col-md-3">
                                            <label >Codigo</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input type="text" class="form-control controlDiagnostico" name="nombre_diag" id="nombre_diag">
                                            <input type="text" class="form-control " name="codigo_diag" id="codigo_diag" readonly style="displa y: none;">
                                            <small id="validacionDiagnostico" class="form-text"></small>
                                        </div>
                                    </div>
                                    <label for="ho_diang" >Descripcion</label>
                                    <div class="form-group ">
                                        {{--<input type="text" class="form-control " name="descripcion" id="descripcion">--}}
                                        <textarea class="form-control" name="descripcion" id="descripcion" rows="3" readonly></textarea>
                                    </div>
                                </div>
                                <small id="validacionAgregarR" class="form-text"></small>
                                <div class="row justify-content-center align-content-center" style="margin-top: -1x;">
                                    <button id="adicionar" class="btn btn-success btn-sm add" type="button"> Agregar</button>
                                    <button id="limpiarResultR" class="btn btn-danger btn-sm ml-4 cancelar" type="button" > Cancelar</button>                                  
                                </div>
                            </tr>
                        </table> <!--REGISTRAR ROL TURNO-->
                    </div>
                    <!---->
                    <div class="col-md-9" id="este"> {{--listar tabla--}}
                        <center class="font-weight-bold mt-2">Lista Temporal de Resultados</center> <br>
                        <table id="mytable" class="table table-sm table-striped border" style="font-size: 12px;  table-layout: fixed;" width="">
                                <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                                    <th width="40px">Nro.</th>
                                    <th style="" width="90px">codigo</th>
                                    <th style="" width="200px">descripcion</th>
                                    <th style="" width="90px">Accion</th>
                                </tr>
                                <tr class="vacio">
                                    <td colspan="10" >No hay datos agregados ...</td>
                                </tr> 
                        </table> 
                    </div>
                </div>
            </th>
        </tr>
    </table>
    <div class="col col-md-12" style="margin-top: -10px;">
        <center>
            <button type="button" id="registrarResult" class="btn btn-success btn-sm ml-4">Registrar</button>
        </center>
    </div>

{!!Form::Close()!!}

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
<script type="text/javascript" src="{{ asset('assets/scripts/user/rural/resultadoRural.js') }}"></script>
<Script  type="text/javascript">
$(document).ready(function() {
    var exiteExamen = 0, exiteDiagnsotico = 0; ; 
     //PROCESO PARA MOSTRAS NOMBRE, APELLIDO Y FECHA_NACIMIENTO MEDIANTE EL CI
     $('.controlExamen').change(function() {
        $.ajax({
            url: "{{ route('examens.lista.resultados') }}",
            data: { nro_examen: $('#examen_nro').val(), prefijo: $('#prefijo').val() }, 
        }).done(function(data){ //alert(resp);
           // console.log(data);
            if(data == 'No existe'){
                     $(".controlExamen").addClass('is-invalid');
                     $('#validacionExamen').text('Nro de examen no existe, registrelo !!!').addClass('text-danger').show();
                     document.getElementById("paciente_cedula").value = "";
                     document.getElementById("paciente_nombre").value = "";
                     document.getElementById("paciente_apellido").value = "";
                     document.getElementById("paciente_fec_nac").value = "";
                     document.getElementById("paciente_edad").value = "";
                     document.getElementById("id_examen").value = "";
                     exiteExamen = 1;
                }
                 else{
                     $(".controlExamen").removeClass('is-invalid');
                     $('#validacionExamen').text('Nro de examen no existe, registrelo !!!').removeClass('text-danger').hide();
                     $('#paciente_cedula').val(data[0]['ci_pac']);
                     $('#paciente_nombre').val(data[0]['nombre_pac']);
                     $('#paciente_apellido').val(data[0]['apellido_pac']);
                     $('#paciente_fec_nac').val(data[0]['fec_nac_pac']);
                     $('#paciente_edad').val(data[0]['edad_pac']);
                     $('#id_examen').val(data[0]['examen_id']);
                     $('#validacionAgregarR').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
                     exiteExamen = 0;   
                 }
        });
    });
     //PROCESO PARA MOSTRAS DATOS DEL DIAGNOSTICO MEDIANTE EL CODIGO DE DIAGNOSTICO
     $('.controlDiagnostico').change(function() {
        $.ajax({
            url: "{{ route('diagnostico.lista.resultados') }}",
            data: { nro_diagnostico: $('#nombre_diag').val() }, 
        }).done(function(data){ //alert(resp);
            if(data == 'No existe'){
                     $(".controlDiagnostico").addClass('is-invalid');
                     $('#validacionDiagnostico').text('Codigo de diagnostico no existe, registrelo !!!').addClass('text-danger').show();
                     document.getElementById("codigo_diag").value = "";
                     document.getElementById("descripcion").value = "";
                     exiteDiagnsotico = 1;
                }
                 else{
                     $(".controlDiagnostico").removeClass('is-invalid');
                     $('#validacionDiagnostico').text('NroCodigo de diagnostico existe, registrelo !!!').removeClass('text-danger').hide();
                     $('#nombre_diag').val(data[0]['codigo_diagnostico']);
                     $('#codigo_diag').val(data[0]['id']);
                     $('#descripcion').val(data[0]['descripcion_diagnostico']);
                     $('#validacionAgregarR').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
                     exiteDiagnsotico = 0;   
                 }
        });
    });
     //PROCESO PARA ADICIONAR LOS DATOS DEL FORMUALRIO A LA TABLA TEMPORAL y VALIDACION DEL FORMULARIO
     var i = 1, fila; //contador para asignar id al boton que borrara la fila
        $('#adicionar').click(function() {
            //obtenemos el valor de todos los input
            //id_examen examen_nro  fec_result paciente_nombre paciente_cedula paciente_apellido paciente_fec_nac paciente_edad codigo_diag descripcion
            var id_exa = $('#id_examen').val();
            var nro_exa = $('#examen_nro').val();
            var fec_result = $('#fec_result').val();
            var ci_pac = $('#paciente_cedula').val();
            var nom_pac = $('#paciente_nombre').val();
            var ape_pac = $('#paciente_apellido').val();
            var fec_nac_pac = $('#paciente_fec_nac').val();

            var nom_diag = $('#nombre_diag').val();
            var cod_diag = $('#codigo_diag').val();
            var obs = $('#descripcion').val();

            if (nro_exa == '') {
                notificaciones("Ingrese numero de examen !!", "ERROR DE FORMULARIO", 'error');
                return false;
            } 
           if (fec_result == 'Selecione una opcion') {
                notificaciones("Seleccione una fecha resu,tado !!", "ERROR DE FORMULARIO", 'error'); //('#gestion').focus();
                return false;
            } 
           
            if (nom_diag == '') {
                notificaciones("Ingrese codigo de diagnostico !!", "ERROR DE FORMULARIO", 'error');
                return false;
            } 
            //proceso para guardar los datos en la lista temporal
            //$('.titulo').after(fila);
            //$('.titulo').show();
            control=-1;
            var existe;

            $("input[name^='examen_id']").each(function(){
                if ($(this).val() == id_exa) {
                existe=true;
                }
            });

            fila = '<tr  id="row' + i + '"><td>' + i + '</td> </td> <td>'+nom_diag+'<input type="hidden" name="codig_diag[]" class="form-control" value="'+cod_diag+'"></td><td>'+obs+'<input type="hidden" name="diag[]" class="form-control" value="'+obs+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';  
           // fila = '<tr  id="row' + i + '"><td>' + i + '</td> <td>'+nro_exa+'<input type="hidden" name="examen_id[]" class="form-control" value="'+id_exa+'"></td><td>'+fec_result+'<input type="hidden" name="fec_resultado[]" class="form-control" value="'+fec_result+'"></td><td>'+ci_pac+'<input type="hidden" name="pac_ci[]" class="form-control" value="'+ci_pac+'"></td><td>'+nom_pac+'<input type="hidden" name="pac_nom[]" class="form-control" value="'+nom_pac+'"></td><td>'+ape_pac+'<input type="hidden" name="pac_ape[]" class="form-control" value="'+ape_pac+'"></td><td>'+fec_nac_pac+'<input type="hidden" name="f_nac_pac[]" class="form-control" value="'+fec_nac_pac+'"></td> <td>'+codigo+'<input type="hidden" name="codig_diag[]" class="form-control" value="'+codigo+'"></td><td>'+obs+'<input type="hidden" name="diag[]" class="form-control" value="'+obs+'"></td><td><button type="button" name="remove" id="' + i + '" class="btn  btn-sm btn-danger btn_remove">Quitar</button></td></tr>';  
            $('.vacio').hide();//para oculta la fila de NO EXISTEN DATOS en la tabla
           
            if(exiteExamen == 0 && exiteDiagnsotico == 0 ){
                $('#mytable .titulo').after(fila); //before //se añade los datos a la lista
                ClearformParcialR(); //para limpiar el formulario despues de registrarlo
                $('#validacionAgregarR').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
                document.getElementById("nombre_diag").value = "";
                i++;
            }else{
                $('#validacionAgregarR').text('Error verifique los errores del formulario !!!').addClass('text-danger').show();
            }
           
        });
            
        $(document).on('click', '.btn_remove', function() { //limpia el formulario para que vuelva a contar las filas de la tabla
             var button_id = $(this).attr("id");
             $('#row' + button_id + '').remove(); //borra la fila
        });

        //PROCESO PARA REGISTRAR MULTIPLES FILAS DE LA TABLA  TEMPORAL
        $("#registrarResult").click(function(e){
            e.preventDefault();
            var examen = $('#examen_nro').val();
            var fecha_result = $('#fec_result').val();
            var codigo = $('#codigo_diag').val();
            var cant=0;
            $("input[name^='codig_diag']").each(function(){
                cant++;
            });
            if (cant == 0) {
                notificaciones("Agregue datos mediante el formulario !!", "NO EXISTE REGISTROS EN LA TABLA TEMPORAL", 'error');
                return false;
            }
            var formData = new FormData(document.getElementById("form_reg_ResultadoR"));
            
            if (examen != '' && exiteExamen == 0 && fecha_result != '') {
                $.ajax({
                    url:"{{route('ResultadoRural.store')}}",
                    type:'POST',
                    dataType: "html",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData
                }).done(function(resp){ //alert(resp);
                  // alert(resp);
                  console.log(resp);
                    if(resp=='ok'){ //resp=='error'	
                        notificaciones("Registro Exitoso... !!", "FELICIDADES", 'success');
                        setTimeout(function(){	
                            window.location="{{ route('ResultadoRural.index') }}";
                        },4000);
                    }
                    else {
                        notificaciones("ERROR NO SE PUDO REALIZAR EL REGISTRO !!", "CONTACTE CON SOPORTE", 'error');
                       // alert(resp);
                       setTimeout(function(){	
                            window.location="{{ route('ResultadoRural.index') }}";
                        },4000);
                    }
                });
               $('#form_reg_ResultadoR')[0].reset(); 
           }else{
                notificaciones("Verifique los campos numero de examen y fecha resultado !!", "ERROR DE FORMULARIO", 'error');
                return false;
           }
        });       
    // Detectar el cambio en los radios
    $('#prefijo').val('-U');
    $('input[type="radio"]').change(function() {
        var valorRadio = $(this).val(); // Obtener el valor del radio seleccionado
        if (valorRadio === 'Urbano') {
            $('#prefijo').val('-U'); // Añadir -U al final
        } else if (valorRadio === 'Rural') {
            $('#prefijo').val('-R'); // Añadir -R al final
        }
    });
});
</Script>
@stop