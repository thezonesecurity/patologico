<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiagnosticoRequest;
use App\Http\Requests\UpdateDiagnosticoRequest;
use App\Models\Diagnostico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class DiagnosticoController extends Controller
{
    public function index()
    {
        $diagnosticos = Diagnostico::orderBy('id')->get();
        return view('diagnosticos.index', compact('diagnosticos'));
    }

    public function store(StoreDiagnosticoRequest $request) //Request $request)
    {
         //dd($request);
       try{
        DB::beginTransaction();
        $id_user = auth()->user()->id;
        $diagnostico = new Diagnostico(); //llenado a la tabla Productos
        $diagnostico->fill([
            'codigo_diagnostico' => $request->codigo_diagnostico,
            'descripcion_diagnostico' => $request->descripcion_diagnostico,
            'estado' => 'TRUE',
            'creatoruser_id' =>$id_user,
            'updateduser_id' => $id_user
        ]);
         $diagnostico->save();
        //dd($diagnostico);
        DB::commit();
    }catch(Exception $e){
        dd($e);
        DB::rollBack();
    }
    return redirect()->route('diagnosticos.index')->with('success','Diagnostico registrado');
    }

    public function edit(Diagnostico $diagnostico) //$id
    {
        return view('diagnosticos.edit', compact('diagnostico'));
    }

    public function update(UpdateDiagnosticoRequest $request, Diagnostico $diagnostico)//Request $request, $id)
    {
        //  dd($request);
        try{
            DB::beginTransaction();
            $id_user = auth()->user()->id;
            $diagnostico->fill([
                'codigo_diagnostico' => $request->codigo_diagnostico,
                'descripcion_diagnostico' => $request->descripcion_diagnostico,
                'updateduser_id' => $id_user
            ]);
             $diagnostico->save();
             
           // dd($persona);
            DB::commit();
        }catch(Exception $e){
            dd($e);
            DB::rollBack();
        }
        return redirect()->route('diagnosticos.index')->with('success','Diagnostico actualizado');
    }

    public function destroy($id)
    {
          //dd($id);
          $mensaje = '';
          $diagnostico = Diagnostico::find($id);
          $id_user = auth()->user()->id;
          if($diagnostico->estado == 'TRUE'){
              Diagnostico::where('id',$diagnostico->id)
              ->update([
                 'estado' => 'FALSE',
                 'updateduser_id' => $id_user,
              ]);
              $mensaje = 'Diagnostico eliminado';
          }else{
              Diagnostico::where('id',$diagnostico->id)
              ->update([
                 'estado' => 'TRUE',
                 'updateduser_id' => $id_user,
              ]);
              $mensaje = 'Diagnostico restaurado';
          }
         
           return redirect()->route('diagnosticos.index')->with('success', $mensaje);
    }
}
