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
        $municipios = Municipio::where('estado', 'TRUE')->pluck('nombre_municipio', 'id');
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

    public function getPacientes(Request $request)
    {
        $cedula = request()->input('cedula');
      // return response()->json( $cedula );
      
       $paciente  = Paciente::where('ci', $cedula)->first(); 
       // return response()->json($paciente->id);
        if(isset($paciente->id)){
            return response()->json($paciente);
        }else{   return 'No existe'; }
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
        $tipo = $request->tipo_soli;
        $ultimoElimniado='';
        if($tipo == 'U'){
            $ultimoElimniado =  Examen::whereHas('examen_solicitudes',function($query) use($tipo){
                return $query->where('tipo_solicitud', $tipo);
            })->where('estado', '=', 'false')->orderBy('id')->first();
    
            if(isset($ultimoElimniado)){
                $nro_examen = $ultimoElimniado->num_examen;
               // return response()->json($ultimoElimniado->num_examen); 
            }else{ 
                $resultado=Examen::whereHas('examen_solicitudes',function($query) use($tipo){
                    return $query->where('tipo_solicitud', $tipo);
                })->where('estado', '=', 'true')->latest('id')->first();
                if(isset($resultado->num_examen)){ $nro_examen = $resultado->num_examen + 1; }
                else{ $nro_examen = $variable + 1; }
            }
           
        }else{ //rural
            $ultimoElimniado =  Examen::whereHas('examen_solicitudes',function($query) use($tipo){
                return $query->where('tipo_solicitud', $tipo);
            })->where('estado', '=', 'false')->orderBy('id')->first();

            if(isset($ultimoElimniado)){
                $nro_examen = $ultimoElimniado->num_examen;
               // return response()->json($ultimoElimniado->num_examen); 
            }else{ 
                $resultado=Examen::whereHas('examen_solicitudes',function($query) use($tipo){
                    return $query->where('tipo_solicitud', $tipo);
                })->where('estado', '=', 'true')->latest('id')->first();
                if(isset($resultado->num_examen)){ $nro_examen = $resultado->num_examen + 1; }
                else{ $nro_examen = $variable + 1; }
            }
        }
      //  return response()->json($nro_examen); //nro_examen); // resultado);
       /*$resultExamen=Examen::query();
        if($tipo == 'U'){
            $resultado=$resultExamen->whereHas('examen_solicitudes',function($query) use($tipo){
                return $query->where('tipo_solicitud', $tipo);
            })->where('estado', TRUE)->where('fecha_resultado', '!=' , null)->latest('id')->first();
            if(isset($resultado->num_examen)){ $nro_examen = $resultado->num_examen + 1; }
            else{ $nro_examen = $variable + 1; }
        }else{
            $resultado=$resultExamen->whereHas('examen_solicitudes',function($query) use($tipo){
                return $query->where('tipo_solicitud', $tipo);
            })->latest('id')->first();
            if(isset($resultado->num_examen)){ $nro_examen = $resultado->num_examen + 1; }
            else{  $nro_examen = $variable + 1;  }
        }*/

        $lastSolicitud = Solicitud::latest()->first(); //obtine ultimo nro de solicitud
        if(isset($lastSolicitud)){
            $numero_soli = $lastSolicitud->num_solicitud + 1 ; // verificamos si exite el ultimo nro de solictud si existe +1 pero sino toma el valor d 1
        }else { $numero_soli=1; }

        if($request->id_paciente && $nro_examen != 0){
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
                $newExamenR->resultado_estado = 'FALSE';
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

    public function destroy($id) //no usado
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
