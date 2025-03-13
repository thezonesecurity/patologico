@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Editar Diagnostico
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
    <h1 class="mt-4 text-center">Editar Diagnostico</h1>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
      <form action="{{route('diagnosticos.update', ['diagnostico' => $diagnostico])}}" method="POST" autocomplete="off" enctype="multipart/form-data">

        @method('PATCH')
        @csrf
        <div class="row g-3">
          <div class="form-group col-md-11 col-sm-11 ml-3">
              <label class="font-weight-bold">Nombre</label>
              <input type="text" class="form-control" name="codigo_diagnostico" id="codigo_diagnostico"  value="{{old('codigo_diagnostico', $diagnostico->codigo_diagnostico)}}">
              @error('codigo_diagnostico')
                  <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-11 col-sm-11 ml-3">
            <label class="font-weight-bold">Descripcion</label>
            <input type="text" class="form-control" name="descripcion_diagnostico" id="descripcion_diagnostico" placeholder="opcional" value="{{old('descripcion_diagnostico', $diagnostico->descripcion_diagnostico ) }}">
            @error('descripcion_diagnostico')
                <small class="text-danger font-weight-bold">{{'* '.$message}}</small>
            @enderror
          </div>

          <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-primary m-2 " ><a href="{{ route('diagnosticos.index')}}" style="text-decoration: none" class="text-white">Ir Atras</a></button>
          </div>
        </div>
        
       </form>
    </div>
</div>

@stop

@section('scripts')


@stop

