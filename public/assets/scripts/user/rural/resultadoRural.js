function ClearformParcialR(){
  document.getElementById("nombre_diag").value = "";
  document.getElementById("codigo_diag").value = "";
  document.getElementById("descripcion").value = "";
}

$(document).ready(function() {
    //PROCESO PARA LIMPIAR EL FORMULARIO de resultado
    $('#limpiarResultR').click(function() {//para limpiar el formulario  cuando cancelas
        $('#form_reg_ResultadoR')[0].reset(); 
        $(".controlExamen").removeClass('is-invalid');
        $('#validacionExamen').text('Nro de examen no existe, registrelo !!!').removeClass('text-danger').hide();
        $(".controlDiagnostico").removeClass('is-invalid');
        $('#validacionDiagnostico').text('NroCodigo de diagnostico existe, registrelo !!!').removeClass('text-danger').hide();
        $('#validacionAgregarR').text('Error verifique los errores del formulario !!!').removeClass('text-danger').hide();

    });
 
});