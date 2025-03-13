<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstablecimientoRequest extends FormRequest
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
        $establecimiento = $this->route('establecimiento');
        return [
            'nombre_establecimiento' => 'required|unique:App\Models\Establecimiento,nombre_establecimiento,'.$establecimiento->id.'|regex:/^[a-zA-ZñÑ\s.\-]+$/|min:2|max:200',
           // 'municipio_id' => 'required|integer',
            'descripcion' => 'nullable|regex:/^[a-zA-ZñÑ\s.,]+$/|max:200',
        ];
    }
    public function attributes() //para cambiar el nombre de la variable
    {
        return[
            'nombre_establecimiento' => 'nombre establecimiento',
        ];
    }
    public function messages()//para vambair el mensaje de la variable
    {
        return[
            'nombre establecimiento.required' => 'Se requiere un nombre',
            'nombre establecimiento.regex' => 'Formato invalido solo de admite letras, puntos y guiones',
            'descripcion' => 'Formato invalido solo de admite letras, comas y puntos',
        ];
    }
}
