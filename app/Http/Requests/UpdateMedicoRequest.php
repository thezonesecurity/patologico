<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicoRequest extends FormRequest
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
        $medico = $this->route('medico');
        return [
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'apellido' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'ci' => 'required|unique:App\Models\Medicos,ci,'.$medico->id.'|min:5|max:15',
            'fecha_nacimiento' => 'required|date',
            'edad' => 'required|integer',
            'direccion' => 'nullable|max:200',
            'num_celular' => 'nullable|integer',
            'email' => 'nullable|unique:App\Models\Medicos,email|max:150|min:5',
            'especialidad' => 'required|max:200',
            'matricula_profesional' => 'required|unique:App\Models\Medicos,matricula_profesional,'.$medico->id.'|max:50',
            'sexo' => 'required',
            'descripcion' => 'nullable|max:200',
        ];
    }
}
