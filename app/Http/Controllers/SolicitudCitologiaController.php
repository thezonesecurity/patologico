<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\SolicitudCitologia;
use App\Models\ExamenCitologia;

class SolicitudCitologiaController extends Controller
{
    public function index()
    {
        $municipios = Municipio::where( 'estado', 'TRUE')->pluck('nombre_municipio', 'id');
         return view('Patologia.index')->with(compact('municipios')); 
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

       
        $lastSolicitud = SolicitudCitologia::latest()->first(); //obtine ultimo nro de solicitud
        if(isset($lastSolicitud)){
            $numero_soli = $lastSolicitud->nro_solicitud + 1 ; // verificamos si exite el ultimo nro de solictud si existe +1 pero sino toma el valor d 1
        }else { $numero_soli=1; }
       
        if($request->id_paciente){
            $solicitud = new SolicitudCitologia;
            //$solicitud->nro_solicitud = $numero_soli;  se mantiene nro_solicitud pero no se usara
            $solicitud->fecha_solicitud = $request->fec_solicitud;
            $solicitud->municipio_id = $request->p_municipio; 
            $solicitud->establecimiento_id = $request->p_establecimiento;
            $solicitud->creatoruser_id = $id_user;
            $solicitud->updateduser_id = $id_user;
            $solicitud->estado = 'TRUE';
            //$solicitud->save();
            $pos=0;

            foreach($request->id_paciente as $paciente_id) {

                $ultimoEliminado =  ExamenCitologia::where('estado', '=', 'false')->orderBy('id')->first();
                //return response()->json($ultimoElimniado->num_examen);
                if(isset($ultimoEliminado)){
                    $nro_examen = $ultimoEliminado->num_examen;
                    $ultimoEliminado->fill([
                        'estado' => 'delete',
                    ]);
                    $ultimoEliminado->save();
                   // return response()->json($nro_examen); 
                }else{ 
                    $examen=ExamenCitologia::where('estado', '=', 'true')->latest('id')->first();
                    if(isset($examen)){
                        $nro_examen = $examen->num_examen + 1 ;
                    }else { $nro_examen= 1; }
                    //return response()->json($nro_examen); 
                }
               // return response()->json($nro_examen);
        
                $newexamen = new ExamenCitologia;
                $newexamen->solicitud_id = $solicitud->id; 
                $newexamen->num_examen = $nro_examen;
                $newexamen->paciente_id = $request->id_paciente[$pos];
                $newexamen->ci = $request->ci_pac[$pos];
                $newexamen->estado = 'true';
                $newexamen->creatoruser_id = $id_user;
                $newexamen->updateduser_id = $id_user;
                $newexamen->result_estado = 'FALSE';
                $newexamen->save();
                $exemen_nro = $nro_examen.'-C';
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
         // return response()->json(['message' => 'Se registro correctamente', 'status' => 'ok', 'datos'=> $listadatos]);
        }
        else {
            return 'error_registro_solicitud_citologico';
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
