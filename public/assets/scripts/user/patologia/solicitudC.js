function limpiarformParcialP(){
    document.getElementById("p_ci").value = "";
    document.getElementById("p_nombre_paciente").value = "";
    document.getElementById("p_apellido_paciente").value = "";
    document.getElementById("p_fecha_nac").value = "";
  }
  function limpiarformModalPaciente(){
    document.getElementById("cedula").value = "";
    document.getElementById("nombres").value = "";
    document.getElementById("apellidos").value = "";
    document.getElementById("fec_nacimiento").value = "";
  }

  $(document).ready(function() {
    //PROCESO PARA LIMPIAR EL FORMULARIO
    $('#limpiarForm').click(function() {//para limpiar el formulario  cuando cancelas
        $('#form_solicitud_patologico')[0].reset(); 
        $('#p_municipio').val('Elegir opcion').trigger('change.select2');
        $('#p_establecimiento').val('Elegir opcion').trigger('change.select2');
        $(".PcontrolCi").removeClass('is-invalid');//-
        $('#PvalidacionCi').removeClass('text-danger').hide();//-
        $('#validacionPacienteR').hide();  
        $('#validacionAgregar').hide();
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

    $("#cancelarBtnP").click(function() {//para limpiar los avisos de la validacion del modal formulario registrar  paciente
      $("#form-registrar-paciente_cito").validate().resetForm();
      limpiarformModalPacienteCito();
    });
  
    $('#form-registrar-paciente_cito').validate({ //validacion del modal formulario registrar paciente
      rules: {
          c_nombres: {
            required: true,
            Nombres: true
          },
          c_apellidos: {
            required: true,
            Apellidos: true
          },
      },
      messages: {           
          c_nombres: {
            required: "Ingresa el nombre del paciente",
            Nombres: "Formato invalido. solo letras, mayusc, minusc, min 3 y max 50"
          },
          c_apellidos: {
            required: "Ingresa el apellido del paciente",
            Apellidos: "Formato invalido. solo letras, mayusc, minusc, min 3 y max 50"
          },
      }
    
    });
 

  });