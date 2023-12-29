@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Medicos
@stop

@section('styles')

@stop


@section('contenido')  

<div class="row table-responsive d-flex justify-content-center" style="font-size: 14px;">
    <div class="col-md-3 col-sm-3 mt-5">
        <form action="{{route('registrar.medico')}}" method="post" class="border border-info" id="formRegistrarMedic" autocomplete="off">
            
        <h5 class="box-title text-center font-weight-bold mt-2">Registrar medico</h5>
            @csrf
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
        </form>
    </div>
    <div class="col-md-9">
        @include('Home.mensaje')
        <h4 class="box-title text-center font-weight-bold mt-2">Lista de medicos</h4>
        <table id="listaMedicos" class="table table-sm table-bordered table-striped table-responsives"  width="100%">
            <thead>
                <tr>
                    <th width="20px">Nro.</th>
                    <th width="180px">Nombre</th>
                    <th width="180px">Apellido</th>
                    <th width="180px">Cedula</th>
                    <th width="180px">Fecha nacimiento</th>
                    <th width="180px">Edad</th>
                    <th width="180px">Sexo</th>
                    <th width="180px">Direccion</th>
                    <th width="200px">Nro. celular</th>
                    <th width="200px">Matricula</th>
                    <th width="200px">Especialidad</th>
                    <th width="100px">Estado</th>
                    <th width="150px">Opciones</th>
                </tr>
            </thead>
            <tbody id="tablaRegistros">
                @if($medicos->isEmpty() && $medicos->count() == 0) 
                    <tr>
                        <td colspan="12" class="">No hay ningun data registrado aun... </td>
                    </tr>
                @else 
                    <?php $i=0; ?>
                    @foreach ($medicos as $medico)
                    <tr data-id={{$medico->id}}>
                        <td>{{ ++$i }}</td>
                        <td id="nombre{{$medico->id}}">{{ $medico->nombre }}</td>
                        <td id="apellido{{$medico->id}}">{{ $medico->apellido }}</td>
                        <td id="cedula{{$medico->id}}">{{ $medico->ci }}</td>
                        <td id="fec_nac{{$medico->id}}">{{ $medico->fecha_nacimiento }}</td>
                        <td id="edad{{$medico->id}}">{{ $medico->edad }}</td>
                        <td id="sexo{{$medico->id}}">{{ $medico->sexo }}</td>
                        <td id="dir{{$medico->id}}">{{ $medico->direccion}}</td>
                        <td id="celular{{$medico->id}}">{{ $medico->num_celular }}</td>
                        <td id="matricula{{$medico->id}}">{{ $medico->matricula_profesional }}</td>
                        <td id="espe{{$medico->id}}">{{ $medico->especialidad }}</td>
                       @if($medico->estado == 'TRUE')
                            <td id="estado{{$medico->id}}">{{ 'Habilitado' }}</td>
                       @else
                            <td id="estado{{$medico->id}}">{{ 'De baja' }}</td>
                       @endif
                        <td style='background-color: ;'>
                            @if($medico->estado == "TRUE")
                                <button type="button" class="btn btn-outline-success btn-sm edit ml-1" value="{{$medico->id}}"  data-toggle="modal" data-target="#ActualizarMedico">Editar</button>
                                <button type="button" class="btn btn-sm btn-outline-danger invalidar ml-1" value="{{$medico->id}}" data-toggle="modal" data-target="#abrirModalInhabilitar">Dar baja</button>              
                            @else
                                <button type="button" class="btn btn-outline-secondary btn-sm ml-1" value="{{$medico->id}}" data-toggle="modal" data-target="#ActualizarMedico" disabled>Editar</i></button> 
                                <button type="button" class="btn btn-sm btn-outline-warning invalidar ml-1" value="{{$medico->id}}" data-toggle="modal" data-target="#abrirModalInhabilitar"><span class="font-weight-bold">Habilitar</span></button>                  
                            @endif 
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @include('Medicos.ModalEditar')
    </div>
</div>
@include('Medicos.ModalInhabilitar')


@stop

@section('scripts')
<script src="{{asset('assets/librerias/jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/medico.js') }}"></script>
<script>
$(document).ready(function() {
       
});
</script>
<script type="text/javascript" src="{{ asset('assets/librerias/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function () {
       var table =  $('#listaMedicos').DataTable({
            "lengthMenu": [[ 15 , 30, 60, -1], [ 15 , 30, 60, "All"]],
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

