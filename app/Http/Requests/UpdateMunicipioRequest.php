<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMunicipioRequest extends FormRequest
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
        $municipio = $this->route('municipio');
        return [
            'nombre_municipio' => 'required|unique:App\Models\Municipio,nombre_municipio,'.$municipio->id.'|regex:/^[a-zA-ZñÑ\s.,\'\"-]+$/|min:2|max:200',
            'descripcion' => 'nullable|regex:/^[a-zA-ZñÑ\s.,]+$/|max:200',
        ];
    }
    public function attributes() //para cambiar el nombre de la variable
    {
        return[
            'nombre_municipio' => 'nombre municipio',
        ];
    }
    public function messages()//para vambair el mensaje de la variable
    {
        return[
            'nombre municipio.required' => 'Se requiere un nombre',
            'nombre municipio.regex' => 'Formato invalido solo de admite letras, comas, puntos, comillas simples, comillas dobles y guiones',
            'descripcion.regex' => 'Formato invalido solo de admite letras, comas y puntos',
        ];
    }
}
