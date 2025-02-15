<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicos;
use Carbon\Carbon;

class MedicoController extends Controller
{

    public function index()
    {
        $medicos = Medicos::get();
        return view('Medicos.index')->with(compact('medicos')); 
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    { //  dd($request);
        $validatedData = $request->validate([
            'fec_med' => ['required'],
            'email_med' => ['required'],
            'nombre_med' => ['required', 'regex:/^[a-zA-ZÑñ ]{3,50}$/'],//
            'apellido_med' =>['required', 'regex:/^[a-zA-ZÑñ ]{3,50}$/'],//
            'dir_med' =>  ['required', 'regex:/^[a-zA-ZÑñ0-9- ]{5,20}$/'],//
            'cedula_med' => ['required', 'regex:/^[a-zA-ZÑñ0-9- ]{5,20}$/'],//
            'celular_med' => ['required', 'regex:/^[0-9- ]{8,12}$/'],
            'matricula_med' =>  ['required', 'regex:/^[a-zA-ZÑñ0-9- ]{5,20}$/'],//
            'espe_med' => ['required', 'regex:/^[a-zA-ZÑñ ]{3,50}$/'],//           
        ]);

        $nombre = ucfirst(strtolower($validatedData['nombre_med']));//$request->nombre_med  //esto elimina espacios innesesarios y la 1ra letra en mayuscula
        $apellido = ucfirst(strtolower($validatedData['apellido_med'])); //$request->apellido_med
        $direccion = ucfirst(strtolower($validatedData['dir_med'])); //$request->dir_med
        $especialidad = ucfirst(strtolower($validatedData['espe_med'])); //$request->espe_med

        $fechaNacimiento = Carbon::parse($validatedData['fec_med']); //$request->fec_med
        $edad = $fechaNacimiento->age; //se obtiene la edad a partir d la fecha d nacimiento

        $id_user = auth()->user()->id;
        $medico = new Medicos();
        $medico->nombre = $nombre;
        $medico->apellido = $apellido;
        $medico->ci = $validatedData['cedula_med']; // $request->cedula_med;
        $medico->fecha_nacimiento = $validatedData['fec_med']; // $request->fec_med;
        $medico->edad = $edad;
        $medico->sexo = $request->sexo_med;
        $medico->direccion = $direccion;
        $medico->num_celular = $validatedData['celular_med']; //$request->celular_med;
        $medico->matricula_profesional = $validatedData['matricula_med'];  //$request->matricula_med;
        $medico->especialidad = $especialidad;
        $medico->email = $validatedData['email_med']; //$request->email_med;
        $medico->estado = 'TRUE';
        $medico->creatoruser_id = $id_user;
        $medico->updateduser_id = $id_user;
        $medico->save();
        return redirect(route('listar.medicos.registrar'))->with('success', 'El medico se registro correctamente');
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
    public function deshabilitar(Request $request)
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
