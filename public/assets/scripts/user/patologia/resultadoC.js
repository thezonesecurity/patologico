$(document).ready(function() {
    $('#limpiarFormCitologia').click(function() {//para limpiar el formulario  cuando cancelas
        $('#form_solicitud_patologico')[0].reset(); 
        $('#medico').val('Elegir opcion').trigger('change.select2');
        $('#servicio').val('Elegir opcion').trigger('change.select2');
        $(".examen").removeClass('is-invalid');
        $('#PvalidacionExamen').text('Nro. de examen no existe.. !!!').removeClass('text-danger').hide();
    });

     //validacion para el modal registrar paciente
     var rules = /^[a-zA-ZÑñ0-9 ]{3,150}$/;
     $.validator.addMethod("nombres", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
       return this.optional(element) || rules.test(value);
     },'');
 
     $(".borrarForm").click(function() {//para limpiar los avisos de la validacion del modal formulario registrar  paciente
       $("#form_solicitud_patologico").validate().resetForm();
       $('#medico').val('Elegir opcion').trigger('change.select2');
       $('#servicio').val('Elegir opcion').trigger('change.select2');
     });
   
     $('#form_solicitud_patologico').validate({ //validacion del modal formulario registrar paciente
       rules: {
        diag_clinico: {
            nombres: true
        },
        datos: {
            nombres: true
        },
        descripcion: {
            nombres: true
        },
        conclucion: {
            nombres: true
        },
        nota: {
            nombres: true
        },
       },
       messages: {      
        diag_clinico: {
            nombres: "Formato invalido, solo a-z, 0-9, min 3 y max 150"
        },
        datos: {
            nombres: "Formato invalido, solo a-z, 0-9, min 3 y max 150"
        },
        descripcion: {
            nombres: "Formato invalido, solo a-z, 0-9, min 3 y max 150"
        },
        conclucion: {
            nombres: "Formato invalido, solo a-z, 0-9, min 3 y max 150"
        },
        nota: {
            nombres: "Formato invalido, solo a-z, 0-9, min 3 y max 150"
        },
       },
       errorClass: 'error',
    });
//

});