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
            'nombre_municipio' => 'required|unique:App\Models\Municipio,nombre_municipio,'.$municipio->id.'|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'descripcion' => 'nullable|max:200',
        ];
    }
}
