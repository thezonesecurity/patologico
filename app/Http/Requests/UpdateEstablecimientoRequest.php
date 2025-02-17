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
            'nombre_establecimiento' => 'required|unique:App\Models\Establecimiento,nombre_establecimiento,'.$establecimiento->id.'|regex:/^[\pL\s\- .]+$/u|min:2|max:200',
           // 'municipio_id' => 'required|integer',
            'descripcion' => 'nullable|regex:/^[\pL\s\-]+$/u|max:200',
        ];
    }
}
