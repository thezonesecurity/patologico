function ClearformParcialR(){
  document.getElementById("nombre_diag").value = "";
  document.getElementById("codigo_diag").value = "";
  document.getElementById("descripcion").value = "";
}

$(document).ready(function() {
 
    //PROCESO PARA LIMPIAR EL FORMULARIO de resultado
    $('#limpiarResultR').click(function() {//para limpiar el formulario  cuando cancelas
        var temp = $('#prefijo').val();
        $('#form_reg_ResultadoR')[0].reset(); 
        $('#prefijo').val(temp);
        $(".controlExamen").removeClass('is-invalid');
        $('#validacionExamen').text('Nro de examen no existe, registrelo !!!').removeClass('text-danger').hide();
        $(".controlDiagnostico").removeClass('is-invalid');
        $('#validacionDiagnostico').text('NroCodigo de diagnostico existe, registrelo !!!').removeClass('text-danger').hide();
        $('#validacionAgregarR').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
        $("input[type='radio'][id='radioUrbano']").prop('checked',true);
        $('#validacionDiagnosticos').hide();
    });
    //procesp para vacia los inpunt del nro de examen con los cambio de radios
    $("#radioUrbano").click(function(e){
      var temp = $('#prefijo').val();
      $('#prefijo').val(temp);
      $(".controlExamen").removeClass('is-invalid');
      $('#validacionExamen').text('Nro de examen no existe, registrelo !!!').removeClass('text-danger').hide();
      $(".controlDiagnostico").removeClass('is-invalid');
      $('#validacionDiagnostico').text('NroCodigo de diagnostico existe, registrelo !!!').removeClass('text-danger').hide();
      $('#validacionAgregarR').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
      document.getElementById("paciente_cedula").value = "";
      document.getElementById("paciente_nombre").value = "";
      document.getElementById("paciente_apellido").value = "";
      document.getElementById("paciente_fec_nac").value = "";
      document.getElementById("paciente_edad").value = "";
      document.getElementById("id_examen").value = "";
      document.getElementById("examen_nro").value = "";
      $('#validacionDiagnosticos').hide();
  });
  $("#radioRrual").click(function(e){
    var temp = $('#prefijo').val();
    $('#prefijo').val(temp);
    $(".controlExamen").removeClass('is-invalid');
    $('#validacionExamen').text('Nro de examen no existe, registrelo !!!').removeClass('text-danger').hide();
    $(".controlDiagnostico").removeClass('is-invalid');
    $('#validacionDiagnostico').text('NroCodigo de diagnostico existe, registrelo !!!').removeClass('text-danger').hide();
    $('#validacionAgregarR').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();
    document.getElementById("paciente_cedula").value = "";
    document.getElementById("paciente_nombre").value = "";
    document.getElementById("paciente_apellido").value = "";
    document.getElementById("paciente_fec_nac").value = "";
    document.getElementById("paciente_edad").value = "";
    document.getElementById("id_examen").value = "";
    document.getElementById("examen_nro").value = "";
    $('#validacionDiagnosticos').hide();
  });
 
});