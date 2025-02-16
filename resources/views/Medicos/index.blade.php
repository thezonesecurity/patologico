@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Medicos
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
    <div class="col-md-4 col-sm-4 mt-2">

        <form action="{{route('medicos.store')}}" method="post" class="border border-info" id="form_medico" autocomplete="off">  
           
            @csrf
            <h5 class="box-title text-center font-weight-bold mt-1">Registrar nuevo medico</h5>
            <div class="form-row mt-1">
                <div class="form-group col-md-5 col-sm-5 ml-3">
                    <label class="font-weight-bold">Nombres</label>
                    <input type="text" class="form-control" name="nombre" id="nombre"  value="{{old('nombre')}}">
                    @error('nombre')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6 col-sm-6 ml-1" >
                    <label class="font-weight-bold">Apellidos</label>
                    <input type="text" class="form-control" name="apellido" id="apellido"  value="{{old('apellido')}}">
                    @error('apellido')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-4 col-sm-4 ml-3">
                    <label class="font-weight-bold">Cedula de identidad</label>
                    <input type="text" class="form-control" name="ci" id="ci"  value="{{old('ci')}}" >
                    @error('ci')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-7 col-sm-7 ml-1">
                    <label class="font-weight-bold">Fecha nacimiento</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento"   value="{{old('fecha_nacimiento')}}">
                    @error('fecha_nacimiento')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-2 col-sm-2 ml-3">
                    <label class="font-weight-bold">Edad</label>
                    <input type="text" class="form-control" name="edad" id="edad"  value="{{old('edad')}}">
                    @error('edad')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-9 col-sm-9 ml-1">
                    <label  class="font-weight-bold ml-4">Sexo</label><br>
                    <input type="radio" name="sexo" id="Femenino" value="Femenino" checked class="ml-4">
                    <label class="form-check-label" for="exampleRadios1F">Femenino</label>
                    <input  type="radio" name="sexo" id="Masculino" value="Masculino" class="ml-2">
                    <label class="form-check-label" for="exampleRadios1M">Masculino</label>
                </div>
                <div class="form-group col-md-5 col-sm-5 ml-3">
                    <label class="font-weight-bold">Especialidad</label>
                    <input type="text" class="form-control" name="especialidad" id="especialidad"  value="{{old('especialidad')}}">
                    @error('especialidad')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6 col-sm-6 ml-1" >
                    <label class="font-weight-bold">Correo electronico</label>
                    <input type="email" class="form-control" name="email" id="email"  value="{{old('email')}}" placeholder="opcional">
                    @error('email')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-4 col-sm-4 ml-3">
                    <label class="font-weight-bold">Nro. celular</label>
                    <input type="text" class="form-control" name="num_celular" id="num_celular"  value="{{old('num_celular')}}" placeholder="opcional">
                    @error('num_celular')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-7 col-sm-7 ml-1">
                    <label class="font-weight-bold">Matricula</label>
                    <input type="text" class="form-control" name="matricula_profesional" id="matricula_profesional"  value="{{old('matricula_profesional')}}">
                    @error('matricula_profesional')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-11 col-sm-11 ml-3">
                    <label class="font-weight-bold">Direccion</label>
                    <input type="text" class="form-control" name="direccion" id="direccion"  value="{{old('direccion')}}" placeholder="opcional">
                    @error('direccion')
                        <small class="text-danger">{{'* '.$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-11 col-sm-11 ml-3">
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
        <h4 class="box-title text-center font-weight-bold mt-2">Lista de medicos</h4>
        <table id="listaMedicos" class="table table-sm table-bordered table-striped table-responsives"  width="100%">
            <thead>
                <tr>
                    <th width="20px">Nro.</th>
                    <th width="150px">Nombres</th>
                    <th width="150px">Apellidos</th>
                    <th width="69px">C.I.</th>
                    <th width="55px">Fecha nacimiento</th>
                    <th width="25px">Edad</th>
                    <th width="">Opciones</th>
                </tr>
            </thead>
            <tbody id="tablaRegistros">
                @if($medicos->isEmpty() && $medicos->count() == 0) 
                    <tr>
                        <td colspan="5" class="">No hay ningun registrado para mostrar </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($medicos as $medico)
                        <tr data-id={{$medico->id}}>
                            <td>{{ ++$i }}</td>
                            <td  >{{ $medico->nombre }}</td>
                            <td  >{{ $medico->apellido }}</td>
                            <td  >{{ $medico->ci }}</td>
                            <td  >{{ $medico->fecha_nacimiento }}</td>
                            <td  >{{$medico->edad}} </td>
                            <td style='background-color: ;'>
                                <button type="button" class="btn btn-outline-primary btn-sm ml-1"  data-toggle="modal" data-target="#ModalVerM-{{$medico->id}}">Ver</button>
                                @if($medico->estado == "TRUE")
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="{{route('medicos.edit',['medico' => $medico])}}" method="GET">
                                            <button type="submit" class="btn btn-outline-success btn-sm">Editar</button>
                                        </form>
                                    </div>   
                                    <button type="button" class="btn btn-sm btn-outline-danger m-1"  data-toggle="modal" data-target="#confirmarModal-{{$medico->id}}">Eliminar</button>
                                @else
                                    <button disabled type="button" class="btn btn-outline-success btn-sm ml-1"  data-toggle="modal" data-target="#Actualizar_Area">Editar</button>
                                    <button type="button" class="btn btn-sm btn-outline-warning m-1" data-toggle="modal" data-target="#confirmarModal-{{$medico->id}}">Restaurar</button>
                                @endif 
                            </td>
                        </tr>
                        
                        <!-- Modal ver-->
                        <div class="modal fade" id="ModalVerM-{{$medico->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Datos del medico</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body ml-4">
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">Nombre y apellidos: </span>{{$medico->nombre}} {{$medico->apellido}}</label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">fecha de nacimiento: </span>{{$medico->fecha_nacimiento}}
                                                <span class="fw-bolder font-weight-bold ml-2">Cedula identidad: </span>{{$medico->ci}}
                                            </label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">Edad: </span>{{$medico->edad}}
                                                <span class="fw-bolder font-weight-bold ml-2">Direccion: </span>{{$medico->direccion == ''? 'No tiene' : $medico->direccion}}
                                            </label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">Especialidad: </span>{{$medico->especialidad == ''? 'No tiene' : $medico->especialidad }}
                                                <span class="fw-bolder font-weight-bold ml-2">Nro. matricula: </span>{{$medico->matricula_profesional == ''? 'No tiene' : $medico->matricula_profesional}}
                                            </label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">E-mail: </span>{{$medico->email== ''? 'No tiene' : $medico->email}}
                                                <span class="fw-bolder font-weight-bold ml-2">Nro. celular: </span>{{$medico->num_celular == ''? 'No tiene' : $medico->num_celular}}
                                            </label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for=""> <span class="fw-bolder font-weight-bold">Sexo: </span>{{$medico->sexo}}
                                                <span class="fw-bolder font-weight-bold ml-2">Descripcion </span>{{$medico->descripcion == ''? 'No tiene' : $medico->descripcion}}  
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
                        <div class="modal fade" id="confirmarModal-{{$medico->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mensaje de confirmacion</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if($medico->estado == 'TRUE')
                                            <span class="fw-bolder font-weight-bold">Seguro que desea eliminar al paciente </span> {{$medico->nombre}} {{$medico->apellido}}
                                            <span class="fw-bolder font-weight-bold">con c.i. </span> {{ $medico->ci }}
                                        @else
                                            <span class="fw-bolder font-weight-bold">Seguro que desea restaurar al paciente </span> {{$medico->nombre}} {{$medico->apellido}}
                                            <span class="fw-bolder font-weight-bold">con c.i. </span> {{ $medico->ci }}
                                        @endif
                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <form action="{{route('medicos.destroy',['medico'=> $medico->id])}}" method="POST">
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
       var table =  $('#listaMedicos').DataTable({
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
