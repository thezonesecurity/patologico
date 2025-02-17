<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiagnosticoRequest extends FormRequest
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
        $diagnostico = $this->route('diagnostico');
        return [
            'codigo_diagnostico' => 'required|unique:App\Models\Diagnostico,codigo_diagnostico,'.$diagnostico->id.'|regex:/^[\pL\s\-]+$/u|min:1|max:50',
            'descripcion_diagnostico' => 'nullable|max:200',
        ];
    }
    public function attributes() //para cambiar el nombre de la variable
    {
        return[
            'codigo_diagnostico' => 'codigo',
            'descripcion_diagnostico' => 'descripcion'
        ];
    }
    public function messages()//para vambair el mensaje de la variable
    {
        return[
            'codigo.required' => 'Se requiere un codigo',
        ];
    }
}
