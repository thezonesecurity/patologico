<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Establecimiento;
use App\Models\Paciente;
use App\Models\Solicitud;
use App\Models\Examen;


class SolicitudRuralController extends Controller
{
    public function index()
    {
        $municipios = Municipio::where( 'estado', 'TRUE')->pluck('nombre_municipio', 'id');
       // $establecimientos = Establecimiento::where( 'estado', 'TRUE')->pluck('nombre_establecimiento', 'id');
       // dd($municipios);
        return view('SolicitudRural.index')->with(compact('municipios')); 
    }

    public function getEstablecimientos() //funcion para saber k areas pertecencen a cada servicio
    {
        $municipio= Municipio::where('id', request()->input('id_municipio'))->get(); 
        $data = $municipio[0]->id;
        $establecimientos= Establecimiento::where('municipio_id', $municipio[0]->id)->where( 'estado', 'TRUE')->pluck('nombre_establecimiento', 'id');
        return response()->json($establecimientos);

    }

    public function getPacientes()
    {
        $paciente= Paciente::where('ci', request()->input('cedula'))->where('estado', 'TRUE')->get(); 
        if(isset($paciente) && count($paciente) > 0){
            return response()->json($paciente);}
        else{
             return response()->json('No existe');}
    }
    public function getsolicitud()//pruebas
    { 
        $n_exmanem = 1;
        $prefijo = 'U';
        $listadatos = [];
        $respExamen= Examen::where('num_examen', $n_exmanem)->where('estado', 'TRUE')->get(); 
        foreach ($respExamen as $examen){
            $respSolicitud = Solicitud::where('id', $examen->solicitud_id)->where('tipo_solicitud', $prefijo)->get();
            if(isset($respSolicitud[0]->id) && isset($respExamen)){
                //echo $respSolicitud;
                $data = $respExamen[0]->examenPacientes;
                //echo $data;
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
            return response()->json('no_existe');
        }
        dd($listadatos);


        /*$tipo_soli = 'R'; //'R'; //'U';
        $nro_examen;
        $variable = 0;
        if($tipo_soli == 'U'){
            $respSoli = Solicitud::where('tipo_solicitud', $tipo_soli)->where('estado','TRUE')->latest()->get();
            if(isset($respSoli[0]->tipo_solicitud)){ // dd($respSoli[0]);
                $respExamen = $respSoli[0]->solicitud_examenes->last(); //dd($respExamen);
                $nro_examen = $respExamen->num_examen + 1; //dd($nro_examen);
            }else{
                $nro_examen = $variable + 1; //dd($nro_examen);
            }
        }else{
            $respSoli = Solicitud::where('tipo_solicitud', $tipo_soli)->where('estado','TRUE')->latest()->get(); //dd($respSoli[0]->tipo_solicitud);
             if(isset($respSoli[0]->tipo_solicitud)){ // dd($respSoli[0]);
                 $respExamen = $respSoli[0]->solicitud_examenes->last(); // dd($respExamen);
                 $nro_examen = $respExamen->num_examen + 1; //dd($nro_examen);
             }else{
                 $nro_examen = $variable + 1; //dd($nro_examen);
             }
        }
        dd($nro_examen);*/
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $nro_examen = 0;
        $variable = 0;
        $listadatos = [];
        $id_user = auth()->user()->id;
        if($request->tipo_soli === 'U'){ //obtine el ultimo nro de examen
            $respSoli = Solicitud::where('tipo_solicitud', $request->tipo_soli)->where('estado','TRUE')->latest()->get();
            if(isset($respSoli[0]->tipo_solicitud)){ // dd($respSoli[0]);
                $respExamen = $respSoli[0]->solicitud_examenes->last(); //dd($respExamen);
                $nro_examen = $respExamen->num_examen + 1; //dd($nro_examen);
            }else{
                $nro_examen = $variable + 1; //dd($nro_examen);
            }
          
        }else{
            $respSoli = Solicitud::where('tipo_solicitud', $request->tipo_soli)->where('estado','TRUE')->latest()->get(); //dd($respSoli[0]->tipo_solicitud);
             if(isset($respSoli[0]->tipo_solicitud)){ // dd($respSoli[0]);
                 $respExamen = $respSoli[0]->solicitud_examenes->last(); // dd($respExamen);
                 $nro_examen = $respExamen->num_examen + 1; //dd($nro_examen);
             }else{
                 $nro_examen = $variable + 1; //dd($nro_examen);
             }
        }

        $lastSolicitud = Solicitud::latest()->first(); //obtine ultimo nro de solicitud
        if(isset($lastSolicitud)){
            $numero_soli = $lastSolicitud->num_solicitud + 1 ; // verificamos si exite el ultimo nro de solictud si existe +1 pero sino toma el valor d 1
        }else { $numero_soli=1; }

        if($request->id_paciente){
            $solicitud = new Solicitud;
            //$solicitud->num_solicitud = $numero_soli;  se mantiene nro_solicitud pero no se usara
            $solicitud->fecha_solicitud = $request->fecha_solicitud;
            $solicitud->municipio_id = $request->municipio; 
            $solicitud->establecimiento_id = $request->establecimiento;
            $solicitud->tipo_solicitud = $request->tipo_soli;
            $solicitud->creatoruser_id = $id_user;
            $solicitud->updateduser_id = $id_user;
            $solicitud->estado = 'TRUE';
            $solicitud->save();
            $pos=0;
            foreach($request->id_paciente as $paciente_id) {
                $newExamenR = new Examen;
                $newExamenR->solicitud_id = $solicitud->id; 
                $newExamenR->paciente_id = $request->id_paciente[$pos];
                $newExamenR->ci = $request->ci_pac[$pos];
                $newExamenR->estado = 'TRUE';
                $newExamenR->creatoruser_id = $id_user;
                $newExamenR->updateduser_id = $id_user;
                $newExamenR->num_examen = $nro_examen;
                 $newExamenR->save();
                if($request->tipo_soli === 'U'){ $exemen_nro = $nro_examen.'-U';}
                else{  $exemen_nro = $nro_examen.'-R'; }
                $listadatos[] = [
                    'ci' => $request->ci_pac[$pos],
                    'nombre' => $request->nombre_pac[$pos],
                    'apellido' => $request->apellido_pac[$pos],
                    'nro_examen' => $exemen_nro
                ];
                $nro_examen++;
                $pos++;
            }
           return response()->json($listadatos);
        }
        else {
            return 'error_registro_solicitud';
        }    

    }

    public function show($id)
    {
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
        //   //PRUEBA
    /*    $tipo_soli = 'R'; //'R'; //'U';
        $nro_examen;
        $variable = 0;
        $respSoli = Solicitud::where('tipo_solicitud', $tipo_soli)->where('estado','TRUE')->latest()->get();
        dd($respSoli);
        $respExamen = $respSoli[0]->solicitud_examenes->last();*/
       


        /*//dd($respExamen);
        dd($respExamen->num_examen + 1);



       $resul = Examen::where('num_examen', 69)->get();
      // dd($resul);
       dd($resul[0]->examen_solicitudes->solicitud_municipios);
       dd($resul[0]->examenPacientes);
        //$resultado = Solicitud::where('tipo_solicitud',$request->tipo_soli)->where('estado','TRUE')->latest()->get(); //->get();
        //$numero_examen = $request->nro_examen ? $request->nro_examen + 1 : $variable + 1;
        $resultado=Examen::query();
        $tipo_soli = 'U';
        $resultado = $resultado->whereHas('examen_solicitudes',function($query) use($tipo_soli){
            return $query->where("tipo_solicitud",$tipo_soli)->latest()->get();
        })->where('estado', 'TRUE')->latest()->get();
        dd($resultado);*/

        /* $variable = 0;
        if($request->tipo_soli == 'Urbano'){ $numero_examen = $numero_examen + '-U'; }
       else{ $numero_examen = $numero_examen + '-R'; }
       $datos[] = [
           'ci' => $request->ci_pac[$pos],
           'nombre' => $request->nombre_pac[$pos],
           'apellido' => $request->apellido_pac[$pos],
           'nro_examen' => $numero_examen,
       ];*/
    }
}
