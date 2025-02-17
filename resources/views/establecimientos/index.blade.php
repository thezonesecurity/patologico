@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Estableciminentos
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/librerias/Select2/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/librerias/datatables/dataTables.bootstrap4.min.css') }}">
<style>
    .error {
    color: red;
  }
</style>
@stop

@section('contenido')  

<div class="row table-responsive d-flex justify-content-center" style="font-size: 13px;">
    <div class="col-md-4 col-sm-4 mt-2">

        <form action="{{route('establecimientos.store')}}" method="post" class="border border-info" id="form_establecimiento" autocomplete="off">  
            @csrf
            <h5 class="box-title text-center font-weight-bold mt-1">Registrar nuevo establecimiento</h5>
            <div class="form-row mt-1">
                <div class="form-group col-md-11 col-sm-11 ml-3 ">
                    <label class="font-weight-bold">Nombre</label>
                    <input type="text" class="form-control" name="nombre_establecimiento" id="nombre_establecimiento"  value="{{old('nombre_establecimiento')}}" >
                    @error('nombre_establecimiento')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-11 col-sm-11 ml-3" >
                    <label class="font-weight-bold">Municipio</label>
                    <select title="Seleccione una opcion" class="form-control select2" name='municipio_id'  id="municipio_id" data-size="4">
                        @foreach ($municipios as $id => $nombre)
                            <option value="{{ $id }}" {{old('municipio_id') == $id ? 'selected' : ''}} >{{ $nombre}} </option>
                        @endforeach
                    </select>
                    @error('municipio_id')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-11 col-sm-11 ml-3" >
                    <label class="font-weight-bold">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion"  value="{{old('descripcion')}}" placeholder="opcional">
                    @error('descripcion')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-10 col-sm-6 ml-1 text-center">
                    <button type="submit" id="registrar" class="btn btn-outline-success btn-sm ml-1">Registrar</button>
                    <button type="reset" id="limpiarForm" class="btn btn-outline-secondary btn-sm m-2">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8 col-sm-8">
        @include('Home.mensaje')
        <h4 class="box-title text-center font-weight-bold mt-2">Lista de establecimientos</h4>
        <table id="listaEstablecimientos" class="table table-sm table-bordered table-striped table-responsives"  width="100%">
            <thead>
                <tr>
                    <th width="5px">Nro.</th>
                    <th width="170px">Nombre</th>
                    <th width="170px">Municipio</th>
                    <th width="170px">Descripcion</th>
                    <th width="70px">Estado</th>
                    <th width="">Opciones</th>
                </tr>
            </thead>
            <tbody id="tablaRegistros">
                @if($establecimientos->isEmpty() && $establecimientos->count() == 0) 
                    <tr>
                        <td colspan="5" class="">No hay ningun registrado para mostrar </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($establecimientos as $establecimiento)
                        <tr data-id={{$establecimiento->id}}>
                            <td>{{ ++$i }}</td>
                            <td  >{{ $establecimiento->nombre_establecimiento}}</td>
                            <td  >{{ $establecimiento->municipio_esta->nombre_municipio}}</td>
                            <td  >{{ $establecimiento->descripcion }}</td>
                            @if ($establecimiento->estado == 'TRUE')
                                <td class="text-success fw-bold">Habilitado</td>
                            @else                        
                                <td class="text-danger fw-bold">Eliminado</td>
                            @endif
                            <td style='background-color: ;'>
                                @if($establecimiento->estado == "TRUE")
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="{{route('establecimientos.edit',['establecimiento' => $establecimiento])}}" method="GET">
                                            <button type="submit" class="btn btn-outline-success btn-sm">Editar</button>
                                        </form>
                                    </div>   
                                    <button type="button" class="btn btn-sm btn-outline-danger m-1"  data-toggle="modal" data-target="#confirmarModal-{{$establecimiento->id}}">Eliminar</button>
                                @else
                                    <button disabled type="button" class="btn btn-outline-success btn-sm ml-1"  data-toggle="modal" data-target="#Actualizar_Area">Editar</button>
                                    <button type="button" class="btn btn-sm btn-outline-warning m-1" data-toggle="modal" data-target="#confirmarModal-{{$establecimiento->id}}">Restaurar</button>
                                @endif 
                            </td>
                        </tr>
                        
                        <!--Modal eliminar-->
                        <div class="modal fade" id="confirmarModal-{{$establecimiento->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mensaje de confirmacion</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if($establecimiento->estado == 'TRUE')
                                            <span class="fw-bolder font-weight-bold">Seguro que desea eliminar el establecimiento </span> {{$establecimiento->nombre_establecimiento}}
                                        @else
                                            <span class="fw-bolder font-weight-bold">Seguro que desea restaurar el establecimiento </span> {{$establecimiento->nombre_establecimiento}}
                                        @endif
                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <form action="{{route('establecimientos.destroy',['establecimiento'=> $establecimiento->id])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Contirmar</button>
                                        </form>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>


@stop

@section('scripts')

<script type="text/javascript" src="{{ asset('assets/librerias/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset("assets/librerias/datatables/dataTables.bootstrap4.min.js")}}" type="text/javascript"></script> 
<script type="text/javascript" src="{{ asset('assets/librerias/Select2/js/select2.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Seleccione una opcion",
            allowClear: true,
            ancho : 'resolver'
        });
       var table =  $('#listaEstablecimientos').DataTable({
            "lengthMenu": [[ 10 , 20, 30, -1], [ 10 , 20, 30, "All"]],
            language: {
                "sProcessing":"Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "No hay datos disponibles en la Tabla",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "loadingRecords": "Cargando...",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
                  "aria": {
                    "sortAscending": ": orden ascendente",
                    "sortDescending": ": orden descendente"
                },
                  "buttons": {
                    "copy": "Copiar",
                    "updateState": "Actualizar"
                }
            },
        });
        
});
</script>
@stop
