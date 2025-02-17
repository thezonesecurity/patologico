<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMunicipioRequest extends FormRequest
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
            'nombre_municipio' => 'required|unique:App\Models\Municipio,nombre_municipio|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'descripcion' => 'nullable|max:200',
        ];
    }
}
