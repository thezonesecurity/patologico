<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $paciente = $this->route('paciente');
        return [
            'nombre' => 'required|regex:/^[a-zA-ZñÑ\s.]+$/|min:2|max:100',
            'apellido' => 'required|regex:/^[a-zA-ZñÑ\s.]+$/|min:2|max:100',
            'ci' => 'required|unique:App\Models\Paciente,ci,'.$paciente->id.'|regex:/^[A-ZÑ0-9\s]+$/|min:5|max:15',
            'fecha_nacimiento' => 'required|date',
            'edad' => 'required|integer',
            'direccion' => 'nullable|regex:/^[a-zA-ZñÑ0-9\s.\/]+$/|max:200',
            'num_celular' => 'nullable|integer',
            'email' => 'nullable|unique:App\Models\Paciente,email,'.$paciente->id.'|max:150',
            'hc' => 'nullable|unique:App\Models\Paciente,hc,'.$paciente->id.'|max:50',
            'num_asegurado' =>  'nullable|unique:App\Models\Paciente,num_asegurado,'.$paciente->id.'|max:50',
            'sexo' => 'required',
            'descripcion' => 'nullable|regex:/^[a-zA-ZñÑ\s.]+$/|max:200',
        ];
    }
    public function attributes() //para cambiar el nombre de la variable
    {
        return[
            'fecha_nacimiento' => 'fecha nacimiento',
            'num_celular' => 'numero celular',
            'num_asegurado' => 'numero asegurado'
        ];
    }
    public function messages()//para vambair el mensaje de la variable
    {
        return[
            'nombre.required' => 'Se requiere un nombre',
            'nombre.regex' => 'Formato invalido solo de admite letras y punto',
            'apellido.required' => 'Se requiere un apellido',
            'apellido.regex' => 'Formato invalido solo de admite letras y punto',
            'ci.required' => 'Se requiere cedula identidad',
            'ci.regex' => 'Formato invalido solo de admite numeros y letras mayusculas',
            'fecha nacimiento.required' => 'Se requiere fecha de nacimiento',
            'direccion.regex' => 'Formato invalido solo de admite letras , numeros, punto y /',
            'descripcion.regex' => 'Formato invalido solo de admite letras y punto',
        ];
    }
}
