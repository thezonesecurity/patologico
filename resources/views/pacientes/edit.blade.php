@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Editar paciente
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
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Paciente</h1>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
      <form action="{{route('pacientes.update', ['paciente' => $paciente])}}" method="POST" autocomplete="off" enctype="multipart/form-data">

        @method('PATCH')
        @csrf
        <div class="row g-3">
          <div class="form-group col-md-4 col-sm-4">
              <label class="font-weight-bold">Nombres</label>
              <input type="text" class="form-control" name="nombre" id="nombre" value="{{old('nombre', $paciente->nombre)}}" >
              @error('nombre')
                  <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
            <label class="font-weight-bold">Apellidos</label>
            <input type="text" class="form-control" name="apellido" id="apellido" value="{{old('apellido', $paciente->apellido)}}" >
            @error('apellido')
                <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
            @enderror
          </div>
          <div class="cform-group col-md-4 col-sm-4">
            <label class="font-weight-bold">Cedula de identidad</label>
            <input type="text" class="form-control" name="ci" id="ci" value="{{old('ci', $paciente->ci)}}">
            @error('ci')
                <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
            @enderror
          </div>    
          <div class="form-group col-md-4 col-sm-4">
              <label class="font-weight-bold">Fecha nacimiento</label>
              <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{old('fecha_nacimiento', $paciente->fecha_nacimiento)}}" >
              @error('fecha_nacimiento')
                  <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label class="font-weight-bold">Edad</label>
              <input type="number" class="form-control" name="edad" id="edad" value="{{old('edad', $paciente->edad)}}">
              @error('edad')
                  <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label class="font-weight-bold">Direccion</label>
              <input type="text" class="form-control" name="direccion" id="direccion" placeholder="opcional" value="{{old('direccion',$paciente->direccion) }}">
              @error('direccion')
                  <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
            <label class="font-weight-bold">Nro. celular</label>
            <input type="text" class="form-control" name="num_celular" id="num_celular" placeholder="opcional" value="{{old('num_celular', $paciente->num_celular) }}">
            @error('num_celular')
                <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
            @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
            <label class="font-weight-bold">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="opcional" value="{{old('email', $paciente->email ) }}">
            @error('email')
                <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
            @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
            <label class="font-weight-bold">HC</label>
            <input type="text" class="form-control" name="hc" id="hc" placeholder="opcional"  value="{{old('hc', $paciente->hc) }}">
            @error('hc')
                <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
            @enderror
          </div>
          <div class="form-group col-md-3 col-sm-3">
            <label class="font-weight-bold">Nro. asegurado</label>
            <input type="text" class="form-control" name="num_asegurado" id="num_asegurado" placeholder="opcional" value="{{old('num_asegurado', $paciente->num_asegurado )}}">
            @error('num_asegurado')
                <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
            @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4" >
            <label  class="font-weight-bold " style="margin-top: 5px;">Sexo</label><br>
            @if ($paciente->sexo == 'Femenino')
              <input type="radio" name="sexo" id="femenino" value="Femenino" checked class="ml-4">
              <label class="form-check-label" for="exampleRadios1F">Femenino</label>
              <input type="radio" name="sexo" id="Masculino" value="Masculino" class="ml-2">
              <label class="form-check-label" for="exampleRadios1M">Masculino</label>
            @else
              <input type="radio" name="sexo" id="femenino" value="Femenino" class="ml-4">
              <label class="form-check-label" for="exampleRadios1F">Femenino</label>
              <input  type="radio" name="sexo" id="Masculino" value="Masculino" checked  class="ml-2">
              <label class="form-check-label" for="exampleRadios1M">Masculino</label>
            @endif
          </div>
          <div class="form-group col-md-5 col-sm-5">
            <label class="font-weight-bold">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="opcional" value="{{old('descripcion', $paciente->descripcion ) }}">
            @error('descripcion')
                <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
            @enderror
          </div>

          <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-primary m-2 " ><a href="{{ route('pacientes.index')}}" style="text-decoration: none" class="text-white">Ir Atras</a></button>
          </div>
        </div>
        
       </form>
    </div>
</div>

@stop

@section('scripts')

<script src="{{ asset("assets/librerias/datatables/dataTables.bootstrap4.min.js")}}" type="text/javascript"></script> 

@stop

