<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id','nombre'];
    //mutador
    //mb_strtolower minusculas
    public function setNombreAttribute($valor){
        $this->attributes['nombre'] = mb_strtolower($valor);
    }
    //accesor
    //ucwords cada palabra la primer letra, la pone en mayúsculas, ucfirst solo la primer letra de toda la frase la pone en mayúsculas.
    public function getNombreAttribute($valor){
        return ucfirst($valor);
    }
}
