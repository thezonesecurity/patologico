<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Examen;
use App\Models\ExamenCitologia;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportesController extends Controller
{

    public function index()
    {
         return view('Reportes.index'); //->with(compact('servicios','medicos')); 
    }
    public function print(Request $request)
    {
        $fecha = $request->fecha;
        $tipo = $request->tipo;
        $resultado=[];
       if($request->tipo != 'C'){
            $resultado=Examen::query();
            $resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
                return $query->where('tipo_solicitud', $tipo);
            })->where('fecha_resultado', $fecha)->get();
           $pdf = Pdf::loadView('Reportes.pdf', compact('resultado'));
           return $pdf->stream();
       }else{
            $resultado=ExamenCitologia::query();
            $resultado=$resultado->whereHas('examenesResultadoCito',function($query) use($fecha){
                return $query->where('fecha_resultado', $fecha);
            })->where('fecha_resultado', $fecha)->where('result_estado','TRUE')->get();
            dd($resultado);
            return view('Reportes.pdfCitologia')->with(compact('resultado')); 
           // $pdf = Pdf::loadView('Reportes.pdf', compact('resultado'));
            //return $pdf->stream();
       }
     
    }
    
}






  /*
          $resultado = DB::table('sispatologico.resultados')
          ->join('sispatologico.examenes','sispatologico.examenes.id','=','sispatologico.resultados.examen_id')
          ->join('sispatologico.solicitudes','sispatologico.solicitudes.id','=','sispatologico.examenes.solicitud_id')
          ->whereDate('sispatologico.resultados.fecha_resultado', $fecha)
          ->where('sispatologico.examenes.resultado_estado', 'TRUE')
          ->get();

          dd($resultado);
          /*  $resultado=Examen::query();
            $resultado=$resultado->whereHas('examenesResultados',function($query) use($fecha){
                return $query->whereDate('fecha_resultado', $fecha);
            })->get();
            / *$resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
                return $query->where('tipo_solicitud', $tipo);
            });*/
            //dd($resultado);
        /*$pos=0; 
        $dato = [];
        $print = [];
        $resultados = Resultado::where('fecha_resultado', $request->fecha)->get();
        foreach ($resultados as $resultado){
            $temp = $resultados[$pos]->resultadoExamenes->examen_solicitudes->tipo_solicitud;
            if($temp == $request->tipo){
                $dato = $resultados[$pos]->resultadoExamenes->examen_solicitudes;
                /*$print=[
                    'fec_solicitud' => 's',
                    'nro_examen' => 's',
                    'fec_resultado' => 's',
                    'municipio' => 's',
                    'establecimiento' => 's',
                ];* /
            }
           // dd($resultados[$pos]->resultadoExamenes);
           $pos++;
        }
       dd($dato);*/

 /*

          $resultado=Examen::query();
            $resultado=$resultado->whereHas('examenesResultados',function($query) use($fecha){
                return $query->whereDate('fecha_resultado', $fecha);
            });
            $resultado=$resultado->whereHas('examen_solicitudes',function($query) use($tipo){
                return $query->where('tipo_solicitud', $tipo);
            })->get();
            dd($resultado);*/