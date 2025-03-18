<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Examen;
use App\Models\Paciente;
use App\Models\Diagnostico;
use App\Models\Resultado;
use App\Models\Solicitud;

class ResultadoRuralController extends Controller
{
    
    public function index()
    {
        return view('SolicitudRural.ResultadoR'); 
    }

    public function getExamenesR(Request $request)
    {
        $nro_examen = request()->input('nro_examen'); 
        $prefijo = substr($request->prefijo, 1); 
        $listadatos = [];
       
        $resultado=Examen::query();
        $exiteExamen=$resultado->whereHas('examen_solicitudes',function($query) use($prefijo){
            return $query->where('tipo_solicitud', $prefijo);
        })->where('num_examen', $nro_examen)->first();  

       // return response()->json($exiteExamen); 

        if(isset($exiteExamen)){
          //  return response()->json($exiteExamen->estado); 
            if($exiteExamen->estado == 'true' && $exiteExamen->resultado_estado == 'TRUE' ){
                return 'ya_registrado'; 
            }else{
                $listadatos[] = [
                    'ci_pac' => $exiteExamen->ci,
                    'nombre_pac' =>$exiteExamen->examenPacientes->nombre,
                    'apellido_pac' => $exiteExamen->examenPacientes->apellido,
                    'fec_nac_pac' => $exiteExamen->examenPacientes->fecha_nacimiento,
                    'edad_pac' => $exiteExamen->examenPacientes->edad,
                    'examen_id' => $exiteExamen->id,
                ];
                return response()->json($listadatos);  
                //return response()->json($exiteExamen); 
            }

           /* $existeResultado=$resultado->whereHas('examenesResultados',function($query) use($nro_examen){   LO MISMO DE ARRIBA PERO YA NO SE USA
                return $query->where('num_examen', $nro_examen);
            });
            $existeResultado=$existeResultado->whereHas('examen_solicitudes',function($query) use($prefijo){
                return $query->where('tipo_solicitud', $prefijo);
            })->get();

            if(count($existeResultado) > 0){
                return 'ya_registrado'; 
            }else{
                $data = Examen::whereHas('examen_solicitudes',function($query) use($prefijo){
                    return $query->where('tipo_solicitud', $prefijo);
                })->where('num_examen', $nro_examen)->where('fecha_resultado', null)->where('estado', 'true')->get();
                $paciente = $data[0]->examenPacientes;
                $listadatos[] = [
                    'ci_pac' => $paciente->ci,
                    'nombre_pac' =>$paciente->nombre,
                    'apellido_pac' => $paciente->apellido,
                    'fec_nac_pac' => $paciente->fecha_nacimiento,
                    'edad_pac' => $paciente->edad,
                    'examen_id' => $data[0]->id,
                ];
                return response()->json($listadatos);  
            }*/
        }
        else{
            return 'no_encontrado';
        }
    }
    public function getDiagnosticosR(Request $request)
    {
        //return response()->json($request->nro_examen);
        $codigo_diag = strtoupper(request()->input('nro_diagnostico'));
        $diagnostico= Diagnostico::where('codigo_diagnostico', $codigo_diag)->first(); 
        //return response()->json($diagnostico->id); //$codigo_diag);
        if(isset($diagnostico->id)){
            return response()->json($diagnostico);
        }else{ return 'No existe'; }
        /*if(isset($diagnostico) && count($diagnostico) > 0){
            return response()->json($diagnostico);}
        else{
             return response()->json('No existe');}*/
    }
    public function create()//temp
    {
       //
    }

    public function store(Request $request)
    {
        if(isset($request->codig_diag) && isset($request->id_examen)){
            $editExamen = Examen::where('id', $request->id_examen)->update([ 
                'estado' => 'true',
                'fecha_resultado' => $request->fec_result,
                'resultado_estado' => 'TRUE',
                'resultado_user' => auth()->user()->id, // add
                'updateduser_id' => auth()->user()->id, // add
            ]);
            $pos=0;
            foreach ($request->codig_diag as $codigo_diagnostico) {
                $newResult = new Resultado;
                $newResult->examen_id = $request->id_examen; 
                $newResult->diagnostico_id = $request->codig_diag[$pos];
                $newResult->fecha_resultado = $request->fec_result;
                $newResult->estado = 'true';
                $newResult->creatoruser_id = auth()->user()->id;
                $newResult->updateduser_id = auth()->user()->id;
                $newResult->save();
                $pos++;
            }
            return 'ok';
        }  else {return 'error registro resultado';} 
        //
       
      /*  if(isset($request->codig_diag)){ LO MISMO DE ARRIBA PERO YA NO SE USA
            $pos=0;
            foreach ($request->codig_diag as $codigo_diagnostico) {
                $newResult = new Resultado;
                $newResult->examen_id = $request->id_examen; 
                $newResult->diagnostico_id = $request->codig_diag[$pos];
                $newResult->fecha_resultado = $request->fec_result;
                    $editExamen = $newResult->resultadoExamenes;
                    $editExamen->fecha_resultado = $request->fec_result;
                    $editExamen->resultado_estado = 'TRUE';
                    $editExamen->resultado_user = auth()->user()->id; // add
                    $editExamen->updateduser_id = auth()->user()->id; // add
                    $editExamen->save();
                $newResult->estado = 'true';
                $newResult->creatoruser_id = auth()->user()->id;
                $newResult->updateduser_id = auth()->user()->id;
                $newResult->save();
                $pos++;
            }
            return 'ok';
           }
           else {return 'error registro resultado';}  */
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id) //no usadoo
    {
        // de la funcion getExamensR
        /* $nro_examen = request()->input('nro_examen'); 
        $prefijo = substr($request->prefijo, 1); 
        $listadatos = [];
       
        $resultado=Examen::query();
        $exiteExamen=$resultado->whereHas('examen_solicitudes',function($query) use($prefijo){
            return $query->where('tipo_solicitud', $prefijo);
        })->where('num_examen', $nro_examen)->where('estado', '=', 'true')->get();

        return response()->json($exiteExamen); 

        if(count($exiteExamen) > 0){
            $existeResultado=$resultado->whereHas('examenesResultados',function($query) use($nro_examen){
                return $query->where('num_examen', $nro_examen);
            });
            $existeResultado=$existeResultado->whereHas('examen_solicitudes',function($query) use($prefijo){
                return $query->where('tipo_solicitud', $prefijo);
            })->get();

            if(count($existeResultado) > 0){
                return 'ya_registrado'; 
            }else{
                $data = Examen::whereHas('examen_solicitudes',function($query) use($prefijo){
                    return $query->where('tipo_solicitud', $prefijo);
                })->where('num_examen', $nro_examen)->where('fecha_resultado', null)->where('estado', 'true')->get();
                $paciente = $data[0]->examenPacientes;
                $listadatos[] = [
                    'ci_pac' => $paciente->ci,
                    'nombre_pac' =>$paciente->nombre,
                    'apellido_pac' => $paciente->apellido,
                    'fec_nac_pac' => $paciente->fecha_nacimiento,
                    'edad_pac' => $paciente->edad,
                    'examen_id' => $data[0]->id,
                ];
                return response()->json($listadatos);  
            }
        }
        else{
            return 'no_encontrado';
        }*/

    }

    public function destroy($id)
    {
        //
    }
}
