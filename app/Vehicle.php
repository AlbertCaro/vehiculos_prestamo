<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

class Vehicle extends Model
{
    protected $fillable =['placas', 'nombre', 'capacidad', 'estado'];


    public function setNombreAttribute($valor){
        $this->attributes['nombre'] = mb_strtolower($valor);
    }

    public function getNombreAttribute($valor){
        return ucwords($valor);
    }

    //relación

    public function request(){
        return $this->belongsTo(Solicitud::class,'vehicles_id');
    }
}




