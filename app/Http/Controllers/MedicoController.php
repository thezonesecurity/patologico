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
    {
        //['id','ci','nombre','apellido','fecha_nacimiento','edad','direccion','especialidad','matricula_profesional','sexo','email','num_celular','descripcion','estado','creatoruser_id','updateduser_id'];
      //  dd($request);
        $nombre = ucfirst(strtolower($request->nombre_med)); //esto elimina espacios innesesarios y la 1ra letra en mayuscula
        $apellido = ucfirst(strtolower($request->apellido_med));
        $direccion = ucfirst(strtolower($request->dir_med));
        $especialidad = ucfirst(strtolower($request->espe_med));

        $fechaNacimiento = Carbon::parse($request->fec_med);
        $edad = $fechaNacimiento->age; //se obtiene la edad a partir d la fecha d nacimiento

        $id_user = auth()->user()->id;
        $medico = new Medicos();
        $medico->nombre = $nombre;
        $medico->apellido = $apellido;
        $medico->ci = $request->cedula_med;
        $medico->fecha_nacimiento = $request->fec_med;
        $medico->edad = $edad;
        $medico->sexo = $request->sexo_med;
        $medico->direccion = $direccion;
        $medico->num_celular = $request->celular_med;
        $medico->matricula_profesional = $request->matricula_med;
        $medico->especialidad = $especialidad;
        $medico->email = $request->email_med;
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
