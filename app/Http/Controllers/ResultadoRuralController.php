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
        })->where('num_examen', $nro_examen)->where('estado', '=', 'true')->get();
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
                })->where('num_examen', $nro_examen)->where('fecha_resultado', )->get();
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
        //
       
        if(isset($request->codig_diag)){
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
                $newResult->estado = 'TRUE';
                $newResult->creatoruser_id = auth()->user()->id;
                $newResult->updateduser_id = auth()->user()->id;
                $newResult->save();
                $pos++;
            }
            return 'ok';
           }
           else {return 'error registro resultado';}  
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
