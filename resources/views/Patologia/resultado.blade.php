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
}
</style>
@stop


@section('contenido')  

<div class="row table-responsive d-flex justify-content-center border border-danger" style="font-size: 14px;">
  <form action="" method="post" class="border border-info" id="form_medico" autocomplete="off">  
  <div class="col-md-5 col-sm-4 mt-2">

      {{--<form action="" method="post" class="border border-info" id="form_medico" autocomplete="off">--}}  
         
          @csrf
          <h5 class="box-title text-center font-weight-bold mt-1">Registrar nuevo medico</h5>
          <div class="form-row mt-1">
              <div class="form-group col-md-5 col-sm-5 ml-3">
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
              <div class="form-group col-md-6 col-sm-6 ml-1" >
                <label  for="inline-fec_result">Fecha Resultado</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend"> 
                    <div class="input-group-text"><i class="bi bi-calendar-date"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
                  </div>
                  <input type="date" class="form-control" id="fec_result" name="fec_result" value="<?php echo date('Y-m-d'); ?>">
                </div>
              </div>
              <div class="form-group col-md-4 col-sm-4 ml-3">
                <label  for="inline_nombres">Nombres</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="bi bi-person-lock"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
                  </div>
                  <input type="text" class="form-control" id="nombre_pac" name="nombre_pac" readonly>
                </div>
              </div>
              <div class="form-group col-md-7 col-sm-7 ml-1">
                <label  for="inlineapellidos">Apellidos</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="bi bi-person-lock"  style="font-size: 1.3rem; color: rgb(0, 0, 0);"></i></div>
                  </div>
                  <input type="text" class="form-control" id="apellido_pac" name="apellido_pac"  readonly>
                </div>
              </div>
              <div class="form-group col-md-2 col-sm-2 ml-3">
                  <label class="font-weight-bold">Edad</label>
                  <input type="text" class="form-control" name="edad" id="edad"  value="{{old('edad')}}">
                  @error('edad')
                      <small class="text-danger">{{'* '.$message}}</small>
                  @enderror
              </div>
              <div class="form-group col-md-9 col-sm-9 ml-1">
                  <label  class="font-weight-bold ml-4">Sexo</label><br>
                  <input type="radio" name="sexo" id="Femenino" value="Femenino" checked class="ml-4">
                  <label class="form-check-label" for="exampleRadios1F">Femenino</label>
                  <input  type="radio" name="sexo" id="Masculino" value="Masculino" class="ml-2">
                  <label class="form-check-label" for="exampleRadios1M">Masculino</label>
              </div>
              <div class="form-group col-md-5 col-sm-5 ml-3">
                  <label class="font-weight-bold">Especialidad</label>
                  <input type="text" class="form-control" name="especialidad" id="especialidad"  value="{{old('especialidad')}}">
                  @error('especialidad')
                      <small class="text-danger">{{'* '.$message}}</small>
                  @enderror
              </div>
              <div class="form-group col-md-6 col-sm-6 ml-1" >
                  <label class="font-weight-bold">Correo electronico</label>
                  <input type="email" class="form-control" name="email" id="email"  value="{{old('email')}}" placeholder="opcional">
                  @error('email')
                      <small class="text-danger">{{'* '.$message}}</small>
                  @enderror
              </div>
              <div class="form-group col-md-4 col-sm-4 ml-3">
                  <label class="font-weight-bold">Nro. celular</label>
                  <input type="text" class="form-control" name="num_celular" id="num_celular"  value="{{old('num_celular')}}" placeholder="opcional">
                  @error('num_celular')
                      <small class="text-danger">{{'* '.$message}}</small>
                  @enderror
              </div>
              <div class="form-group col-md-7 col-sm-7 ml-1">
                  <label class="font-weight-bold">Matricula</label>
                  <input type="text" class="form-control" name="matricula_profesional" id="matricula_profesional"  value="{{old('matricula_profesional')}}">
                  @error('matricula_profesional')
                      <small class="text-danger">{{'* '.$message}}</small>
                  @enderror
              </div>
              <div class="form-group col-md-11 col-sm-11 ml-3">
                  <label class="font-weight-bold">Direccion</label>
                  <input type="text" class="form-control" name="direccion" id="direccion"  value="{{old('direccion')}}" placeholder="opcional">
                  @error('direccion')
                      <small class="text-danger">{{'* '.$message}}</small>
                  @enderror
              </div>
              <div class="form-group col-md-11 col-sm-11 ml-3">
                  <label class="font-weight-bold">Descripcion</label>
                  <input type="text" class="form-control" name="descripcion" id="descripcion"  value="{{old('descripcion')}}" placeholder="opcional">
                  @error('descripcion')
                      <small class="text-danger">{{'* '.$message}}</small>
                  @enderror
              </div>

              <div class="form-group col-md-10 col-sm-6 ml-1 text-center">
                  <button type="submit" id="registrar" class="btn btn-outline-success btn-sm ml-1">Registrar</button>
                  <button type="reset" id="limpiarForm" class="btn btn-outline-secondary btn-sm m-2">Limpiar</button>
              </div>
          </div>
      {{--</form>--}}
  </div>
  <div class="col-md-8 col-sm-8 mt-2">
    {{--<form action="" method="post" class="border border-info" id="form_medico" autocomplete="off">  --}}
         
      @csrf
      <h5 class="box-title text-center font-weight-bold mt-1">Registrar nuevo medico</h5>
      <div class="form-row mt-1">
          <div class="form-group col-md-5 col-sm-5 ml-3">
              <label class="font-weight-bold">Nombres</label>
              <input type="text" class="form-control" name="nombre" id="nombre"  value="{{old('nombre')}}">
              @error('nombre')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-6 col-sm-6 ml-1" >
              <label class="font-weight-bold">Apellidos</label>
              <input type="text" class="form-control" name="apellido" id="apellido"  value="{{old('apellido')}}">
              @error('apellido')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4 ml-3">
              <label class="font-weight-bold">Cedula de identidad</label>
              <input type="text" class="form-control" name="ci" id="ci"  value="{{old('ci')}}" >
              @error('ci')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-7 col-sm-7 ml-1">
              <label class="font-weight-bold">Fecha nacimiento</label>
              <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento"   value="{{old('fecha_nacimiento')}}">
              @error('fecha_nacimiento')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-2 col-sm-2 ml-3">
              <label class="font-weight-bold">Edad</label>
              <input type="text" class="form-control" name="edad" id="edad"  value="{{old('edad')}}">
              @error('edad')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-9 col-sm-9 ml-1">
              <label  class="font-weight-bold ml-4">Sexo</label><br>
              <input type="radio" name="sexo" id="Femenino" value="Femenino" checked class="ml-4">
              <label class="form-check-label" for="exampleRadios1F">Femenino</label>
              <input  type="radio" name="sexo" id="Masculino" value="Masculino" class="ml-2">
              <label class="form-check-label" for="exampleRadios1M">Masculino</label>
          </div>
          <div class="form-group col-md-5 col-sm-5 ml-3">
              <label class="font-weight-bold">Especialidad</label>
              <input type="text" class="form-control" name="especialidad" id="especialidad"  value="{{old('especialidad')}}">
              @error('especialidad')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-6 col-sm-6 ml-1" >
              <label class="font-weight-bold">Correo electronico</label>
              <input type="email" class="form-control" name="email" id="email"  value="{{old('email')}}" placeholder="opcional">
              @error('email')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4 ml-3">
              <label class="font-weight-bold">Nro. celular</label>
              <input type="text" class="form-control" name="num_celular" id="num_celular"  value="{{old('num_celular')}}" placeholder="opcional">
              @error('num_celular')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-7 col-sm-7 ml-1">
              <label class="font-weight-bold">Matricula</label>
              <input type="text" class="form-control" name="matricula_profesional" id="matricula_profesional"  value="{{old('matricula_profesional')}}">
              @error('matricula_profesional')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-11 col-sm-11 ml-3">
              <label class="font-weight-bold">Direccion</label>
              <input type="text" class="form-control" name="direccion" id="direccion"  value="{{old('direccion')}}" placeholder="opcional">
              @error('direccion')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-11 col-sm-11 ml-3">
              <label class="font-weight-bold">Descripcion</label>
              <input type="text" class="form-control" name="descripcion" id="descripcion"  value="{{old('descripcion')}}" placeholder="opcional">
              @error('descripcion')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>

          <div class="form-group col-md-10 col-sm-6 ml-1 text-center">
              <button type="submit" id="registrar" class="btn btn-outline-success btn-sm ml-1">Registrar</button>
              <button type="reset" id="limpiarForm" class="btn btn-outline-secondary btn-sm m-2">Limpiar</button>
          </div>
      </div>
    {{--</form>--}}
    </div>
  </form>
</div>

{{--
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
             console.log(data);
            if(data == 'no_encontrado'){
                $(".examen").addClass('is-invalid');
                $('#PvalidacionExamen').text('Nro. de examen no econtrado.. !!!').addClass('text-danger').show();
                document.getElementById("nombre_pac").value = "";
                document.getElementById("apellido_pac").value = "";
                document.getElementById("cedula_pac").value = "";
                document.getElementById("nac_pac").value = "";
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
                  exiteExamen = 1;
                }
                else{
                  $(".examen").removeClass('is-invalid');
                  $('#PvalidacionExamen').text('Nro. de examen no existe.. !!!').removeClass('text-danger').hide();
                  $('#nombre_pac').val(data[0]['nombre_pac']);
                  $('#apellido_pac').val(data[0]['apellido_pac']);
                  $('#cedula_pac').val(data[0]['ci_pac']);
                  $('#nac_pac').val(data[0]['fec_nac_pac']);
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
        var fec_soli = $('#fec_result').val();
        var medic = $('#medico :selected').text();
        var service = $('#servicio :selected').text();
        if ($('#fec_result').val() == '') {
          notificaciones("Seleccione una fecha de resultado !!", "ERROR DE FORMULARIO", 'error');
          return false;
        } 
        if ($('#num_examen').val() == '') {
          notificaciones("Ingrese un nro. de examen !!", "ERROR DE FORMULARIO", 'error');
          return false;
        }
        if ($('#medico :selected').text() == 'Selecione una opcion') {
          notificaciones("Seleccione un medico!!", "ERROR DE FORMULARIO", 'error');
          return false;
        } 
        if ($('#servicio :selected').text() == 'Selecione una opcion') {
          notificaciones("Selecione un servicio !!", "ERROR DE FORMULARIO", 'error');
          return false;
        } 
        if (exiteExamen == 0 && $('#form_solicitud_patologico').valid() ) {  
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
                  console.log(data);
                  if(data == 'ok'){
                    notificaciones("Se registro correctamente !!", "FELICIDADES", 'success');
                    $('#ModalImprimirResultCitologia').modal('show');
                  }
                  else {
                    notificaciones("ERROR NO SE PUDO REALIZAR EL REGISTRO !!", "CONTACTE CON SOPORTE", 'error');
                    setTimeout(function(){	
                      window.location="{{ route('ResultadoCitolgia.index') }}";
                    },4000);
                  }
                });
                $("#registrarForm").prop("disabled", true);
          }   
      }); 
    //se recarga la pagina cuando se cierra el modal de lista de solicitudes
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