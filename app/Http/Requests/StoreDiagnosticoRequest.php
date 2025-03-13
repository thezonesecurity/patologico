<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosticoRequest extends FormRequest
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
            'codigo_diagnostico' => 'required|unique:App\Models\Diagnostico,codigo_diagnostico|regex:/^[a-zA-ZñÑ0-9]+$/|min:1|max:50',
            'descripcion_diagnostico' => 'nullable|regex:/^[a-zA-ZñÑ\s.\()]+$/|max:200',
        ];
    }
    public function attributes() //para cambiar el nombre de la variable
    {
        return[
            'codigo_diagnostico' => 'codigo diagnostico',
            'descripcion_diagnostico' => 'descripcion'
        ];
    }
    public function messages()//para vambair el mensaje de la variable
    {
        return[
            'codigo diagnostico.required' => 'Se requiere un codigo',
            'codigo diagnostico.regex' => 'Formato invalido solo de admite letras y numeros',
            'descripcion' => 'Formato invalido solo de admite letras, parentesis y puntos',
        ];
    }
}
