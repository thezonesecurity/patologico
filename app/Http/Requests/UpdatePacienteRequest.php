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
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'apellido' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'ci' => 'required|unique:App\Models\Paciente,ci,'.$paciente->id.'|min:5|max:15',
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
