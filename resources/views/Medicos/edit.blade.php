@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Editar medico
@stop

@section('styles')

<style>
    .error {
    color: red;
  }
</style>
@stop


@section('contenido')  
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Medico</h1>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
      <form action="{{route('medicos.update', ['medico' => $medico])}}" method="POST" autocomplete="off" enctype="multipart/form-data">

        @method('PATCH')
        @csrf
        <div class="row g-3">
          <div class="form-group col-md-4 col-sm-4">
              <label class="font-weight-bold">Nombres</label>
              <input type="text" class="form-control" name="nombre" id="nombre" value="{{old('nombre', $medico->nombre)}}" >
              @error('nombre')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
            <label class="font-weight-bold">Apellidos</label>
            <input type="text" class="form-control" name="apellido" id="apellido" value="{{old('apellido', $medico->apellido)}}" >
            @error('apellido')
                <small class="text-danger">{{'* '.$message}}</small>
            @enderror
          </div>
          <div class="cform-group col-md-4 col-sm-4">
            <label class="font-weight-bold">Cedula de identidad</label>
            <input type="text" class="form-control" name="ci" id="ci" value="{{old('ci', $medico->ci)}}">
            @error('ci')
                <small class="text-danger">{{'* '.$message}}</small>
            @enderror
          </div>    
          <div class="form-group col-md-4 col-sm-4">
              <label class="font-weight-bold">Fecha nacimiento</label>
              <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{old('fecha_nacimiento', $medico->fecha_nacimiento)}}" >
              @error('fecha_nacimiento')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label class="font-weight-bold">Edad</label>
              <input type="number" class="form-control" name="edad" id="edad" value="{{old('edad', $medico->edad)}}">
              @error('edad')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
              <label class="font-weight-bold">Direccion</label>
              <input type="text" class="form-control" name="direccion" id="direccion" placeholder="opcional" value="{{old('direccion',$medico->direccion) }}">
              @error('direccion')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
         <div class="form-group col-md-4 col-sm-4">
            <label class="font-weight-bold">Nro. celular</label>
            <input type="text" class="form-control" name="num_celular" id="num_celular" placeholder="opcional" value="{{old('num_celular', $medico->num_celular) }}">
            @error('num_celular')
                <small class="text-danger">{{'* '.$message}}</small>
            @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
            <label class="font-weight-bold">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="opcional" value="{{old('email', $medico->email ) }}">
            @error('email')
                <small class="text-danger">{{'* '.$message}}</small>
            @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4">
            <label class="font-weight-bold">Especialidad</label>
            <input type="text" class="form-control" name="especialidad" id="especialidad" placeholder="opcional"  value="{{old('especialidad', $medico->especialidad) }}">
            @error('especialidad')
                <small class="text-danger">{{'* '.$message}}</small>
            @enderror
          </div>
            <div class="form-group col-md-3 col-sm-3">
            <label class="font-weight-bold">Matricula</label>
            <input type="text" class="form-control" name="matricula_profesional" id="matricula_profesional" placeholder="opcional" value="{{old('matricula_profesional', $medico->matricula_profesional )}}">
            @error('matricula_profesional')
                <small class="text-danger">{{'* '.$message}}</small>
            @enderror
          </div>
          <div class="form-group col-md-4 col-sm-4" >
            <label  class="font-weight-bold " style="margin-top: 5px;">Sexo</label><br>
            @if ($medico->sexo == 'Femenino')
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
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="opcional" value="{{old('descripcion', $medico->descripcion ) }}">
            @error('descripcion')
                <small class="text-danger">{{'* '.$message}}</small>
            @enderror
          </div>

          <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-primary m-2 " ><a href="{{ route('medicos.index')}}" style="text-decoration: none" class="text-white">Ir Atras</a></button>
          </div>
        </div>
        
       </form>
    </div>
</div>

@stop

@section('scripts')


@stop

