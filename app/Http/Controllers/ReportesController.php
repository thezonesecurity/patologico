<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Examen;
use App\Models\ExamenCitologia;
use App\Models\Login\users;
use App\Models\Resultado;
use App\Models\ResultadoCitologia;
use App\Models\Solicitud;
use App\Models\SolicitudCitologia;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportesController extends Controller
{

    public function index()
    {
        $users= users::orderBy('id')->get();
       // $users = users::with(['persona'])->get();     //dd($users);
        return view('Reportes.index', compact('users')); //->with(compact('servicios','medicos')); 
      
    }
   
    public function print(Request $request)
    {
        $fecha = $request->fecha;
        $tipo = $request->tipo;
        $resultado=[];
       if($request->tipo != 'C'){
            $resultado=Examen::query();
            $resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
                return $query->where('tipo_solicitud', $tipo)->where('estado', TRUE);
            })->where('fecha_resultado', $fecha)->where('resultado_estado','TRUE')->where('estado', 'true')->get();
            $cont = count($resultado) > 0;
            if($cont){
                //dd($cont);
                $pdf = Pdf::loadView('Reportes.pdf', compact('resultado'));
                return $pdf->stream(); //$pdf->download('archivo.pdf');
            }else{
               // dd('vacio');
              // return redirect()->route('productos.index')->with('success','Producto actualizado');
              return redirect()->back()->with('error', 'No se encontraron resultados');
              // $users= users::orderBy('id')->get();
             //  return redirect()->view('Reportes.index', compact('users'))->with('error', 'No se encontraron resultados');
              //  session()->flash('error', 'No se generó el PDF correctamente.');
               // return view('Reportes.index', compact('users'));
                //return redirect(route('listar.personal'));
               // return redirect()->route('vista.reportes.index')->with('nodata','No existe resultado con esos parametros');
            }

       }else{
            $resultado=ExamenCitologia::query();
            $resultado=$resultado->whereHas('examenesResultadoCito',function($query) use($fecha){
                return $query->where('fecha_resultado', $fecha)->where('estado', 'true');
            })->where('fecha_resultado', $fecha)->where('result_estado','TRUE')->where('estado', 'true')->get();
            //return view('Reportes.pdfCitologia')->with(compact('resultado')); 
            $cont = count($resultado) > 0;
            if($cont){
                $pdf = Pdf::loadView('Reportes.pdfCitologia', compact('resultado'));
                return $pdf->stream();
            }
            else{
                return redirect()->back()->with('error', 'No se encontraron resultados');
            }
          
       }
     
    }

    public function templist(Request $request)
    {
        $fecha = $request->fecha; // "2025-02-21";
        $user = $request->user; //  "28";
        $tipo = $request->tipo; // "U"; 
        $reporte = $request->reporte; //solicitud //resultado
        $resultado=[];
        $solicitud=[];
        if($user == 'todos'){ //para todos los usuarios
            if($reporte == 'solicitud'){ //para solicitud
                if($tipo == 'C'){ // para tipo citologico
                    $solicitud=SolicitudCitologia::where('fecha_solicitud', $fecha)->orderBy('id')->get();
                }else{ // para tipo rural y urbano
                    $solicitud = Solicitud::where('fecha_solicitud', $fecha)->where('tipo_solicitud', $tipo)->orderBy('id')->get();                  
                }
               // return response()->json($solicitud);
            }else{//para resultado
                if($tipo == 'C'){ // para tipo citologico
                    $resultado=ExamenCitologia::query();
                      $resultado=$resultado->whereHas('examenesResultadoCito',function($query) use($fecha){
                          return $query->where('fecha_resultado', $fecha);
                      })->where('fecha_resultado', $fecha)->where('result_estado','TRUE')->orderBy('id')->get();
                }else{ // para tipo rural y urbano
                    $resultado=Examen::query();
                    $resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
                        return $query->where('tipo_solicitud', $tipo);
                    })->where('fecha_resultado', $fecha)->where('resultado_estado','TRUE')->orderBy('id')->get();
                }
               // return response()->json($resultado);
            }
        }else{//para un usuario
            if($reporte == 'solicitud'){ //para solicitud
                if($tipo == 'C'){ // para tipo citologico
                    $solicitud=SolicitudCitologia::where('fecha_solicitud', $fecha)->where('creatoruser_id', $user)->orderBy('id')->get();
                }else{ // para tipo rural y urbano
                    $solicitud = Solicitud::where('fecha_solicitud', $fecha)->where('tipo_solicitud', $tipo)->where('creatoruser_id', $user)->orderBy('id')->get();                  
                }
               // return response()->json($solicitud);
            }else{//para resultado
                if($tipo == 'C'){ // para tipo citologico
                    $resultado=ExamenCitologia::query();
                      $resultado=$resultado->whereHas('examenesResultadoCito',function($query) use($fecha){
                          return $query->where('fecha_resultado', $fecha);
                      })->where('fecha_resultado', $fecha)->where('result_estado','TRUE')->where('creatoruser_id', $user)->orderBy('id')->get();
                }else{ // para tipo rural y urbano
                    $resultado=Examen::query();
                    $resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
                        return $query->where('tipo_solicitud', $tipo);
                    })->where('fecha_resultado', $fecha)->where('resultado_estado','TRUE')->where('creatoruser_id', $user)->orderBy('id')->get();
                }
             // return response()->json($resultado);
            }
        }
       // return response()->json($resultado);
        $listas = [];
        $diagnosticos = [];
        $listas_examen = [];
        if($reporte == 'solicitud'){ // para reporte tipo solicitud
          // return response()->json($solicitud); //
            foreach ($solicitud as $row) {
                if($tipo != 'C'){ //para urbano o rural
                    $listas_examen = Examen::where('solicitud_id', $row->id)->where('fecha_resultado', null)->orderBy('id')->get();
                    foreach ($listas_examen as $examen){
                        $listas[] = [
                            'id' => $examen->id,
                            'nro_examen' => $examen->num_examen,
                            'tipo' =>  $row->tipo_solicitud,
                            'estado' => $examen->estado,
                            'fecha_solicitud' => $row->fecha_solicitud,
                            'paciente' => $examen->examenPacientes->nombre.' '.$examen->examenPacientes->apellido,
                            'cedula' => $examen->examenPacientes->ci,
                            'fecha_nacimiento' => $examen->examenPacientes->fecha_nacimiento,
                            'edad' => $examen->examenPacientes->edad,
                            'municipio' => $row->solicitud_municipios->nombre_municipio,
                            'establecimiento' => $row->solicitud_establecimientos->nombre_establecimiento,
                            'reporte' => 'solicitud'
                        ];
                    }
                }
                else{ //para citologia
                    $listas_examen = ExamenCitologia::where('solicitud_id', $row->id)->where('fecha_resultado', null)->orderBy('id')->get();
                    foreach ($listas_examen as $examen){
                        $listas[] = [
                            'id' => $examen->id,
                            'nro_examen' => $examen->num_examen,
                            'tipo' =>  'C',
                            'estado' => $examen->estado,
                            'fecha_solicitud' => $row->fecha_solicitud,
                            'paciente' => $examen->examen_citoPacientes->nombre.' '.$examen->examen_citoPacientes->apellido,
                            'cedula' => $examen->examen_citoPacientes->ci,
                            'fecha_nacimiento' => $examen->examen_citoPacientes->fecha_nacimiento,
                            'edad' => $examen->examen_citoPacientes->edad,
                            'municipio' => $row->solicitudCito_municipios->nombre_municipio,
                            'establecimiento' => $row->solicitudCito_establecimientos->nombre_establecimiento,
                            'reporte' => 'solicitud'
                        ];
                    }
                }
            };
        }
        else{ //para reporte tipo resultado
            foreach ($resultado as $row) {
                if($tipo != 'C'){ //para urbano o rural
                    // Creamos un array de diagnósticos URBANO O RURAL
                    $diagnosticos = Resultado::where('examen_id', $row->id)->orderBy('id')->get();
                    $diagnosticosArray = [];
                    foreach($diagnosticos as $diagnostico) {
                        $diagnosticosArray[] = [
                            'codigo' => $diagnostico->examenDiagnostico->codigo_diagnostico,
                            'descripcion' => $diagnostico->examenDiagnostico->descripcion_diagnostico,
                        ];
                    }
                    $listas[] = [
                        'tipo' => $row->examen_solicitudes->tipo_solicitud,
                        'id' => $row->id,
                        'estado' => $row->estado,
                        'nro_examen' => $row->num_examen,
                        'paciente' => $row->examenPacientes->nombre.' '.$row->examenPacientes->apellido,
                        'cedula' => $row->examenPacientes->ci,
                        'fecha_nacimiento' => $row->examenPacientes->fecha_nacimiento,
                        'edad' => $row->examenPacientes->edad,
                        'direccion' => $row->examenPacientes->direccion,
                        'fecha_solicitud' => $row->examen_solicitudes->fecha_solicitud,
                        'fecha_resultado' => $row->fecha_resultado,
                        'municipio' => $row->examen_solicitudes->solicitud_municipios->nombre_municipio,
                        'establecimiento' => $row->examen_solicitudes->solicitud_establecimientos->nombre_establecimiento,
                        'diagnosticos' => $diagnosticosArray,  // Aquí agregamos el array de diagnósticos
                        'reporte' => 'resultado'
                    ];
                }else{ //para citologia
                   /* $diagnosticos = Resultado::where('examen_id', $row->id)->get();  // Creamos un array de diagnósticos CITOLOGIA
                    $diagnosticosArray = [];
                    foreach($diagnosticos as $diagnostico) {
                        $diagnosticosArray[] = [
                            'codigo' => $diagnostico->examenDiagnostico->codigo_diagnostico,
                            'descripcion' => $diagnostico->examenDiagnostico->descripcion_diagnostico,
                        ];
                    }*/
                    $result_aux = ResultadoCitologia::where('id_examen', $row->id)->orderBy('id')->get(); 
                    $listas[] = [
                        'tipo' => 'C',
                        'id' => $row->id,
                        'estado' => $row->estado,
                        'nro_examen' => $row->num_examen,
                        'paciente' => $row->examen_citoPacientes->nombre.' '.$row->examen_citoPacientes->apellido,
                        'cedula' => $row->examen_citoPacientes->ci,
                        'fecha_nacimiento' => $row->examen_citoPacientes->fecha_nacimiento,
                        'edad' => $row->examen_citoPacientes->edad,
                        'direccion' => $row->examen_citoPacientes->direccion,
                        'fecha_solicitud' => $row->examen_solCitologia->fecha_solicitud,
                        'fecha_resultado' => $row->fecha_resultado,
                        'municipio' => $row->examen_solCitologia->solicitudCito_municipios->nombre_municipio,
                        'establecimiento' => $row->examen_solCitologia->solicitudCito_establecimientos->nombre_establecimiento,
                        'medico' => $result_aux[0]->resultado_medico->nombre.' '.$result_aux[0]->resultado_medico->apellido,
                        'servicio' => $result_aux[0]->resultado_servicio->nombre_servicio,
                        'diagnostico' => $result_aux[0]->diagnostico,
                        'datos_relevantes' => $result_aux[0]->datos_relevantes,
                        'descripcion' => $result_aux[0]->descripcion,
                        'conclucion' => $result_aux[0]->conclucion,
                        'nota' => $result_aux[0]->nota,
                        'reporte' => 'resultado'
                    ];
                }  
            };
           // return response()->json($listas);
        }
        if(count($listas) > 0){
            return response()->json($listas);
        }else{  return 'sin_resultados' ;}
        
    } 

    public function deleteSolicitud(Request $request){
        $id = $request->llave;
        $tipo = $request->tipoMS;
        $fecha = $request->fechaMS;
        $examen= [];
        if($request){
            if($tipo == 'C'){ // para tipo citologico
                $examen=ExamenCitologia::query();
                $examen=$examen->whereHas('examen_solCitologia',function($query) use($fecha){
                    return $query->where('fecha_solicitud', $fecha);
                })->where('id', $id)->where('estado','true')->where('fecha_resultado', null)->update([
                    'estado' => 'false'
                 ]);
                return response($id);//->json($id);
            }else{ // para tipo rural y urbano
                $examen=Examen::query();
                $examen=$examen->whereHas('examen_solicitudes',function($query) use($tipo, $fecha){
                    return $query->where('tipo_solicitud', $tipo)->where('fecha_solicitud', $fecha);
                })->where('id', $id)->where('estado','true')->where('fecha_resultado', null)->update([
                    'estado' => 'false'
                 ]);
                return response($id); //->json($id);
            }
        }else{
            return response()->json('error');
        }
        
    }

    public function deleteResultado(Request $request)
    {
        //return response()->json($request);
        $id = $request->llaveR;
        $tipo = $request->tipoMR;
        $fechaR = $request->fechaRMR;
        $fechaS = $request->fechaSMR;
        $examen= [];
        if($request){
            if($tipo == 'C'){ // para tipo citologico
                $examen=ExamenCitologia::whereHas('examen_solCitologia',function($query) use($fechaS){
                    return $query->where('fecha_solicitud', $fechaS)->where('estado', TRUE);
                })->where('id', $id)->where('estado', 'true')->where('fecha_resultado', $fechaR)->first();
                //return response()->json($examen->id);
                $result = ResultadoCitologia::where('id_examen', $examen->id)->where('estado', 'true')->where('fecha_resultado', $fechaR)->update([ 'estado' => 'false' ]); //->first();
                $examen = $examen->update([ 'estado' => 'false' ]);
                return response($id); //->json($result);
            }else{ // para tipo rural y urbano
                $examen=Examen::whereHas('examen_solicitudes',function($query) use($tipo, $fechaS){
                    return $query->where('tipo_solicitud', $tipo)->where('fecha_solicitud', $fechaS)->where('estado', TRUE);
                })->where('id', $id)->where('estado', 'true')->where('fecha_resultado', $fechaR)->first();
              //  return response()->json($examen);
              foreach ($examen as $item) {
                $result = Resultado::where('examen_id', $examen->id)->where('estado', 'true')->where('fecha_resultado', $fechaR)->update([ 'estado' => 'false' ]);
              }
              $examen = $examen->update([ 'estado' => 'false' ]);
              return response($id); //->json($result);
            }
        }else{
            return response()->json('error');
        } 
    }

    public function printOne(Request $request)
    {
        $examen = $request;
        //dd($examen);
        if($examen){
           // return view('Reportes.pdfCitologiaOne')->with(compact('examen')); 
            $pdf = Pdf::loadView('Reportes.pdfCitologiaOne', compact('examen'));
            return $pdf->stream();
        }
    }
    public function list(Request $request) //PRUEBAS no usado
    {
        $fecha = $request->fecha; // "2024-01-04";
        //$user = $request->user; //  "28";
        $tipo = $request->tipo; // "U"; // "R"; // "C"; 
        $resultado=Examen::query();
        $resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
            return $query->where('tipo_solicitud', $tipo);
        })->where('fecha_resultado', $fecha)->where('resultado_estado','TRUE')->get();

        $listas = [];
        $diagnosticos = [];
        $listaD = [];

        foreach ($resultado as $row) {
          
                $diagnosticos = Resultado::where('examen_id',$row->id)->get();  
                foreach($diagnosticos as $diagnostico){
                    $diagnosticos [] = [
                        'codigo' => $diagnostico->examenDiagnostico->codigo_diagnostico ,
                        'descripcion' =>  $diagnostico->examenDiagnostico->descripcion_diagnostico,
                    ];
                   
                }

                $listas[] = [
                    'tipo' => $row->examen_solicitudes->tipo_solicitud,
                    'id' => $row->id,
                    'estado' => $row->estado,
                    'nro_examen' => $row->num_examen,
                    'paciente' => $row->examenPacientes->nombre.' '.$row->examenPacientes->apellido,
                    'cedula' => $row->examenPacientes->ci,
                    'fecha_nacimiento' => $row->examenPacientes->fecha_nacimiento,
                    'edad' => $row->examenPacientes->edad,
                    'direccion' => $row->examenPacientes->direccion,
                    'fecha_solicitud' => $row->examen_solicitudes->fecha_solicitud,
                    'fecha_resultado' => $row->fecha_resultado,
                    'municipio' => $row->examen_solicitudes->solicitud_municipios->nombre_municipio,
                    'establecimiento' => $row->examen_solicitudes->solicitud_establecimientos->nombre_establecimiento,
                ];
        }

    }

    public function templist2(Request $request) //PRUEBAS no usado
    {
        
        $fecha = $request->fecha; // "2025-02-21";
        $user = $request->user; //  "28";
        $tipo = $request->tipo; // "U"; 
        //
        $resultado=[];
        if($user == 'todos'){
          if($tipo == 'U'){// 
              $resultado=Examen::query();
              $resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
                  return $query->where('tipo_solicitud', $tipo);
              })->where('fecha_resultado', $fecha)->where('resultado_estado','TRUE')->get();
             // dd($resultado);
           //  return response()->json($resultado);
         }else{
            if($tipo == 'R'){
                $resultado=Examen::query();
                $resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
                    return $query->where('tipo_solicitud', $tipo);
                })->where('fecha_resultado', $fecha)->where('resultado_estado','TRUE')->get();
              //  dd($resultado);
           }else{
                $resultado=ExamenCitologia::query();
                $resultado=$resultado->whereHas('examenesResultadoCito',function($query) use($fecha){
                    return $query->where('fecha_resultado', $fecha);
                })->where('fecha_resultado', $fecha)->where('result_estado','TRUE')->get();
               // dd($resultado);
           }
         }
         
        }else{
            if($tipo == 'U'){// 
                $resultado=Examen::query();
                $resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
                    return $query->where('tipo_solicitud', $tipo);
                })->where('fecha_resultado', $fecha)->where('resultado_estado','TRUE')->where('resultado_user', $user)->get();
                // dd($resultado);
            }else{
                if($tipo == 'R'){
                    $resultado=Examen::query();
                    $resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
                        return $query->where('tipo_solicitud', $tipo);
                    })->where('fecha_resultado', $fecha)->where('resultado_estado','TRUE')->where('resultado_user', $user)->get();
                //   dd($resultado);
                }else{
                        $resultado=ExamenCitologia::query();
                        $resultado=$resultado->whereHas('examenesResultadoCito',function($query) use($fecha){
                            return $query->where('fecha_resultado', $fecha);
                        })->where('fecha_resultado', $fecha)->where('result_estado','TRUE')->where('creatoruser_id', $user)->get();
                    //    dd($resultado);
                }
            }
        
        }
        // dd($resultado);
        // return response()->json($resultado);
        $listas = [];
        $diagnosticos = [];
        foreach ($resultado as $row) {

            if($tipo != 'C'){
                // Creamos un array de diagnósticos URBANO O RURAL
                $diagnosticos = Resultado::where('examen_id', $row->id)->get();
                $diagnosticosArray = [];
                foreach($diagnosticos as $diagnostico) {
                    $diagnosticosArray[] = [
                        'codigo' => $diagnostico->examenDiagnostico->codigo_diagnostico,
                        'descripcion' => $diagnostico->examenDiagnostico->descripcion_diagnostico,
                    ];
                }
                $listas[] = [
                    'tipo' => $row->examen_solicitudes->tipo_solicitud,
                    'id' => $row->id,
                    'estado' => $row->estado,
                    'nro_examen' => $row->num_examen,
                    'paciente' => $row->examenPacientes->nombre.' '.$row->examenPacientes->apellido,
                    'cedula' => $row->examenPacientes->ci,
                    'fecha_nacimiento' => $row->examenPacientes->fecha_nacimiento,
                    'edad' => $row->examenPacientes->edad,
                    'direccion' => $row->examenPacientes->direccion,
                    'fecha_solicitud' => $row->examen_solicitudes->fecha_solicitud,
                    'fecha_resultado' => $row->fecha_resultado,
                    'municipio' => $row->examen_solicitudes->solicitud_municipios->nombre_municipio,
                    'establecimiento' => $row->examen_solicitudes->solicitud_establecimientos->nombre_establecimiento,
                    'diagnosticos' => $diagnosticosArray,  // Aquí agregamos el array de diagnósticos
                ];
            }else{
                // Creamos un array de diagnósticos CITOLOGIA
                $diagnosticos = Resultado::where('examen_id', $row->id)->get();
                $diagnosticosArray = [];
                foreach($diagnosticos as $diagnostico) {
                    $diagnosticosArray[] = [
                        'codigo' => $diagnostico->examenDiagnostico->codigo_diagnostico,
                        'descripcion' => $diagnostico->examenDiagnostico->descripcion_diagnostico,
                    ];
                }
                $listas[] = [
                    'tipo' => 'C',
                    'id' => $row->id,
                    'estado' => $row->estado,
                    'nro_examen' => $row->num_examen,
                    'paciente' => $row->examen_citoPacientes->nombre.' '.$row->examen_citoPacientes->apellido,
                    'cedula' => $row->examen_citoPacientes->ci,
                    'fecha_nacimiento' => $row->examen_citoPacientes->fecha_nacimiento,
                    'edad' => $row->examen_citoPacientes->edad,
                    'direccion' => $row->examen_citoPacientes->direccion,
                    'fecha_solicitud' => $row->examen_solCitologia->fecha_solicitud,
                    'fecha_resultado' => $row->fecha_resultado,
                    'municipio' => $row->examen_solCitologia->solicitudCito_municipios->nombre_municipio,
                    'establecimiento' => $row->examen_solCitologia->solicitudCito_establecimientos->nombre_establecimiento,
                    'codigo' => 'falta de diagnostico',
                    'descripcion' =>  'falta de diagnostico',
                ];
            }  
        };
        //dd($listas);
      //  return response()->json($diagnosticos);
        if(count($listas) > 0){
            return response()->json($listas);
        }else{  return 'sin_resultados' ;}
        
    }
}

