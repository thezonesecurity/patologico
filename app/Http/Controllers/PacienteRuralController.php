<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Carbon\Carbon;

class PacienteRuralController extends Controller
{
   
    public function index()
    {
        //
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
            return 'registrado';
        }else{ return 'error Paciente';}
    }

    public function store(Request $request)
    {
        //
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
