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
        return [
            'nombre_evento'=>'required|max:245',
            'fecha_evento'=>'required',
            'event_types_id'=>'required|numeric',
            'driver_id'=>'required1numeric',
            'jefe_id'=>'required|numeric',
            'domicilio'=>'required|max:191',
            'escala'=>'required|max:191',
            'personas'=>'required|max:191',
            'distancia'=>'required|max:191',
            'fecha_regreso'=>'required'
        ];
    }
}
