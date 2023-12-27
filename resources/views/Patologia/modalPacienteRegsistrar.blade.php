<div class="modal fade" id="registrarPaciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registro de paciente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        <form id="form-registrar-paciente_cito" autocomplete="off" >  
            @csrf
              <div class="row">
                <div class="col-md-6">
                  <label for="recipient-name" class="col-form-label">Cedula de identidad</label>
                  <input type="text" class="form-control" id="c_cedula" name="c_cedula">
                </div>
                <div class="col-md-6">
                  <label for="recipient-name" class="col-form-label">Nombres</label>
                  <input type="text" class="form-control" id="c_nombres" name="c_nombres" >
                </div>
              </div>
            
              <div class="row">
                <div class="col-md-6">
                    <label for="recipient-name" class="col-form-label">Apellidos</label>
                    <input type="text" class="form-control" id="c_apellidos" name="c_apellidos" >
                </div>
                <div class="col-md-6">
                    <label for="recipient-name" class="col-form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="c_fec_nac" name="c_fec_nac" >
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-md-8">
                    <label for="recipient-name" class="col-form-label">Sexo</label>
                    <input type="radio" name="c_sexo" id="radiofemenino" value="Femenino" checked class="ml-3">
                    <label class="form-check-label" for="exampleRadios1F">Femenino</label>
                    <input  type="radio" name="c_sexo" id="radioMasculino" value="Masculino" class="ml-3">
                    <label class="form-check-label" for="exampleRadios1M">Masculino</label>
                </div>
              </div>
  
              <div class="modal-footer">
                  {!! Form::button('Registrar', ['class' => 'btn btn-primary', 'id'=> 'BtnPacienteRegistrarP' ] ) !!} 
                  {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary cancelar', 'data-dismiss'=>"modal", 'id'=>"cancelarBtnP"] ) !!}
              </div>
           </form>  
        </div>
      </div>
    </div>
  </div>
  