$(document).ready(function() {
    $('#limpiarFormCitologia').click(function() {//para limpiar el formulario  cuando cancelas
        $('#form_solicitud_patologico')[0].reset(); 
        $('#medico').val('Elegir opcion').trigger('change.select2');
        $('#servicio').val('Elegir opcion').trigger('change.select2');
        $(".examen").removeClass('is-invalid');
        $('#PvalidacionExamen').text('Nro. de examen no existe.. !!!').removeClass('text-danger').hide();
    });

});