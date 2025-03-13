@extends("Home.index") <!--extends se situa en views-->
@section('titulo')
 - Reportes Antiguos
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/librerias/Select2/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/librerias/datatables/dataTables.bootstrap4.min.css') }}">

@stop

@section('contenido')  

<div class="m-2">
    <form action="" method="POST"  class="border border-5 border-info" id="form-list" autocomplete="off" >
        @csrf
        <h5 class="box-title text-center font-weight-bold ">Formulario de reportes</h5>
        <div class="row m-1">
            <div class="form-group col-md-2 col-sm-2 font-weight-bold">
                <label for="formGroup_fecha " >Gestion </label>
                <input type="date" class="form-control" name="gestion" id="gestion">
                <small id="gestion" class="form-text text-danger font-weight-bold"></small>
            </div>
            <div class="form-group col-md-2 col-sm-2 font-weight-bold">
                <label for="formGroup_fecha " >Fecha desde </label>
                <input type="date" class="form-control" name="fecha" id="fecha">
                <small id="fecha_ini" class="form-text text-danger"></small>
            </div>
            <div class="form-group col-md-2 col-sm-2 font-weight-bold">
                <label for="formGroup_fecha " >Fecha hasta </label>
                <input type="date" class="form-control" name="fecha" id="fecha">
                <small id="fecha_fin" class="form-text text-danger font-weight-bold"></small>
            </div>
            <div class="col-md-2 col-sm-2 font-weight-bold">
                <label for="form_tipo_report" >Tipo Reporte</label>
                <select class="form-control custom-select" style="width: 100%" name="tipo" id="tipo">
                    <option value="valor" disabled  selected>Selecione una opcion</option> 
                    <option value="U">Urbano</option>
                    <option value="R">Rural</option>
                    <option value="C">Citologia</option>
                </select>
                <small id="val_tipo" class="form-text text-danger font-weight-bold"></small>
            </div>
            <div class="col-md-3 col-sm-3 font-weight-bold">
                <label for="formGroupExampleInput" >Accion</label>
                <div class="row">
                    <button type="submit" id="imprimir" class="btn btn-outline-success btn-sm" >Excel</button>
                    <button type="button"  id="templist" class="btn btn-outline-info btn-sm ml-2">Vista previa</button>
                    <button type="button"  id="cancelarBtn" class="btn btn-outline-secondary btn-sm ml-2" >Cancelar</button>
                </div>
            </div>
        
        </div>
    </form>
   
</div>

@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/librerias/Select2/js/select2.js') }}"></script>
<script src="{{asset('assets/librerias/jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/librerias/datatables/jquery.dataTables.min.js') }}"></script>

<script>
    $(document).ready(function () {
              
    });
</script>

@stop

