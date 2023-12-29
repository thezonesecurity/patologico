@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Reportes
@stop

@section('styles')

@stop


@section('contenido')  

<div class="m-2">
    <form action="{{route('generar.reportes.index')}}" method="post"  class="border border-5 border-info" id="form_reportOne" autocomplete="off" target='_Blank'>{{----}}
        @csrf
        <h5 class="box-title text-center font-weight-bold ">Formulario de reportes</h5>
        <div class="row m-2">
            <div class="form-group col">
                <label for="formGroup_fecha">Fecha</label>
                <input type="date" class="form-control" name="fecha" id="fecha">
            </div>
            <div class="col">
                <label for="formGroupExampleInput">Usuario</label>
                <input type="text" class="form-control" name="user" id="user">
            </div>
            <div class="col">
                <label for="form_tipo_report">Tipo Reporte</label>
    
                <select id="inputState" class="form-control custom-select" style="width: 100%" name="tipo" id="tipo">
                    <option value="0" disabled selected >Selecione una opcion</option> 
                    <option value="U">Urbano</option>
                    <option value="R">Rural</option>
                    <option value="C">Citologia</option>
                </select>
            </div>
            <div class="col">
                <label for="formGroupExampleInput">Accion</label>
                <div class="row">
                    <button id="miEnlace" type="submit" class="btn btn-outline-success" >Imprimir</button>
                    {{--<a  id="enlaceEnviar" type="submit" class="btn btn-outline-success " href="{{route('generar.reportes.index')}}" target='_Blank' >Imprimir</a>
                   {{-- <button type="submit" class="btn btn-outline-success" target='_Blank'>Imprimir</button>--}}
                    <button type="button" class="btn btn-outline-info ml-2">Vista previa</button>
                </div>
               
            </div>
        
        </div>
    </form>
</div>

@stop

@section('scripts')
<script>
$(document).ready(function() {
       
    });
</script>
@stop

