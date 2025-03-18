<div class="modal fade" id="exampleModalver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bolder font-weight-bold text text-center" id="exampleModalLabel">Detalles del paciente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row ml-2 ">
            <label for="" > <span class="fw-bolder font-weight-bold">Nombres y apellidos:</span> <span id="paciente"></span> </label>
          </div>
          <div class="row ml-2">
              <label for=""> <span class="fw-bolder font-weight-bold">Cedula: </span> <span id="cedula"></span>
                  <span class="fw-bolder font-weight-bold ml-2">Fecha nacimiento: </span> <span id="nacimiento"></span>
              </label>
          </div>
          <div class="row ml-2 ">
            <label for=""> <span class="fw-bolder font-weight-bold">Edad: </span> <span id="edad"></span>
                <span class="fw-bolder font-weight-bold ml-2">Direccion: </span> <span id="direccion"></span>
            </label>
          </div>
          <h5 class="fw-bolder font-weight-bold text text-center">Detalles del resultado patologia</h5>
          <div class="row ml-2">
            <label for=""> <span class="fw-bolder font-weight-bold ">Nro. examen: </span> <span id="nro_examen"></span> </label>
            <h5> <label for="" > <span class="fw-bolder font-weight-bold ml-4">Estado: </span> <span id="estadoS" class="fw-bolder font-weight-bold "></span> </label> </h5>
          </div>
          <div class="row ml-2">
              <label for=""> <span class="fw-bolder font-weight-bold">Fecha solicitud: </span> <span id="fecha_solicitud"></span>
                  <span class="fw-bolder font-weight-bold ml-2">fecha resultado: </span> <span id="fecha_resultado"></span>
              </label>
          </div>
          <div class="row ml-2">
            <label for=""> 
              <span class="fw-bolder font-weight-bold">Municipio: </span> <span id="municipio"></span>
            </label>
          </div>
          <div class="row ml-2">
            <label for="">
              <span class="fw-bolder font-weight-bold">Establecimiento:</span> <span id="establecimiento"></span>
            </label>
          </div>
         <div ><h5 class="text-center fw-bolder font-weight-bold ml-2"> Diagnosticos </h5> </div>
          <div class="row ml-2 mt-2">
              <label for="">
                 <span id="diagnosticos"></span>
              </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>