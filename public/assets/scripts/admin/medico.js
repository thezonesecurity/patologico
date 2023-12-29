$(document).ready(function() {
    //PROCESO PARA LIMPIAR EL FORMULARIO
    $('#formRegistrarMedic').click(function() {//para limpiar el formulario  cuando cancelas
        $('#form_solicitud_patologico')[0].reset(); 
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
});