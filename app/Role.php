<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=['id','nombre','nombre_mostrado','descripcion'];

    /*
     * Regresa el usuario que tiene este rol
     * */
    public function user() {
        return $this->hasMany(User::class); //devolverá un arreglo de objetos relacionados
    }
}
