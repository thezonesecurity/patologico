$(document).ready(function() {
    $('#limpiarFormCitologia').click(function() {//para limpiar el formulario  cuando cancelas
       // $('#form_solicitud_patologico')[0].reset();  usado
        $('#medico').val('Elegir opcion').trigger('change.select2');
        $('#servicio').val('Elegir opcion').trigger('change.select2');
        $(".examen").removeClass('is-invalid');
        $('#PvalidacionExamen').hide();
        $('#vali_fecha').hide(); 
        $('#vali_medico').hide();
        $('#vali_servicio').hide();
        $('#vali_diagnostico').hide();
        $('#vali_datos').hide();
    });

});
