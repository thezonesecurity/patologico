<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstablecimientoRequest;
use App\Http\Requests\UpdateEstablecimientoRequest;
use App\Models\Establecimiento;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class EstablecimientoController extends Controller
{
    public function index()
    {
        $establecimientos = Establecimiento::orderBy('id')->get();
        $municipios = Municipio::orderBy('id')->where('estado', 'TRUE')->pluck('nombre_municipio', 'id');
        return view('establecimientos.index', compact('establecimientos', 'municipios'));
    }
    public function create()
    {
        //
    }
    public function store(StoreEstablecimientoRequest $request) //Request $request)
    {
         // dd($request);
      // $apellido = ucfirst(strtolower($request->apellido));
       try{
           DB::beginTransaction();
           $id_user = auth()->user()->id;
           $establecimiento = new Establecimiento(); //llenado a la tabla Productos
           $establecimiento->fill([
               'nombre_establecimiento' => $request->nombre_establecimiento,
               'municipio_id' => $request->municipio_id,
               'descripcion' => $request->descripcion,
               'estado' => 'TRUE',
               'creatoruser_id' =>$id_user,
               'updateduser_id' => $id_user
           ]);
            $establecimiento->save();
           //dd($establecimiento);
           DB::commit();
       }catch(Exception $e){
           dd($e);
           DB::rollBack();
       }
       return redirect()->route('establecimientos.index')->with('success','Establecimiento registrado');
    }

    public function edit(Establecimiento $establecimiento) //$id)
    {
        $municipios = Municipio::orderBy('id')->where('estado', 'TRUE')->pluck('nombre_municipio', 'id');
        return view('establecimientos.edit', compact('establecimiento',  'municipios'));
    }

    public function update(UpdateEstablecimientoRequest $request, Establecimiento $establecimiento) //Request $request, $id)
    {
        //  dd($request);
         try{
            DB::beginTransaction();
            $id_user = auth()->user()->id;
            if($request->nombre == '0'){
                $establecimiento->fill([
                    'nombre_establecimiento' => $request->nombre_establecimiento,
                    'municipio_id' => $request->municipio_id,
                    'descripcion' => $request->descripcion,
                    'updateduser_id' => $id_user
                 ]);
            }else{
                $establecimiento->fill([
                    'nombre_establecimiento' => $request->nombre_establecimiento,
                    'descripcion' => $request->descripcion,
                    'updateduser_id' => $id_user
                 ]);
            }
             $establecimiento->save();
           // dd($establecimiento);
            DB::commit();
        }catch(Exception $e){
            dd($e);
            DB::rollBack();
        }
        return redirect()->route('establecimientos.index')->with('success','Estableciento actualizado');
    }

    public function destroy($id)
    {
         //dd($id);
         $mensaje = '';
         $establecimiento = Establecimiento::find($id);
         $id_user = auth()->user()->id;
         if($establecimiento->estado == 'TRUE'){
             Establecimiento::where('id',$establecimiento->id)
             ->update([
                'estado' => 'FALSE',
                'updateduser_id' => $id_user,
             ]);
             $mensaje = 'Establecimiento eliminado';
         }else{
             Establecimiento::where('id',$establecimiento->id)
             ->update([
                'estado' => 'TRUE',
                'updateduser_id' => $id_user,
             ]);
             $mensaje = 'Establecimiento restaurado';
         }
        
          return redirect()->route('establecimientos.index')->with('success', $mensaje);
    }
}
