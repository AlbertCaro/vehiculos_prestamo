<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
            'codigo' => 'required|max:75',
            'nombre' => 'required|max:75',
            'apaterno' => 'required|max:75',
            'amaterno' => 'required|max:75',
            'celular' => 'required|max:12',
            'dependencia' => 'required',
            'licencia' => 'required|max:45',
            'vencimiento' => 'required|date',
            'tipo_licencia' => 'required',
            'nombre_cont' => 'required|max:75',
            'apaterno_cont' => 'required|max:75',
            'amaterno_cont' => 'required|max:75',
            'parentesco_cont' => 'required|max:45',
            'domicilio_cont' => 'required|max:100',
            'telefono_cont' => 'required|max:12'
        ];
    }
}
