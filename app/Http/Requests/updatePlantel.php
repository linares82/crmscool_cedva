<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatePlantel extends FormRequest
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
            "razon" => "required",
            "rfc" => "required",
            'cve_incorporacion' => "required",
            'tel' => "required",
            'mail' => "required|email",
            'pag_web' => "required",
            'lectivo_id' => "required",
            'logo_file' => 'mimes:jpeg,jpg,png | max:100',
            'membrete_file' => 'mimes:jpeg,jpg,png | max:100',
            'slogan_file' => 'mimes:jpeg,jpg,png | max:100',
        ];
    }

    public function messages(){
        return [
        "razon.required" => 'El campo es requerido!',
        "rfc.required" => 'El campo es requerido!',
        'cve_incorporacion.required' => 'El campo es requerido!',
        'tel.required' => 'El campo es requerido!',
        'mail.required' => 'El campo es requerido!',
        'mail.email' => 'El campo no tiene el formato correcto!',
        'pag_web.required' => 'El campo es requerido!',
        'lectivo_id.required' => 'El campo es requerido!',
        'logo_file.max' => 'Archivo no debe exceder 100 kb',
        'logo_file.mimes' => 'Archivo invalido, usar formato jpeg, jpg o png',
        'membrete_file.max' => 'Archivo no debe exceder 100 kb',
        'membrete_file.mimes' => 'Archivo invalido, usar formato jpeg, jpg o png',
        'slogan_file.max' => 'Archivo no debe exceder 100 kb',
        'slogan_file.mimes' => 'Archivo invalido, usar formato jpeg, jpg o png',
        ];
    }
}
