<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicoRequest;
use App\Http\Requests\UpdateMedicoRequest;
use Illuminate\Http\Request;
use App\Models\Medicos;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class MedicoController extends Controller
{

    public function index()
    {
        $medicos = Medicos::orderBy('id')->get();
        return view('medicos.index', compact('medicos'));
    }

    public function create()
    {
        //
    }

    public function store(StoreMedicoRequest $request) //Request $request) //
    { 
       // dd($request);
       $apellido = ucfirst(strtolower($request->apellido));
        try{
            DB::beginTransaction();
            $id_user = auth()->user()->id;
            $persona = new Medicos(); //llenado a la tabla Productos
            $persona->fill([
                'nombre' => ucfirst(strtolower(str($request->nombre)->squish())),  //$request->nombre,
                'apellido' => ucfirst(strtolower(str($request->apellido)->squish())),  //$request->apellido,
                'ci' => $request->ci,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'edad' => $request->edad,
                'direccion' => ucfirst(strtolower(str($request->direccion)->squish())),  //$request->direccion,
                'num_celular' => $request->num_celular,
                'email' => $request->email,
                'especialidad' => ucfirst(strtolower(str($request->especialidad)->squish())),  //$request->especialidad,
                'matricula_profesional' => $request->matricula_profesional,
                'sexo' => $request->sexo,
                'descripcion' => ucfirst(strtolower(str($request->descripcion)->squish())),  //$request->descripcion,
                'estado' => 'TRUE',
                'creatoruser_id' =>$id_user,
                'updateduser_id' => $id_user
            ]);
             $persona->save();
            //dd($persona);
            DB::commit();
        }catch(Exception $e){
            dd($e);
            DB::rollBack();
        }
        return redirect()->route('medicos.index')->with('success','Medico registrado');

    }

    public function show($id)
    {
        //
    }

    public function edit(Medicos $medico) //$id
    {
        return view('medicos.edit', compact('medico'));
    }

    public function update(UpdateMedicoRequest $request, Medicos $medico) //Request $request, $id)
    {
          //  dd($request);
          try{
            DB::beginTransaction();
            $id_user = auth()->user()->id;
            $medico->fill([
                'nombre' => ucwords(strtolower(str($request->nombre)->squish())),  //$request->nombre,
                'apellido' => ucwords(strtolower(str($request->apellido)->squish())),  //$request->apellido,
                'ci' => $request->ci,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'edad' => $request->edad,
                'direccion' => ucfirst(strtolower(str($request->direccion)->squish())),  //$request->direccion,
                'num_celular' => $request->num_celular,
                'email' => $request->email,
                'especialidad' => ucfirst(strtolower(str($request->especialidad)->squish())),  //$request->especialidad,
                'matricula_profesional' => $request->matricula_profesional,
                'sexo' => $request->sexo,
                'descripcion' => ucfirst(strtolower(str($request->descripcion)->squish())),  //$request->descripcion,
                'estado' => 'TRUE',
                'updateduser_id' => $id_user
            ]);
             $medico->save();
             
           // dd($persona);
            DB::commit();
        }catch(Exception $e){
            dd($e);
            DB::rollBack();
        }
        return redirect()->route('medicos.index')->with('success','Medico actualizado');
    }

    public function destroy($id)
    {
         //dd($id);
         $mensaje = '';
         $medico = Medicos::find($id);
         $id_user = auth()->user()->id;
         if($medico->estado == 'TRUE'){
             Medicos::where('id',$medico->id)
             ->update([
                'estado' => 'FALSE',
                'updateduser_id' => $id_user
             ]);
             $mensaje = 'Medico eliminado';
         }else{
             Medicos::where('id',$medico->id)
             ->update([
                'estado' => 'TRUE',
                'updateduser_id' => $id_user
             ]);
             $mensaje = 'Medico restaurado';
         }
        
          return redirect()->route('medicos.index')->with('success', $mensaje);
    }
    public function deshabilitar(Request $request) //NO USADO
    {
        $id_user = auth()->user()->id;
        $id = $request->id;
        $medico = Medicos::findOrFail($id);
        if($request->accion == 'H'){
            $medico->estado = 'TRUE';
            $medico->updateduser_id = $id_user;
            $medico->save();
            return redirect(route('listar.medicos.registrar'))->with('success', 'El medico se habilito correctamente !!'); 
        }else{
            $medico->estado = 'FALSE';
            $medico->updateduser_id = $id_user;
            $medico->save();
            return redirect(route('listar.medicos.registrar'))->with('success', 'El medico se dio de daja correctamente !!'); 
        } 
    }
}

