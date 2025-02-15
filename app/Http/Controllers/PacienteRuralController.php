<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use Illuminate\Http\Request;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class PacienteRuralController extends Controller
{
   
    public function index()
    {
        $pacientes = Paciente::orderBy('id')->get(); //->where('estado','TRUE')->get();

       // dd($pacientes);
        return view('pacientes.index', compact('pacientes'));
    }

    public function createPaciente(Request $request)
    {
       /* $validatedData = $request->validate([
            'ci_pac' => 'required|regex:/^[a-zA-Z0-9 ]{6,12}+$/',
            'nombre_pac' => 'required|regex:/^[a-zA-ZÑñ ]{3,50}+$/',
            'apellido_pac' => 'required|regex:/^[a-zA-ZÑñ ]{3,50}+$/',
            'fecha_nac' => 'required',
            'sexo_pac' => 'required',
        ]);*/
      //  return response()->json(['Finicio'=>$request->fecha_nac]);
        $fechaNacimiento = Carbon::parse($request->fecha_nac);
        $edad = $fechaNacimiento->age; //se obtiene la edad a partir d la fecha d nacimiento
    
        $nombre = ucfirst(strtolower($request->nombre_pac)); //elimina espacios y pone en mayusculas solo las 1ras letras
        $apellido = ucfirst(strtolower($request->apellido_pac));
        if($request){
            $newPaciente = new Paciente;
            $newPaciente->nombre = $nombre; //$request->nombre_pac;  //$validatedData['cedula'];
            $newPaciente->apellido = $apellido; //$request->apellido_pac;  //$validatedData['nombres'];
            $newPaciente->ci = $request->ci_pac;  //$validatedData['apellidos'];
            $newPaciente->fecha_nacimiento = $request->fecha_nac;  //$validatedData['fec_nacimiento'];
            $newPaciente->edad = $edad;
            $newPaciente->sexo = $request->sexo_pac;  //$validatedData['sexo'];
            $newPaciente->estado = 'TRUE';
            $newPaciente->creatoruser_id = auth()->user()->id;
            $newPaciente->updateduser_id = auth()->user()->id;
            $newPaciente->save();
            return response()->json($newPaciente->id); // return 'registrado';
        }else{ return 'error Paciente';}
    }

    public function store(StorePacienteRequest $request) //Request $reques
    {
       // dd($request);
        try{
            DB::beginTransaction();
            $id_user = auth()->user()->id;
            $persona = new Paciente(); //llenado a la tabla Productos
            $persona->fill([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'ci' => $request->ci,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'edad' => $request->edad,
                'direccion' => $request->direccion,
                'num_celular' => $request->num_celular,
                'email' => $request->email,
                'hc' => $request->hc,
                'num_asegurado' => $request->num_asegurado,
                'sexo' => $request->sexo,
                'descripcion' => $request->descripcion,
                'estado' => 'TRUE',
                'creatoruser_id' =>$id_user,
                'updateduser_id' => $id_user
            ]);
             $persona->save();
           // dd($persona);
            DB::commit();
        }catch(Exception $e){
            dd($e);
            DB::rollBack();
        }
        return redirect()->route('pacientes.index')->with('success','Paciente registrado');
    }


    public function edit(Paciente $paciente) //$id
    {
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente) // Request $request, $id) //
    {
        //  dd($request);
         try{
            DB::beginTransaction();
            $id_user = auth()->user()->id;
            $paciente->fill([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'ci' => $request->ci,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'edad' => $request->edad,
                'direccion' => $request->direccion,
                'num_celular' => $request->num_celular,
                'email' => $request->email,
                'hc' => $request->hc,
                'num_asegurado' => $request->num_asegurado,
                'sexo' => $request->sexo,
                'descripcion' => $request->descripcion,
                'estado' => 'TRUE',
                'creatoruser_id' =>$id_user,
                'updateduser_id' => $id_user
            ]);
             $paciente->save();
             
           // dd($persona);
            DB::commit();
        }catch(Exception $e){
            dd($e);
            DB::rollBack();
        }
        return redirect()->route('pacientes.index')->with('success','Paciente actualizado');
    }

    public function destroy($id)
    {
        //dd($id);
        $mensaje = '';
        $paciente = Paciente::find($id);
        
        if($paciente->estado == 'TRUE'){
            Paciente::where('id',$paciente->id)
            ->update([
               'estado' => 'FALSE'
            ]);
            $mensaje = 'Paciente eliminado';
        }else{
            Paciente::where('id',$paciente->id)
            ->update([
               'estado' => 'TRUE'
            ]);
            $mensaje = 'Paciente restaurado';
        }
       
         return redirect()->route('pacientes.index')->with('success', $mensaje);
    }
}
