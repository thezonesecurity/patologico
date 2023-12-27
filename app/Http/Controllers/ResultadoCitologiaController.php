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
        // return response()->json($request);
        $listadatos = [];
        $respExamen= ExamenCitologia::where('num_examen', $request->nro_examen)->where('estado', 'TRUE')->first(); 

        if($respExamen){
            $respResultado = ResultadoCitologia::where('id_examen', $respExamen->id)->where('estado', 'TRUE')->first(); 
            if($respResultado){//existe nro_examen ya registrado en resultado
                return response()->json('registrado'); 
            }else{
                //return response()->json('no registrado');
                $paciente = $respExamen->examen_citoPacientes;
                $listadatos[] = [
                    'ci_pac' => $paciente->ci,
                    'nombre_pac' =>$paciente->nombre,
                    'apellido_pac' => $paciente->apellido,
                    'fec_nac_pac' => $paciente->fecha_nacimiento,
                    'edad_pac' => $paciente->edad,
                    'examen_id' => $respExamen->id
                ];
                return response()->json($listadatos);  
            }
        }else{ //no encontrado nro_examen
            return 'no_encontrado';
        }
    }

    public function create()
    {
       //
    }

    public function store(Request $request)
    {
       // return response()->json($request);
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
