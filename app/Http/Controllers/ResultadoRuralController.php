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
        //
        return view('SolicitudRural.ResultadoR'); //->with(compact('municipios')); 
    }

    public function getExamenesR(Request $request)
    {
        $prefijo = substr($request->prefijo, 1);// Quitar el guion y obtiene solo la letra
        $respExamen= Examen::where('num_examen', request()->input('nro_examen') )->where('estado', 'TRUE')->get(); 
        foreach ($respExamen as $examen){
            $respSolicitud = Solicitud::where('id', $examen->solicitud_id)->where('tipo_solicitud', $prefijo)->get(); //request()->input('prefijo')
            if(isset($respSolicitud[0]->id) && isset($respExamen)){
                $data = $respExamen[0]->examenPacientes;
                $listadatos[] = [
                    'ci_pac' => $data->ci,
                    'nombre_pac' =>$data->nombre,
                    'apellido_pac' => $data->apellido,
                    'fec_nac_pac' => $data->fecha_nacimiento,
                    'edad_pac' => $data->edad,
                    'examen_id' => $examen->id,
                ];
            }            
        }
        if(isset($listadatos)){
            return response()->json($listadatos);
        }else{
            return response()->json('No existe');
        }

    }
    public function getDiagnosticosR(Request $request)
    {
        //return response()->json($request->nro_examen);
        $diagnostico= Diagnostico::where('codigo_diagnostico', request()->input('nro_diagnostico'))->where('estado', 'TRUE')->get(); 
        if(isset($diagnostico) && count($diagnostico) > 0){
            return response()->json($diagnostico);}
        else{
             return response()->json('No existe');}
    }
    public function create()
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
