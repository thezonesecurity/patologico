
<div class="modal fade" id="confirmarResultado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <span class="fw-bolder font-weight-bold mb-5">Se eliminara el resultado del </span> {{--<span id="nro_id"></span>--}}
          <div class="row ml-2 mt-2">
            <label for=""> <span class="fw-bolder font-weight-bold">Paciente: </span > <span id="pac_mcr" ></span> </label>
          </div> 
          <div class="row ml-2">
              <label for=""> <span class="fw-bolder font-weight-bold">Fecha de nacimiento: </span> <span id="nac_mcr" ></span> </label>
          </div>
          <div class="row ml-2">
            <label for=""> <span class="fw-bolder font-weight-bold ">Cedula identidad: </span> <span id="ci_mcr" ></span> </label>
          </div>
          <div class="row ml-2">
              <label for=""> <span class="fw-bolder font-weight-bold">Nro. examen: </span> <span id="examen_mcr" ></span> </label>
          </div>
          <div class="row ml-2">
            <label for=""> <span class="fw-bolder font-weight-bold ">Fecha solicitud: </span> <span id="fechaS_mcr" ></span> </label>
          </div>
          <div class="row ml-2">
            <label for=""> <span class="fw-bolder font-weight-bold ">Fecha Resultado: </span> <span id="fechaR_mcr" ></span> </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form method="POST" id="form-modalEliminarR">
            @csrf
            <input type="text" name="llaveR" id="llaveR" class="form-control" hidden> 
            <input type="text" name="tipoMR" id="tipoMR" class="form-control" hidden> 
            <input type="text" name="fechaRMR" id="fechaRMR" class="form-control" hidden> 
            <input type="text" name="fechaSMR" id="fechaSMR" class="form-control" hidden> 
          </form>
          <button type="button" class="btn btn-danger" id="btnConfirmarR" >Contirmar</button>
        </div>
      </div>
    </div>
  </div>