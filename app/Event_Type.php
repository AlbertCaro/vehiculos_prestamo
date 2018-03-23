<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_Type extends Model
{


    protected $table = 'event_types';

    protected $fillable =['nombre', 'categories_id'];

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

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
