@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Resultado Citologia
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/librerias/Select2/css/select2.css') }}">
<style>
  .error {
    color: red;
  }
  textarea {
    padding: 0;
    margin: 0;
    resize: none;
  }
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
</style>
@stop


@section('contenido')  

<div class="m-2">
  <form action="" method="post" class="border border-info" id="form_solicitud_patologico" autocomplete="off"> 
    @csrf
    <div class="font-weight-bold m-2 text-center">Formulario de registro de resultados de citologia</div>
    <div class="form-row m-2">
      <div class="col-md-5 col-sm-5">
        <div class="form-row">
          <div class="form-group col-md-6 col-sm-6 font-weight-bold ">
            <label  for="inlinenum_examen">Nro. examen</label>
            <label  for="inline_prefijo" class="text-right" >Prefijo</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-sort-numeric-down"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <input type="number" class="form-control controlExamenC examen" id="num_examen" name="num_examen" >
              <div class="input-group-append">
                <span class="input-group-text">-C</span>
              </div>
            </div>
            <small id="PvalidacionExamen" class="form-text text-danger"></small> 
          </div>
          <div class="form-group col-md-6 col-sm-6 font-weight-bold">
            <label  for="inline-fec_result">Fecha Resultado</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend"> 
                <div class="input-group-text"><i class="bi bi-calendar-date"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <input type="date" class="form-control" id="fec_result" name="fec_result" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <small id="vali_fecha" class="form-text text-danger"></small> 
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6 col-sm-6 font-weight-bold">
            <label  for="inline_nombres">Nombres</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-person-lock"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <input type="text" class="form-control" id="nombre_pac" name="nombre_pac" readonly>
            </div>
          </div>
          <div class="form-group col-md-6 col-sm-6 font-weight-bold">
            <label  for="inline-apellidos">Apellidos</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-person-lock"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <input type="text" class="form-control" id="apellido_pac" name="apellido_pac"  readonly>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6 col-sm-6 font-weight-bold">
            <label  for="inline-cedula">Cedula de identidad</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-person-lock"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <input type="text" class="form-control" id="cedula_pac" name="cedula_pac"  readonly>
            </div>
          </div>
          <div class="form-group col-md-6 col-sm-6 font-weight-bold">
            <label  for="inline_nacimiento">Fecha nacimiento</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-person-lock"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <input type="text" class="form-control" id="nac_pac" name="nac_pac" readonly>
              <input type="hidden" class="form-control" id="codigo_examen" name="codigo_examen" readonly style="display: none;">
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6 col-sm-6 font-weight-bold">
            <div class="form-row">
              <div class="form-group col-md-5 col-sm-5 font-weight-bold">
                <label  for="inline-edad">Edad</label>
                <div class="input-group ">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="bi bi-person-lock"  style="font-size: 1.2rem; color: rgb(0, 0, 0);"></i></div>
                  </div>
                  <input type="text" class="form-control" id="edad_pac" name="edad_pac" readonly style="margin-left: -6px;">
                </div>
              </div>
              <div class="form-group col-md-7 col-sm-7 font-weight-bold">
                <label  for="inline_celuar">Celular</label>
                <div class="input-group ">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="bi bi-person-lock" style="font-size: 1.2rem; color: rgb(0, 0, 0); margin-left: -6px;"></i></div>
                  </div>
                  <input type="text" class="form-control" id="celu_pac" name="celu_pac" readonly style="margin-left: -12px;">
                </div>
              </div>
            </div>
          </div>

          <div class="form-group col-md-6 col-sm-6 font-weight-bold">
            <label  for="inline_nacimiento">Direccion</label>
            <div class="input-group ">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-person-lock"  style="font-size: 1.3rem; color: rgb(0, 0, 0); margin-left: -6px;"></i></div>
              </div>
              <input type="text" class="form-control" id="direccion_pac" name="direccion_pac" readonly style="margin-left: -12px;">
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6 col-sm-6 font-weight-bold">
            <div class="font-weight-bold"> <label  for="inline_medico">Medico</label> </div>
            <select class="form-control-sm custom-select text-uppercase select2 controlMunicipio" name="medico" id="medico" style="width: 100%">
                <option value="0" disabled selected >Selecione una opcion</option> 
                @foreach($medicos as $medico)
                    <option value="{{$medico->id}}" >{{$medico->nombre}} {{$medico->apellido}}</option>                      
                @endforeach
            </select>
            <small id="vali_medico" class="form-text text-danger"></small> 
          </div>
          <div class="form-group col-md-6 col-sm-6 font-weight-bold">
            <div class="font-weight-bold"> <label  for="inline_servicio">Servicio</label> </div>
            <select class="form-control-sm custom-select text-uppercase select2 controlMunicipio" name="servicio" id="servicio" style="width: 100%">
                <option value="0" disabled selected >Selecione una opcion</option> 
                @foreach($servicios as $id => $item)
                    <option value="{{$id}}" > {{$item}} </option>                      
                @endforeach
            </select>
            <small id="vali_servicio" class="form-text text-danger"></small> 
          </div>
        </div>
      </div>

      {{----}}
      <div class="col-md-7 col-sm-7">
        <div class="form-group">
          <div class="font-weight-bold"> <label  for="inline_dig_clinico">Diagnostico clinico</label> </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="bi bi-journal-album"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
            </div>
            <textarea class="form-control" name="diag_clinico" id="diag_clinico" rows="1"></textarea>
          </div>
          <small id="vali_diagnostico" class="form-text text-danger"></small> 
        </div>

        <div class="form-group">
          <div class="font-weight-bold "> <label  for="inline_datos_relevantes" class="mt-2" >Datos relevantes</label> </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-journal-medical"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <textarea class="form-control" name="datos" id="datos" rows="1"></textarea>
          </div>
          <small id="vali_datos" class="form-text text-danger"></small> 
        </div>

        <div class="form-group">
          <div class="font-weight-bold ">  <label  for="inlineFormInputGroup" class="mt-2">Descripcion</label> </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="bi bi-journal-text"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
            </div>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="1"></textarea>
          </div>
          <small id="vali_descripcion" class="form-text text-danger"></small> 
        </div>

        <div class="form-group">
          <div class="font-weight-bold ">  <label  for="inlineFormInputGroup" class="mt-2">Conclucion</label> </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="bi bi-journal-bookmark"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
            </div>
            <textarea class="form-control" name="conclucion" id="conclucion" rows="1"></textarea>
          </div>
          <small id="vali_conclucion" class="form-text text-danger"></small>
        </div>

        <div class="form-group">
          <div class="font-weight-bold ">  <label  for="inlineFormInputGroup" class="mt-2">Nota</label> </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="bi bi-stickies"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
            </div>
            <textarea class="form-control" name="nota" id="nota" rows="1"></textarea>
          </div>
          <small id="vali_nota" class="form-text text-danger"></small>
        </div>

      </div>
    </div> 
    <div class="col-auto text text-center ">
      <button type="button" id="registrarForm" class="btn btn-outline-success mb-2">Registrar</button>
      <button type="button" id="limpiarFormCitologia" class="btn btn-outline-danger mb-2 ml-2 borrarForm">Cancelar</button>
    </div>
  </form>
</div>
{{-- no usado
<div class="m-4">
  <form class="border border-6" id="form_solicitud_patologico" autocomplete="off" >
    @csrf
    <center class="font-weight-bold m-2">Formulario de registro de resultados de citologia</center>
    <div class="row m-3">
        <div class="col-md-2 col-sm-2">
          <label  for="inlinenum_examen">Nro. examen</label>
          <label  for="inline_prefijo" class="text-right" >Prefijo</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="bi bi-sort-numeric-down"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
            </div>
            <input type="number" class="form-control controlExamenC examen" id="num_examen" name="num_examen" >
            <div class="input-group-append">
              <span class="input-group-text">-C</span>
            </div>
          </div>
          <small id="PvalidacionExamen" class="form-text"></small> 
      </div>
        <div class="col-md-2 col-sm-2">
            <label  for="inline-fec_result">Fecha Resultado</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend"> 
                <div class="input-group-text"><i class="bi bi-calendar-date"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <input type="date" class="form-control" id="fec_result" name="fec_result" value="<?php echo date('Y-m-d'); ?>">
            </div>
        </div>
        <div class="col-md-2 col-sm-3">
            <label  for="inline_nombres">Nombres</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-person-lock"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <input type="text" class="form-control" id="nombre_pac" name="nombre_pac" readonly>
            </div>
        </div>
        <div class="col-md-2 col-sm-3">
            <label  for="inlineapellidos">Apellidos</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-person-lock"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <input type="text" class="form-control" id="apellido_pac" name="apellido_pac"  readonly>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <label  for="inlinecedula">Cedula</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-person-lines-fill"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <input type="text" class="form-control" id="cedula_pac" name="cedula_pac"  readonly>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
          <label  for="inline_nacimiento">Fecha nacimiento</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="bi bi-calendar2-heart"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
            </div>
            <input type="text" class="form-control" id="nac_pac" name="nac_pac" readonly>
            <input type="hidden" class="form-control" id="codigo_examen" name="codigo_examen" readonly style="display: none;">
          </div>
      </div>
    </div>
    <div class="row m-3">
        <div class="col-md-2">
            <label  for="inline_medico">Medico</label>
            <select class="form-control-sm custom-select text-uppercase select2 controlMunicipio" name="medico" id="medico" style="width: 100%">
                <option value="0" disabled selected >Selecione una opcion</option> 
                @foreach($medicos as $medico)
                    <option value="{{$medico->id}}" >{{$medico->nombre}} {{$medico->apellido}}</option>                      
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label  for="inline_servicio">Servicio</label>
            <select class="form-control-sm custom-select text-uppercase select2 controlMunicipio" name="servicio" id="servicio" style="width: 100%">
                <option value="0" disabled selected >Selecione una opcion</option> 
                @foreach($servicios as $id => $item)
                    <option value="{{$id}}" > {{$item}} </option>                      
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label  for="inline_dig_clinico">Diagnostico clinico</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-journal-album"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <textarea class="form-control" name="diag_clinico" id="diag_clinico" rows="4"></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <label  for="inline_datos_relevantes">Datos relevantes</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-journal-medical"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <textarea class="form-control" name="datos" id="datos" rows="4"></textarea>
            </div>
        </div>
    </div>
    <div class="row m-3">
        <div class="col-md-4">
            <label  for="inlineFormInputGroup">Descripcion</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-journal-text"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <textarea class="form-control" name="descripcion" id="descripcion" rows="4"></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <label  for="inlineFormInputGroup">Conclucion</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-journal-bookmark"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <textarea class="form-control" name="conclucion" id="conclucion" rows="4"></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <label  for="inlineFormInputGroup">Nota</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="bi bi-stickies"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
              </div>
              <textarea class="form-control" name="nota" id="nota" rows="4"></textarea>
            </div>
        </div>
    </div>
    <div class="col-auto text-center">
      <button type="button" id="registrarForm" class="btn btn-outline-success mb-2">Registrar</button>
      <button type="button" id="limpiarFormCitologia" class="btn btn-outline-danger mb-2 ml-2 borrarForm">Cancelar</button>
    </div>
  </form>
</div>
--}}
@include('Patologia.modalImprimirResul');

@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('assets/librerias/Select2/js/select2.js') }}"></script>

<script type="text/javascript">
    $('.select2').select2({
        placeholder: "Seleccione una opcion",
        allowClear: true,
        ancho : 'resolver'
    });
</script>
<script src="{{asset('assets/librerias/jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/user/patologia/resultadoC.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {

    var exiteExamen = 0;   
      //PROCESO PARA MOSTRAS NOMBRE, APELLIDO, CI Y FECHA_NACIMIENTO MEDIANTE EL NRO DE EXAMEN TAMBIEN CONTROLA SI YA ESTA REGISTRADO EL NRO_EXAMEN
      $('.controlExamenC').change(function() {
        $.ajax({
            url: "{{ route('lista.resultados.examen') }}",
            data: { nro_examen: $('#num_examen').val(), prefijo: $('#num_examen').val() }, 
        }).done(function(data){ 
           //  console.log(data);
            if(data == 'no_encontrado'){
                $(".examen").addClass('is-invalid');
                $('#PvalidacionExamen').text('Nro. de examen no econtrado.. !!!').addClass('text-danger').show();
                document.getElementById("nombre_pac").value = "";
                document.getElementById("apellido_pac").value = "";
                document.getElementById("cedula_pac").value = "";
                document.getElementById("nac_pac").value = "";
                document.getElementById("edad_pac").value = "";
                document.getElementById("celu_pac").value = "";
                document.getElementById("direccion_pac").value = "";
                document.getElementById("codigo_examen").value = "";
                exiteExamen = 1;
             }else{
                  if(data == 'registrado'){
                  $(".examen").addClass('is-invalid');
                  $('#PvalidacionExamen').text('Nro. de examen ya registrado.. !!!').addClass('text-danger').show();
                  document.getElementById("nombre_pac").value = "";
                  document.getElementById("apellido_pac").value = "";
                  document.getElementById("cedula_pac").value = "";
                  document.getElementById("nac_pac").value = "";
                  document.getElementById("codigo_examen").value = "";
                  document.getElementById("edad_pac").value = "";
                  document.getElementById("celu_pac").value = "";
                  document.getElementById("direccion_pac").value = "";
                  exiteExamen = 1;
                }
                else{
                  $(".examen").removeClass('is-invalid');
                  $('#PvalidacionExamen').text('Nro. de examen no existe.. !!!').removeClass('text-danger').hide();
                  $('#nombre_pac').val(data[0]['nombre_pac']);
                  $('#apellido_pac').val(data[0]['apellido_pac']);
                  $('#cedula_pac').val(data[0]['ci_pac']);
                  $('#nac_pac').val(data[0]['fec_nac_pac']);
                  $('#edad_pac').val(data[0]['edad_pac']);
                  $('#celu_pac').val( (data[0]['celular_pac'] == null? 'No tiene': data[0]['celular_pac'] ) );
                  $('#direccion_pac').val((data[0]['direccion_pac'] == null? 'No tiene': data[0]['direccion_pac'] ) );
                  $('#codigo_examen').val(data[0]['examen_id']);
                // $('#validacionAgregarR').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
                  exiteExamen = 0;
                }
             }
          });
      });
      //PROCESO PARA REGISTRAR FORMULARIO RESULTADO
      $("#registrarForm").click(function(e){
        e.preventDefault();
        if ($('#fec_result').val() == '') { $('#vali_fecha').text('La fecha es requerido ..!!').show();}
        else{ $('#vali_fecha').hide(); }
        if ($('#num_examen').val() == '') { $('#PvalidacionExamen').text('Nro de examen es requerido ..!!').show(); }
        else{ $('#PvalidacionExamen').hide(); }
        if ($('#medico :selected').text() == 'Selecione una opcion' ) { $('#vali_medico').text('El medico es requerido ..!!').show(); }
        else{ $('#vali_medico').hide(); }
        if ($('#servicio :selected').text() == 'Selecione una opcion' ) { $('#vali_servicio').text('El servicio es requerido ..!!').show(); }
        else{ $('#vali_servicio').hide(); } 
        if ($('#diag_clinico').val() == '') { $('#vali_diagnostico').text('El diagnostico clinico es requerido ..!!').show(); }
        else{ $('#vali_diagnostico').hide(); }
        if ($('#datos').val() == '') { $('#vali_datos').text('Los datos relevantes son requerido ..!!').show(); }
        else{ $('#vali_datos').hide(); }

        //if (exiteExamen == 0 && $('#form_solicitud_patologico').valid() ) {  
          if (exiteExamen == 0 && $('#fec_result').val() != '' && $('#num_examen').val() != '' && $('#medico :selected').text() != 'Selecione una opcion' && $('#servicio :selected').text() != 'Selecione una opcion' && $('#diag_clinico').val() != '' && $('#datos').val() != '') {

            var formData = new FormData(document.getElementById("form_solicitud_patologico"));
                $.ajax({
                    url:"{{route('ResultadoCitolgia.store')}}",
                    type:'POST',
                    dataType: "html",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData
                }).done(function(data){ 
                  console.log('-> '+data);
                  data = JSON.parse(data);
                 // console.log(data[0]['fecha_solicitud'] + data[0]['nombres']);
                  if(data != 'error_registro_resul_citologico'){
                    if(data[0]['fecha_solicitud'] && data[0]['nombres']){
                      notificaciones("Se registro correctamente !!", "FELICIDADES", 'success');
                     // console.log('-> '+data);
                      $('#ide').val(data[0]['id']);  $('#fec_soli').val(data[0]['fecha_solicitud']);  $('#num_examens').val(data[0]['nro_examen']); 
                      $('#fec_results').val(data[0]['fecha_resultado']);  $('#municipios').val(data[0]['municipio']);  $('#establecimientos').val(data[0]['establecimiento']); 
                      $('#nombre').val(data[0]['nombres']);  $('#apellido').val(data[0]['apellidos']);  $('#ci').val(data[0]['ci']); 
                      $('#fec_naci').val(data[0]['fecha_nacimiento']);  $('#edades').val(data[0]['edad']);  $('#medicos').val(data[0]['medico']); 
                      $('#servicios').val(data[0]['servicio']);  $('#diag').val(data[0]['diagnostico']);  $('#dato').val(data[0]['datos']); 
                      $('#des').val(data[0]['descripcion']);  $('#con').val(data[0]['conclucion']);  $('#notas').val(data[0]['nota']); 
                      $('#ModalImprimirResultCitologia').modal('show');

                    }else{
                      notificaciones("Contacte con soporte..!!", "Error al imprimir resultado", 'error');
                      //console.log('vacio');
                      setTimeout(function(){	
                         window.location="{{ route('ResultadoCitolgia.index') }}";
                      },4000);
                    }
                  }else{
                    notificaciones("Contacte con soporte..!!", "Error al registrar el resultado", 'error');
                  }
                  
                });
                $("#registrarForm").prop("disabled", true);
          }else{
            notificaciones("Verificque el formulario ..!!", "Error de formulario", 'error');
          }   
      }); 

    //se recarga la pagina cuando se cierra el modal imprimir resultado
    $('#ModalImprimirResultCitologia').on('hidden.bs.modal', function () {
      setTimeout(function(){
        window.location="{{ route('ResultadoCitolgia.index') }}";
      },1000);
    }); 

    //se da focus al siguiente input
    $("#num_examen").keypress(function() {
        if ( event.which == 13 ) { $('#fec_result').focus(); }   
    });
    $("#fec_result").keypress(function() {
        if ( event.which == 13 ) { $('#medico').focus(); }   
    });
    $("#medico").keypress(function() {
        if ( event.which == 13 ) { $('#servicio').focus(); }   
    });
    $("#servicio").keypress(function() {
        if ( event.which == 13 ) { $('#diag_clinico').focus(); }   
    });


  });
</script>
@stop