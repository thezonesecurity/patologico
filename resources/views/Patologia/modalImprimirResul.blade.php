
<div class="modal fade" id="ModalImprimirResultCitologia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Mensaje de confirmacion..!</h5>
        </div>
        <div class="modal-body">
          <div>Desea imprimir el resultado registrado ?</div>
        </div>
        <div class="modal-footer">
           <form action="{{route('print.result.one')}}"  method="POST" id="form-modalImprimir" target='_Blank'>
              @csrf
              <input type="text" name="ide" id="ide" class="form-control" hidden disabled> 
              <input type="text" name="fec_soli" id="fec_soli" class="form-control"  hidden > 
              <input type="text" name="num_examens" id="num_examens" class="form-control"  hidden > 
              <input type="text" name="fec_results" id="fec_results" class="form-control"  hidden > 
              <input type="text" name="municipios" id="municipios" class="form-control"  hidden > 
              <input type="text" name="establecimientos" id="establecimientos" class="form-control"  hidden > 
              <input type="text" name="nombre" id="nombre" class="form-control"  hidden > 
              <input type="text" name="apellido" id="apellido" class="form-control"  hidden > 
              <input type="text" name="ci" id="ci" class="form-control"  hidden > 
              <input type="text" name="fec_naci" id="fec_naci" class="form-control"  hidden > 
              <input type="text" name="edades" id="edades" class="form-control"  hidden > 
              <input type="text" name="medicos" id="medicos" class="form-control"  hidden > 
              <input type="text" name="servicios" id="servicios" class="form-control"  hidden > 
              <input type="text" name="diag" id="diag" class="form-control"  hidden > 
              <input type="text" name="dato" id="dato" class="form-control"  hidden > 
              <input type="text" name="des" id="des" class="form-control" hidden  > 
              <input type="text" name="con" id="con" class="form-control" hidden  > 
              <input type="text" name="notas" id="notas" class="form-control" hidden > 
              <button type="submit" class="btn btn-danger" id="btnImprimir" >Imprimir</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> {{--hidden disabled --}}
        </div>
      </div>
    </div>
  </div>
