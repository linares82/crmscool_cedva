<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateLectivo extends FormRequest
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
            "name" => "required",
            
        ];
    }

    public function messages(){
        return [
        'name.required' => 'El campo Año lectivo es requerido!',
        'activo.required' => 'El campo Activo es requerido!',
        ];
    }
}
