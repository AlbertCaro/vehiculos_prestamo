<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    /*
     * Regresa el usuario que tiene este rol
     * */
    public function user(){
        return $this->hasMany(User::class);//devolverá un arreglo de objetos relacionados
    }
}
