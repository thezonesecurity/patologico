<div class="modal fade bd-example-modal-lg" id="ActualizarMedico" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar medico</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">
                <form id="form-editarMedico" autocomplete="off" action="{{route('editarsave.medico')}}" method="post">     
                    @csrf 
                    <input type="hidden" name="id" id="idM">
                    <div class="form-row mt-2">
                        <div class="form-group col-md-4 col-sm-4 ml-4">
                            <label class="font-weight-bold">Nombre</label>
                            <input type="text" class="form-control" name="M_nombre_med" id="M_nombre_med" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 ml-1">
                            <label class="font-weight-bold">Apellido</label>
                            <input type="text" class="form-control" name="M_apellido_med" id="M_apellido_med" >
                        </div>
                        <div class="form-group col-md-2 col-sm-2 ml-4">
                            <label class="font-weight-bold">Cedula</label>
                            <input type="text" class="form-control" name="M_cedula_med" id="M_cedula_med" >
                        </div>
                        <div class="form-group col-md-3 col-sm-3 ml-4">
                            <label class="font-weight-bold">Fecha nacimiento</label>
                            <input type="date" class="form-control" name="M_fec_med" id="M_fec_med" >
                        </div>
                        <div class="form-group col-md-8 col-sm-8 ml-4">
                            <label class="font-weight-bold">Direccion</label>
                            <input type="text" class="form-control" name="M_dir_med" id="M_dir_med">
                        </div>
                        <div class="form-group col-md-3 col-sm-3 ml-1">
                            <label  class="font-weight-bold ml-4">Sexo</label>
                            <div class="form-row">
                                <input type="radio" name="M_sexo_med" id="femenino" value="Femenino" checked class="ml-5">
                                <label class="form-check-label ml-2" for="exampleRadios1F">Femenino</label>
                            </div>
                            <input  type="radio" name="M_sexo_med" id="Masculino" value="Masculino" class="ml-5 mt-2">
                            <label class="form-check-label ml-2" for="exampleRadios1M">Masculino</label>
                        </div>
                        <div class="form-group col-md-8 col-sm-8 ml-4">
                            <label class="font-weight-bold">Especialidad</label>
                            <input type="text" class="form-control" name="M_espe_med" id="M_espe_med">
                        </div>
                        <div class="form-group col-md-4 col-sm-4 ml-4">
                            <label class="font-weight-bold">Correo electronico</label>
                            <input type="email" class="form-control" name="M_email_med" id="M_email_med">
                        </div>
                        <div class="form-group col-md-3 col-sm-3 ml-2">
                            <label class="font-weight-bold">Nro. celular</label>
                            <input type="text" class="form-control" name="M_celular_med" id="M_celular_med" >
                        </div>
                        <div class="form-group col-md-3 col-sm-3 ml-2">
                            <label class="font-weight-bold">Matricula</label>
                            <input type="text" class="form-control" name="M_matricula_med" id="M_matricula_med" >
                        </div>
                       
                    </div>
                
                    <div class="modal-footer">
                        {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary', 'id'=> 'saveChanges' ] ) !!} 
                        {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary cancelar', 'data-dismiss'=>"modal", 'id'=>"cancelarBtnM"] ) !!}
                    </div>
                </form>   
        </div>
      </div>
    </div>
</div>
  

{{--  MODAL NORMAL
<div class="modal fade" id="ActualizarMedico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar medico</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="form-editarServicio" autocomplete="off" action="{{route('editarsave.medico')}}" method="post">     
                @csrf 
                <input type="hidden" name="id" id="idM">
                <div class="form-row mt-2">
                    <div class="form-group col-md-5 col-sm-5 ml-4">
                        <label class="font-weight-bold">Nombre</label>
                        <input type="text" class="form-control" name="nombre_med" id="nombre_med" >
                    </div>
                    <div class="form-group col-md-5 col-sm-5 ml-1">
                        <label class="font-weight-bold">Apellido</label>
                        <input type="text" class="form-control" name="apellido_med" id="apellido_med" >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 ml-4">
                        <label class="font-weight-bold">Cedula</label>
                        <input type="text" class="form-control" name="cedula_med" id="cedula_med" >
                    </div>
                    <div class="form-group col-md-6 col-sm-6 ml-1">
                        <label class="font-weight-bold">Fecha nacimiento</label>
                        <input type="date" class="form-control" name="fec_med" id="fec_med" >
                    </div>
                    <div class="form-group col-md-10 col-sm-6 ml-1">
                        <label  class="font-weight-bold ml-4">Sexo</label>
                        <input type="radio" name="sexo_med" id="femenino" value="Femenino" checked class="ml-4">
                        <label class="form-check-label" for="exampleRadios1F">Femenino</label>
                        <input  type="radio" name="sexo_med" id="Masculino" value="Masculino" class="ml-2">
                        <label class="form-check-label" for="exampleRadios1M">Masculino</label>
                    </div>
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <label class="font-weight-bold">Direccion</label>
                        <input type="text" class="form-control" name="dir_med" id="dir_med">
                    </div>
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <label class="font-weight-bold">Correo electronico</label>
                        <input type="email" class="form-control" name="email_med" id="email_med">
                    </div>
                    <div class="form-group col-md-5 col-sm-5 ml-4">
                        <label class="font-weight-bold">Nro. celular</label>
                        <input type="text" class="form-control" name="celular_med" id="celular_med" >
                    </div>
                    <div class="form-group col-md-5 col-sm-5 ml-1">
                        <label class="font-weight-bold">Matricula</label>
                        <input type="text" class="form-control" name="matricula_med" id="matricula_med" >
                    </div>
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <label class="font-weight-bold">Especialidad</label>
                        <input type="text" class="form-control" name="espe_med" id="espe_med">
                    </div>
                    <div class="form-group col-md-10 col-sm-6 ml-4">
                        <button type="submit" id="registrar" class="btn btn-outline-success">Registrar</button>
                        <button type="reset" id="limpiarForm" class="btn btn-outline-secondary m-2">Limpiar</button>
                    </div>
                </div>
            
                <div class="modal-footer">
                    {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary', 'id'=> 'saveChanges' ] ) !!} 
                    {!! Form::reset('Cancelar', ['class' => 'btn btn-secondary cancelar', 'data-dismiss'=>"modal", 'id'=>"cancelarBtnM"] ) !!}
                </div>
            </form>   
      </div>
    </div>
  </div>   
---}}