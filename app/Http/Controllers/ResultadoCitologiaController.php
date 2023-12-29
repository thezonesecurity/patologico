<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicos;
use App\Models\Servicios;
use App\Models\ExamenCitologia;
use App\Models\ResultadoCitologia;

class ResultadoCitologiaController extends Controller
{

    public function index()
    {
        $servicios = Servicios::where( 'estado', 'TRUE')->pluck('nombre_servicio', 'id');
        $medicos = Medicos::where( 'estado', 'TRUE')->get();
         return view('Patologia.resultado')->with(compact('servicios','medicos')); 
    }

    public function getExamenesC(Request $request)
    {
        $nro_examen = $request->nro_examen;
        $listadatos = [];
        $resultado=ExamenCitologia::query();
        $resultado=$resultado->where('num_examen', $nro_examen)->first();
        if($resultado){
            $existeResultado=$resultado->where('num_examen', $nro_examen)->where('result_estado', 'FALSE')->get();
            if(count($existeResultado) == 0){
                return 'registrado'; 
            }else{
                $paciente = $existeResultado[0]->examen_citoPacientes;
                $listadatos[] = [
                    'ci_pac' => $paciente->ci,
                    'nombre_pac' =>$paciente->nombre,
                    'apellido_pac' => $paciente->apellido,
                    'fec_nac_pac' => $paciente->fecha_nacimiento,
                    'edad_pac' => $paciente->edad,
                    'examen_id' => $existeResultado[0]->id,
                ];
                return response()->json($listadatos);
            }
        }
        else{
            return 'no_encontrado';
        }
    }

    public function create()
    {
      //
    }

    public function store(Request $request)
    {
       
        if($request){
            $datos = ucfirst(strtolower($request->datos)); 
            $descripcion = ucfirst(strtolower($request->descripcion)); 
            $diag = ucfirst(strtolower($request->diag_clinico)); 
            $conclucion = ucfirst(strtolower($request->conclucion)); 
            $nota = ucfirst(strtolower($request->nota)); 
            $resultado = new ResultadoCitologia;
            $resultado->id_examen = $request->num_examen;
            $resultado->id_servicio = $request->servicio;
            $resultado->id_medico = $request->medico;
            $resultado->fecha_resultado = $request->fec_result;
            $resultado->diagnostico = $diag; //$request->diag_clinico;
            $resultado->datos_relevantes = $datos; //$request->datos;
            $resultado->ci_pac = $request->cedula_pac;
            $resultado->descripcion = $descripcion; // $request->descripcion;
            $resultado->conclucion =  $request->conclucion;
            $resultado->nota =$nota; // $request->nota;
            $resultado->estado = 'TRUE';
                $editExamen = $resultado->resultado_examenCito;
                $editExamen->fecha_resultado = $request->fec_result;
                $editExamen->result_estado = 'TRUE';
                //return response()->json($resultado);
                $editExamen->save();
            $resultado->save();
            return 'ok';
        }else{
            return 'error_registro_resul_citologico';
        }
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
