@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Editar establecimiento
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/librerias/Select2/css/select2.css') }}">
<style>
    .error {
    color: red;
  }
</style>
@stop


@section('contenido')  
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Estableciminento</h1>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
      <form action="{{route('establecimientos.update', ['establecimiento' => $establecimiento])}}" method="POST" autocomplete="off" enctype="multipart/form-data">

        @method('PATCH')
        @csrf
        <div class="row g-3">
          <div class="form-group col-md-11 col-sm-11 ml-3">
              <label class="font-weight-bold">Nombre</label>
              <input type="text" class="form-control" name="nombre_establecimiento" id="nombre_establecimiento"  value="{{old('nombre_establecimiento', $establecimiento->nombre_establecimiento)}}" style="text-transform:uppercase" >
              @error('nombre_establecimiento')
                  <small class="text-danger">{{'* '.$message}}</small>
              @enderror
          </div>
          <div class="form-group col-md-11 col-sm-11 ml-3">
            <label class="font-weight-bold">Municipio</label>
            <input type="text" name="nombre" id="nombre"  value="{{$establecimiento->municipio_esta->nombre_municipio}}" class="form-control controlT1">
            <select title="Seleccione una opcion" class="form-control controlT2" name='municipio_id'  id="municipio_id" data-size="4" style="display: none">
                @foreach ($municipios as $id => $nombre)
                    <option value="{{ $id }}" {{old('municipio_id') == $id ? 'selected' : ''}} >{{ $nombre}} </option>s
                @endforeach
            </select>
            @error('municipio_id')
                <small class="text-danger">{{'* '.$message}}</small>
            @enderror
          </div>
          <div class="form-group col-md-11 col-sm-11 ml-3">
            <label class="font-weight-bold">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="opcional" value="{{old('descripcion', $establecimiento->descripcion ) }}">
            @error('descripcion')
                <small class="text-danger">{{'* '.$message}}</small>
            @enderror
          </div>

          <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-primary m-2 cancelar " ><a href="{{ route('establecimientos.index')}}" style="text-decoration: none" class="text-white">Ir Atras</a></button>
          </div>
        </div>
        
       </form>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/librerias/Select2/js/select2.js') }}"></script>
<script>
    $(document).ready(function () {
       
         //PARA CONTROLAR LOS INPUT DE TEXT Y SELECT A LA VEZ DE SERVICO E ITEM
         $('.controlT1').click(function() {
            $('.controlT1').val('0'); 
            $('.controlT1').hide();
            $('.controlT2').show();
            $('.controlT2').attr("required", true);
            $('.controlT2').addClass("select2");
            console.log('clikc');
        });

        //control para que aparescar y se oculte el input y el select de servicio e item
        $('.cancelar').click(function() {
            $('.controlT2').hide();
            $('.controlT2').attr("required", false);
            $('.controlT2').removeClass("select2");
            $('.controlT1').show();
        });

        $('.select2').select2({
            placeholder: "Seleccione una opcion",
            allowClear: true,
            ancho : 'resolver'
        });
    });
</script>
@stop

