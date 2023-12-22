function limpiarformParcial(){
    document.getElementById("ci").value = "";
    document.getElementById("nombre_paciente").value = "";
    document.getElementById("apellido_paciente").value = "";
    document.getElementById("fecha_nac_p").value = "";
  }
  function limpiarformModalPaciente(){
    document.getElementById("cedula").value = "";
    document.getElementById("nombres").value = "";
    document.getElementById("apellidos").value = "";
    document.getElementById("fec_nacimiento").value = "";
  }
  $(document).ready(function() {
    //PROCESO PARA LIMPIAR EL FORMULARIO
    $('#limpiar').click(function() {//para limpiar el formulario  cuando cancelas
        $('#form_reg_solicitud')[0].reset(); 
        $('#municipio').val('Elegir opcion').trigger('change.select2');
        $('#establecimiento').val('Elegir opcion').trigger('change.select2');
    });

 //validacion para el modal registrar paciente
  var rules = /^[a-zA-ZÑñ ]{3,50}$/;
  $.validator.addMethod("Nombres", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
    return this.optional(element) || rules.test(value);
  },'');
  $.validator.addMethod("Apellidos", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
    return this.optional(element) || rules.test(value);
  },'');
  var rulesCI = /^[a-zA-Z0-9 ]{6,12}$/;
  $.validator.addMethod("CarnetIndentidad", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
    return this.optional(element) || rulesCI.test(value);
  },'');

  $("#cancelarBtn").click(function() {//para limpiar los avisos de la validacion del modal formulario registrar  paciente
    $("#form-registrar-paciente").validate().resetForm();
    limpiarformModalPaciente();
  });
 
  $('#form-registrar-paciente').validate({ //validacion del modal formulario registrar paciente
     rules: {
        nombres: {
          required: true,
          Nombres: true
        },
        apellidos: {
          required: true,
          Apellidos: true
        },
     },
     messages: {           
        nombres: {
          required: "Ingresa el nombre del paciente",
          Nombres: "Formato invalido. solo letras, mayusc, minusc, min 3 y max 50"
        },
        apellidos: {
          required: "Ingresa el apellido del paciente",
          Apellidos: "Formato invalido. solo letras, mayusc, minusc, min 3 y max 50"
        },
     }
  
  });
 
    
});