@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Pacientes
@stop

@section('styles')
{{ Html::style( asset('assets/librerias/datatables/dataTables.bootstrap4.min.css') )}}
<style>
    .error {
    color: red;
  }
</style>
@stop


@section('contenido')  
<div class="row table-responsive d-flex justify-content-center" style="font-size: 14px;">
    <div class="col-md-4 col-sm-4 mt-5">
        <form action="{{route('pacientes.store')}}" method="post" class="border border-info" id="form_paciente" autocomplete="off">
            <h5 class="box-title text-center font-weight-bold mt-2">Registrar nuevo paciente</h5>
            @csrf
            <div class="form-row mt-2">
                <div class="form-group col-md-5 col-sm-5 ml-4">
                    <label class="font-weight-bold">Nombres</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{old('nombre')}}" >
                    @error('nombre')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-5 col-sm-5 ml-1">
                    <label class="font-weight-bold">Apellidos</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" value="{{old('apellido')}}" >
                    @error('apellido')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-5 col-sm-5 ml-4">
                    <label class="font-weight-bold">Cedula de identidad</label>
                    <input type="text" class="form-control" name="ci" id="ci" value="{{old('ci')}}">
                    @error('ci')
                         <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-5 col-sm-5 ml-1">
                    <label class="font-weight-bold">Fecha nacimiento</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" >
                    @error('fecha_nacimiento')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-3 col-sm-3 ml-4">
                    <label class="font-weight-bold">Edad</label>
                    <input type="number" class="form-control" name="edad" id="edad" value="{{old('edad')}}">
                    @error('edad')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-7 col-sm-7 ml-1">
                    <label class="font-weight-bold">Direccion</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="opcional" value="{{old('direccion')}}">
                    @error('direccion')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group col-md-3 col-sm-3 ml-4">
                    <label class="font-weight-bold">Nro. celular</label>
                    <input type="number" class="form-control" name="num_celular" id="num_celular" placeholder="opcional" value="{{old('num_celular')}}">
                    @error('num_celular')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-7 col-sm-7 ml-1">
                    <label class="font-weight-bold">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="opcional" value="{{old('email')}}">
                    @error('email')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-3 col-sm-3 ml-4">
                    <label class="font-weight-bold">HC</label>
                    <input type="text" class="form-control" name="hc" id="hc" placeholder="opcional"  value="{{old('hc')}}">
                    @error('hc')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-7 col-sm-7 ml-1">
                    <label class="font-weight-bold">Nro. asegurado</label>
                    <input type="text" class="form-control" name="num_asegurado" id="num_asegurado" placeholder="opcional" value="{{old('num_asegurado')}}">
                    @error('num_asegurado')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-10 col-sm-10 ml-2">
                    <label  class="font-weight-bold ml-4">Sexo</label>
                    <input type="radio" name="sexo" id="femenino" value="Femenino" checked class="ml-4">
                    <label class="form-check-label" for="exampleRadios1F">Femenino</label>
                    <input  type="radio" name="sexo" id="Masculino" value="Masculino" class="ml-2">
                    <label class="form-check-label" for="exampleRadios1M">Masculino</label>
                </div>
                <div class="form-group col-md-10 col-sm-10 ml-4">
                    <label class="font-weight-bold">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="opcional" value="{{old('descripcion')}}">
                    @error('descripcion')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>

            </div>
            <div class="form-row mt-2 text-center">
                <div class="form-group col-md-10 col-sm-6 ml-4">
                    <button type="submit" id="registrar" class="btn btn-outline-success">Registrar</button>
                    <button type="reset" id="cancelarBtn" class="btn btn-outline-secondary m-2">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        @include('Home.mensaje')

        <h4 class="box-title text-center font-weight-bold mt-2">Lista de Pacientes</h4>
        <table id="listaPacientes" class="table table-sm table-bordered table-striped"  width="100%">
            <thead>
                <tr>
                    <th width="20px">Nro.</th>
                    <th width="150px">Nombres</th>
                    <th width="150px">Apellidos</th>
                    <th width="55px">C.I.</th>
                    <th width="55px">Fecha nacimiento</th>
                    <th width="25px">Edad</th>
                    <th width="">Opciones</th>
                </tr>
            </thead>
            <tbody id="tablaRegistrosAreas">
                @if($pacientes->isEmpty() && $pacientes->count() == 0) 
                    <tr>
                        <td colspan="5" class="">No hay ningun registrado para mostrar </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($pacientes as $paciente)
                        <tr data-id={{$paciente->id}}>
                            <td>{{ ++$i }}</td>
                            <td  >{{ $paciente->nombre }}</td>
                            <td  >{{ $paciente->apellido }}</td>
                            <td  >{{ $paciente->ci }}</td>
                            <td  >{{ $paciente->fecha_nacimiento }}</td>
                            <td  >{{$paciente->edad}} </td>
                            <td style='background-color: ;'>
                                @if($paciente->estado == "TRUE")
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="{{route('pacientes.edit',['paciente' => $paciente])}}" method="GET">
                                            <button type="submit" class="btn btn-outline-success btn-sm">Editar</button>
                                        </form>
                                    </div>   
                                    <button type="button" class="btn btn-outline-primary btn-sm ml-1"  data-toggle="modal" data-target="#ModalVer-{{$paciente->id}}">Ver</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger m-1"  data-toggle="modal" data-target="#confirmarModal-{{$paciente->id}}">Eliminar</button>
                                @else
                                    <button disabled type="button" class="btn btn-outline-success btn-sm ml-1"  data-toggle="modal" data-target="#Actualizar_Area">Editar</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm ml-1"  data-toggle="modal" data-target="#ModalVer-{{$paciente->id}}">Ver</button>
                                    <button type="button" class="btn btn-sm btn-outline-warning m-1" data-toggle="modal" data-target="#confirmarModal-{{$paciente->id}}">Restaurar</button>
                                @endif 
                            </td>
                        </tr>
                        
                        <!-- Modal ver-->
                        <div class="modal fade" id="ModalVer-{{$paciente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Datos del paciente</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ml-4">
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">Nombre y apellidos: </span>{{$paciente->nombre}} {{$paciente->apellido}}</label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">fecha de nacimiento: </span>{{$paciente->fecha_nacimiento}}
                                                <span class="fw-bolder font-weight-bold">Cedula identidad: </span>{{$paciente->ci}}
                                            </label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">Edad: </span>{{$paciente->edad}}
                                                <span class="fw-bolder font-weight-bold">Direccion: </span>{{$paciente->direccion == ''? 'No tiene' : $paciente->direccion}}
                                            </label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">H.C: </span>{{$paciente->hc == ''? 'No tiene' : $paciente->hc}}
                                                <span class="fw-bolder font-weight-bold">Nro. asegurado: </span>{{$paciente->num_asegurado == ''? 'No tiene' : $paciente->num_asegurado}}
                                            </label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">E-mail: </span>{{$paciente->email== ''? 'No tiene' : $paciente->email}}
                                                <span class="fw-bolder font-weight-bold">Nro. celular: </span>{{$paciente->num_celular == ''? 'No tiene' : $paciente->num_celular}}
                                            </label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">Sexo: </span>{{$paciente->sexo}}
                                                <span class="fw-bolder font-weight-bold">Descripcion </span>{{$paciente->descripcion == ''? 'No tiene' : $paciente->descripcion}}  
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!--Modal eliminar-->
                         <div class="modal fade" id="confirmarModal-{{$paciente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Datos del paciente</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if($paciente->estado == 'TRUE')
                                            <span class="fw-bolder font-weight-bold">Seguro que desea eliminar al paciente </span> {{$paciente->nombre}} {{$paciente->apellido}}
                                            <span class="fw-bolder font-weight-bold">con c.i. </span> {{ $paciente->ci }}
                                        @else
                                            <span class="fw-bolder font-weight-bold">Seguro que desea restaurar al paciente </span> {{$paciente->nombre}} {{$paciente->apellido}}
                                            <span class="fw-bolder font-weight-bold">con c.i. </span> {{ $paciente->ci }}
                                        @endif
                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <form action="{{route('pacientes.destroy',['paciente'=> $paciente->id])}}" method="POST">
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
<script>
    $(document).ready(function () {
                                             
        var table =  $('#listaPacientes').DataTable({
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

