@extends("Home/index") <!--extends se situa en views-->
@section('titulo')
 - Medicos
@stop

@section('styles')

@stop


@section('contenido')

<div class="title-wrapper pt-30">
    <div class="row align-items-center" style="height: 60px">
      <div class="col-md-6">
        <div class="titlemb-30">
          <h2>Medicos</h2>
        </div>
      </div>
      <div class="col-md-6" style="text-align: right;">
        <div class="titlemb-30">
			{{-- <button type="button" class="btn btn-primary btn-lg">Nuevo</button> --}}
          	<a href="{{ route('patologia.medicos.create') }}" class="btn btn-primary btn-lg">Nuevo</a>        
		  	{{-- <button type="button" class="btn btn-success btn-lg" target="_blank">Imprimir Lista</button> --}}
			<a href="{{ route('patologia.medicos.pdf') }}" class="btn btn-success btn-lg" target="_blank">Imprimir Lista</a> 
		</div>
        </div>
      </div>
    </div>    
  </div>
@if (session('mensaje'))
	<div class="alert alert-success">
		<strong>{{session('mensaje')}}</strong>
	</div>
@endif      
<div class="tables-wrapper">
    <div class="row">
      	<div class="col-lg-12">
        	<div class="card-style mb-30">
				<div class="table-wrapper table-responsive">
		            <table class="table table-striped" id="myTable">
		              <thead>
		                <tr>		                  
		                  <th><h6>CI</h6></th>						  
		                  <th><h6>NOMBRES</h6></th>
						  <th><h6>APELLIDOS</h6></th>
						  <th><h6>ESPECIALIDAD</h6></th>
						  <!--<th><h6>SEXO</h6></th>
						  <th><h6>DIRECCION</h6></th>-->
		                  <th><h6>EDITAR</h6></th>
						  <th><h6>ESTADO</h6></th>
		                </tr>		                
		              </thead>
		              <tbody>
		              	@foreach($medicos as $medico)
		                <tr>		                  
		                  <td class="min-width">
		                    <p>{{$medico->ci}}</p>
		                  </td>		            						  
		                  <td class="min-width">
		                    <p>{{$medico->nombre}}</p>
		                  </td>		            
						  <td class="min-width">
		                    <p>{{$medico->apellido}}</p>
		                  </td>		            
						  <td class="min-width">
		                    <p>{{$medico->especialidad}}</p>
		                  </td>		                  
						  <!--<td><p>{{ floor(abs(strtotime($hoy)-strtotime($medico->fecha_nacimiento))/(365*60*60*24)) }}</p></td> 
						  <td class="min-width">
		                    <p>{{$medico->sexo}}</p>
		                  </td>
						  <td class="min-width">
		                    <p>{{$medico->direccion}}</p>
		                  </td>-->		            		            
						  <td width="15px">							
                            <a href="{{ route('patologia.medicos.edit', $medico->id) }}" class="btn btn-warning btn-sm">Editar</a>
                          </td>
						  <td width="15px">
								@if($medico->estado)
									<form action="{{ route('patologia.medicos.destroy', $medico->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas DESACTIVAR este registro?');">
										@method('delete')
										@csrf
										<input type="submit" value="Desactivar" class="btn btn-danger btn-sm">
									</form>
								@else
									<form action="{{ route('patologia.medicos.habilitar', $medico->id) }}" method="GET" onsubmit="return confirm('¿Estás seguro de que deseas ACTIVAR este registro?');">
										@method('GET')
										@csrf
										<input type="submit" value="Activar" class="btn btn-success btn-sm">
									</form>
								@endif
							</td>		  
		                </tr>
		                @endforeach		                
		              </tbody>
		            </table>
		        </div>            
          	</div>
        </div>        
    </div>      
</div>

@stop


@section('scripts')

@stop