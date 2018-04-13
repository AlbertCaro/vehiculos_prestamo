<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardaSolicitudRequest extends FormRequest
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
            'txt_codigoC'=>'required',
            'txt_nombreC'=>'required',
            'txt_celularC'=>'required',
            'txt_licencia'=>'required',
            'txt_venc'=>'required',
            'tipo_licencia'=>'required',
            'txt_contacto'=>'required',
            'txt_parentesco'=>'required',
            'txt_domicilio'=>'required',
            'txt_telefono'=>'required',
            'txt_nombreE'=>'required',
            'txt_domicilioE'=>'required',
            'slc_escala'=>'required',
            'txt_Personas'=>'required',
            'txt_fecha'=>'required',
            'txt_fecha1'=>'required',
            'tipo_evento'=>'required',
            'slc_jefe'=>'required',
            'txt_kilometros'=>'required',
        ];
    }
}
