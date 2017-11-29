<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Carga extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "plantel_id" => "required|notin:0",
            "archivo" => "required",
            "no_registros" => "required|integer|notin:0",
        ];
    }

    public function messages(){
        return [
        'plantel_id.required' => 'El campo es requerido!',
        'plantel_id.notin' => 'Seleccione un plantel valido!',
        'archivo.required' => 'El campo es requerido!',
        'no_registros.required' => 'El campo es requerido!',
        'no_registros.integer' => 'Numero invalido!',
        'no_registros.notin' => 'Se requiere procesar al menos un registro!',
        ];
    }
}
