
<div class="modal fade" id="confirmarSolicitud" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bolder font-weight-bold text text-center" id="exampleModalLabel">Mensaje de confirmacion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
             {{--$producto->estado == 'Habilitado'? 'Seguro que desea eliminar el resultado... ?':'Seguro que desea restaurar resultado... ?' --}}
          <span class="fw-bolder font-weight-bold mb-5">Se eliminara la solicitud del </span> {{--<span id="examen_id"></span>--}}
          <div class="row ml-2 mt-2">
              <label for=""> <span class="fw-bolder font-weight-bold">Paciente: </span > <span id="pac_mcs" ></span> </label>
          </div> 
          <div class="row ml-2">
              <label for=""> <span class="fw-bolder font-weight-bold">Fecha de nacimiento: </span> <span id="nac_mcs" ></span> </label>
          </div>
          <div class="row ml-2">
            <label for="">
                <span class="fw-bolder font-weight-bold ">Cedula identidad: </span> <span id="ci_mcs" ></span>
            </label>
          </div>
          <div class="row ml-2">
              <label for=""> <span class="fw-bolder font-weight-bold">Nro. examen: </span> <span id="examen_mcs" ></span> </label>
          </div>
          <div class="row ml-2">
            <label for="">
                <span class="fw-bolder font-weight-bold ">Fecha solicitud: </span> <span id="fecha_mcs" ></span>
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form  method="POST" id="form-modalEliminarS">
            @csrf
            <input type="text" name="llave" id="llave" class="form-control" hidden> 
            <input type="text" name="tipoMS" id="tipoMS" class="form-control" hidden> 
            <input type="text" name="fechaMS" id="fechaMS" class="form-control" hidden> 
          </form>
          <button type="button" class="btn btn-danger" id="btnConfirmarS" >Contirmar</button>
        </div>
      </div>
    </div>
  </div>