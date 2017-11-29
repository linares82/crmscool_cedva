<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateEmpleado extends FormRequest
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
            //'cve_empleado',
            'nombre'=>'required',
            'ape_paterno'=>'required',
            //'ape_materno'=>'required',
            'puesto_id'=>'required',
            'area_id'=>'required',
            'rfc'=>'required',
            'curp'=>'required',
            'direccion'=>'required',
            //'tel_fijo'=>'required',
            //'tel_cel',
            'mail'=>'required',
            'foto_file'=> 'mimes:jpeg,jpg,png | max:100',
            'identificacion_file'=> 'mimes:jpeg,jpg,png | max:100',
            'contrato_file'=> 'max:1000',
            'evaluacion_psico_file'=> 'max:1000',
            'plantel_id'=>'required',
            'st_empleado_id'=>'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El campo es requerido!',
            'nombre.required' => 'El campo es requerido!',
            'ape_paterno.required' => 'El campo es requerido!',
            //'ape_materno.required' => 'El campo es requerido!',
            'puesto_id.required' => 'El campo es requerido!',
            'area_id.required' => 'El campo es requerido!',
            'rfc.required' => 'El campo es requerido!',
            'curp.required' => 'El campo es requerido!',
            'direccion.required' => 'El campo es requerido!',
            //'tel_fijo'=>'required',
            //'tel_cel',
            'mail.required' => 'El campo es requerido!',
            'foto_file.mimes'=> 'Formatos validos jpeg, jpg o png',
            'foto_file.max'=> 'Tamaño máximo 100 kb',
            'identificacion_file.mimes'=> 'Formatos validos jpeg,jpg,png',
            'identificacion_file.max'=> 'Tamaño máximo 1000 kb',
            'contrato.max'=> 'Tamaño máximo 1000 kb',
            'evaluacion_psico_file'=> 'Tamaño máximo 1000 kb',
            'plantel_id.required' => 'El campo es requerido!',
            'st_empleado_id.required' => 'El campo es requerido!',
        ];
    }
}
