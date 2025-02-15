<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
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
            'nombre' => 'required|alpha:ascii|max:100',
            'apellido' => 'required|alpha:ascii|max:100',
            'ci' => 'required|unique:App\Models\Paciente,ci|max:15|min:5',
            'fecha_nacimiento' => 'required|date',
            'edad' => 'required|integer',
            'direccion' => 'nullable|max:200',
            'num_celular' => 'nullable|integer',
            'email' => 'nullable|email',
            'hc' => 'nullable|max:50',
            'num_asegurado' => 'nullable|max:50',
            'sexo' => 'required',
            'descripcion' => 'nullable|max:200',
        ];
        
    }
}
