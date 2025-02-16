<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicoRequest extends FormRequest
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
        return [
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:100',
            'apellido' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:100',
            'ci' => 'required|unique:App\Models\Medicos,ci|max:15|min:5',
            'fecha_nacimiento' => 'required|date',
            'edad' => 'required|integer',
            'direccion' => 'nullable|max:200',
            'num_celular' => 'nullable|integer',
            'email' => 'nullable|unique:App\Models\Medicos,email|max:150|min:5',
            'especialidad' => 'required|max:200',
            'matricula_profesional' => 'required|unique:App\Models\Medicos,matricula_profesional|max:50',
            'sexo' => 'required',
            'descripcion' => 'nullable|max:200',
        ];
    }
}
