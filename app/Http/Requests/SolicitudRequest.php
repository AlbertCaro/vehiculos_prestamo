<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudRequest extends FormRequest
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
        return[
            'txt_nombreE'=>'required|max:245',
            'txt_fecha1'=>'required',
            'event_types_id'=>'required',
            //'driver_id'=>'required1numeric',
            'jefe_id'=>'required|numeric',
            'txt_domicilioE'=>'required|max:191',
            'slc_escala'=>'required|max:191',
            'txt_Personas'=>'required|max:191',
            'txt_kilometros'=>'required|max:191',
            'txt_fecha'=>'required',
        ];
    }
}
