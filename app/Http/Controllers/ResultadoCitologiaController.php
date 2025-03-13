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
            $existeResultado=$resultado->where('num_examen', $nro_examen)->where('result_estado', 'FALSE')->where('estado', 'true')->get();
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
                    'celular_pac' => $paciente->num_celular,
                    'direccion_pac' => $paciente->direccion,
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
        // return response()->json('go');
        $listas = [];
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
            $resultado->conclucion =  $conclucion;
            $resultado->nota =$nota; // $request->nota;
            $resultado->estado = 'TRUE';
            $resultado->creatoruser_id = auth()->user()->id; //add
            $resultado->updateduser_id = auth()->user()->id; //add
                $editExamen = $resultado->resultado_examenCito;
                $editExamen->fecha_resultado = $request->fec_result;
                $editExamen->result_estado = 'TRUE';
                $editExamen->updateduser_id =  auth()->user()->id; //add
           // return response()->json($resultado);
    
            $listas []= [
                'id' => $resultado->id_examen,
                'fecha_solicitud' => $editExamen->examen_solCitologia->fecha_solicitud,
                'nro_examen' => $request->num_examen,
                'fecha_resultado' => $resultado->fecha_resultado,
                'municipio' => $editExamen->examen_solCitologia->solicitudCito_municipios->nombre_municipio,
                'establecimiento' => $editExamen->examen_solCitologia->solicitudCito_establecimientos->nombre_establecimiento,
                'nombres' => $editExamen->examen_citoPacientes->nombre,
                'apellidos' => $editExamen->examen_citoPacientes->apellido,
                'ci' => $resultado->ci_pac,
                'fecha_nacimiento' => $editExamen->examen_citoPacientes->fecha_nacimiento,
                'edad' => $editExamen->examen_citoPacientes->edad,
                'medico' => $resultado->resultado_medico->nombre .' '.$resultado->resultado_medico->apellido,
                'servicio' => $resultado->resultado_servicio->nombre_servicio,
                'diagnostico' => $resultado->diagnostico,
                'datos' => $resultado->datos_relevantes,
                'descripcion' => $resultado->descripcion,
                'conclucion' => $resultado->conclucion,
                'nota' => $resultado->nota,
                'reporte' => 'Citologia'
            ];
            $editExamen->save();
            $resultado->save();
            return response()->json($listas);
           // return 'ok';
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
