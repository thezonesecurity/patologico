$(document).ready(function() {
    //PROCESO PARA LIMPIAR EL FORMULARIO
    $('#limpiarForm').click(function() {//para limpiar el formulario  cuando cancelas
        $('#formRegistrarMedic')[0].reset(); 
    });
    var rulesL = /^[a-zA-ZÑñ ]{3,50}$/;
    $.validator.addMethod("campoletras", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
      return this.optional(element) || rulesL.test(value);
    },'');
    var rulesN = /^[a-zA-ZÑñ0-9- ]{5,20}$/;
    $.validator.addMethod("campoletrasNro", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
      return this.optional(element) || rulesN.test(value);
    },'');
    var rulesC = /^[0-9- ]{8,12}$/;
    $.validator.addMethod("numeros", function(value, element) {//metodo para validar con tipo de rule especifico con exprecion regular
      return this.optional(element) || rulesC.test(value);
    },'');
  
     //PROCESO DE VALIDACION PARA REGISTRAR UN SERVICIO
    $("#limpiarForm").click(function() {//para limpiar los avisos de la validacion del formulario registrar
      $("#formRegistrarMedic").validate().resetForm();
    });
   
    $('#formRegistrarMedic').validate({ //validacion del formulario registrar
       rules: {
        nombre_med: {
             required: true,
             campoletras: true
        },
        apellido_med: {
            required: true,
            campoletras: true
        },
        espe_med: {
            required: true,
            campoletras: true
        },
        cedula_med: {
            required: true,
            campoletrasNro: true
        },
        dir_med: {
            required: true,
            campoletrasNro: true
        },
        matricula_med: {
            required: true,
            campoletrasNro: true
        },
        fec_medx: {
            required: true,
        },
        celular_med: {
            required: true,
            numeros: true
        },
        email_med: {
            required: true,
            email: true
        }
       },
       messages: {           
        nombre_med: {
            required: "Este campo es requerido ..!!",
            campoletras: "Solo letras, mayusc, minusc, min 3 y max 50"
        },
        apellido_med: {
            required: "Este campo es requerido ..!!",
            campoletras: "Solo letras, mayusc, minusc, min 3 y max 50"
        },
        espe_med: {
            required: "Este campo es requerido ..!!",
            campoletras: "Solo letras, mayusc, minusc, min 3 y max 50"
        },
        cedula_med: {
            required: "Este campo es requerido ..!!",
            campoletrasNro: "Solo letras, mayusc, minusc,0-9, min 5 y max 20"
        },
        dir_med: {
            required: "Este campo es requerido ..!!",
            campoletrasNro: "Solo letras, mayusc, minusc,0-9, min 5 y max 20"
        },
        matricula_med: {
            required: "Este campo es requerido ..!!",
            campoletrasNro: "Solo letras, mayusc, minusc,0-9, min 5 y max 20"
        },
        fec_medx: {
            required: "Este campo es requerido ..!!",
        },
        celular_med: {
            required: "Este campo es requerido ..!!",
            numeros: "Solo numeros 0-9, min 8"
        },
        email_med: {
            required: "Ingresa tu correo electrónico",
            email: "Ingresa un correo electrónico válido"
        }
       },
       errorClass: 'error',
    });


      //PROCESO PARA EL MODAL INHABILITAR
    $(".invalidar").click(function(e) {
        e.preventDefault();
        var id=$(this).val(); 
        var nombre =$('#nombre'+id).text();
        var apellido =$('#apellido'+id).text();
        var cedula =$('#cedula'+id).text();
        var estado =$('#estado'+id).text();    
        console.log('id'+ id+' ser-> '+ nombre+ ' estado-> '+ estado);

        $('#abrirModalInhabilitar').modal('show');//se pasa datos al modal
        $('#idMI').val(id);
        $('#nombreMI').text(nombre);
        $('#apellidoMI').text(apellido);
        $('#cedulaMI').text(cedula);
        if(estado == 'Habilitado'){
            $('#dato').text('dara baja');
            $('.controlH').hide();
            $('.controlI').show();
        }else{
            $('#dato').text('habilitara');
            $('.controlI').hide();
            $('.controlH').show();
        }
    });

     //PROCESO PARA MANDAR DATOS AL MODAL EDITAR Y VALIDACION DEL FORMULARIO EDITAR  
  $('.edit').click(function(e) {
    e.preventDefault();
    var id=$(this).val(); 
    var servicio =$('#servicio'+id).text();
    var responsable =$('#responsable'+id).text();
    var estado =$('#estado'+id).text();    
  // console.log('id_user '+ id+' -> '+ responsable+ ' -> '+ res);
    
    $('#ActualizarServicio').modal('show');//se pasa datos al modal
    $('#idM').val(id);
    $('#servicioM').val(servicio);
    $('#responsableM').val(responsable);
    $('#estadoM').val(estado);
  });
    // Inicializa el plugin de jQuery Validate para validar el formulario en el modal
    $("#cancelarBtnM").click(function() {//para limpiar los avisos de la validacion del formulario editar
    $("#form-editarServicio").validate().resetForm();
    });
    //
    $('#form-editarServicio').validate({//validacion del formulario editar
        rules: {
            servicioM: {
            required: true,
            NombreServicio: true
            },
        },
        messages: {
            servicioM: {
            required: 'Por favor, ingrese su nombre',
            NombreServicio: "Formato invalido. solo letras, mayusc, minusc, min 5 y max 50"
            },
        },
        errorClass: 'error'
    }); 
});