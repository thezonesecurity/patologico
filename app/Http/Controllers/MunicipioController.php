<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMunicipioRequest;
use App\Http\Requests\UpdateMunicipioRequest;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;


class MunicipioController extends Controller
{

    public function index()
    {
        $municipios = Municipio::orderBy('id')->get();
        return view('municipios.index', compact('municipios'));
    }

    public function store(StoreMunicipioRequest $request) //Request $request)
    {
        // dd($request);
       try{
           DB::beginTransaction();
           $id_user = auth()->user()->id;
           $municipio = new Municipio(); //llenado a la tabla Productos
           $municipio->fill([
               'nombre_municipio' => ucfirst(strtoupper(str($request->nombre_municipio)->squish())),  //$request->nombre_municipio,
               'descripcion' => ucfirst(strtolower(str($request->descripcion)->squish())),  // $request->descripcion,
               'estado' => 'TRUE',
               'creatoruser_id' =>$id_user,
               'updateduser_id' => $id_user
           ]);
            $municipio->save();
           //dd($municipio);
           DB::commit();
       }catch(Exception $e){
           dd($e);
           DB::rollBack();
       }
       return redirect()->route('municipios.index')->with('success','Municipio registrado');
    }

    public function edit(Municipio $municipio) //$id
    {
        return view('municipios.edit', compact('municipio'));
    }

    public function update(UpdateMunicipioRequest $request, Municipio $municipio)//Request $request, $id)
    {
        //dd(ucfirst(strtoupper(str($request->nombre_municipio)->squish())));
        try{
            DB::beginTransaction();
            $id_user = auth()->user()->id;
            $municipio->fill([
                'nombre_municipio' => ucfirst(strtoupper(str($request->nombre_municipio)->squish())),  //$request->nombre_municipio,
                'descripcion' => ucfirst(strtolower(str($request->descripcion)->squish())), // $request->descripcion,
                'updateduser_id' => $id_user
            ]);
             $municipio->save();
             
           // dd($persona);
            DB::commit();
        }catch(Exception $e){
            dd($e);
            DB::rollBack();
        }
        return redirect()->route('municipios.index')->with('success','Municipio actualizado');
    }

    public function destroy($id)
    {
         //dd($id);
         $mensaje = '';
         $municipio = Municipio::find($id);
         $id_user = auth()->user()->id;
         if($municipio->estado == 'TRUE'){
             Municipio::where('id',$municipio->id)
             ->update([
                'estado' => 'FALSE',
                'updateduser_id' => $id_user,
             ]);
             $mensaje = 'Municipio eliminado';
         }else{
             Municipio::where('id',$municipio->id)
             ->update([
                'estado' => 'TRUE',
                'updateduser_id' => $id_user,
             ]);
             $mensaje = 'Municipio restaurado';
         }
        
          return redirect()->route('municipios.index')->with('success', $mensaje);
    }
}
