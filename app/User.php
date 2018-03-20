<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;
    /*
     * Es necesario decir explícitamente qué será lo que llenaremos,
     * De modo que cuando hagamos una asignación masiva utilicemos $request->all();
     * sin tener que mandar llamar a cada campo del request.
     * También, es importante que los campos se llamen exactamente igual que los inputs
     * del formulario.
     * */

    protected $fillable =['password','cargo','nombre','apaterno','amaterno','celular','email'];



    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * Mutadores, sirven para modificar el valor de un atributo antes de ser insertado en la base de datos, Aquí, pondremos todos estos atributos en
     * minúsculas (por ejemplo) el método mb_strtolower se supone que hace que no se generen errores de codificación*/
    public function setNombreAttribute($valor) {
        $this->attributes['nombre'] = mb_strtolower($valor);
    }
    public function setApaternoAttribute($valor) {
        $this->attributes['apaterno'] = mb_strtolower($valor);
    }
    public function setAmaternoAttribute($valor) {
        $this->attributes['amaterno'] = mb_strtolower($valor);
    }
    public function setCargoAttribute($valor) {
        $this->attributes['cargo'] = mb_strtolower($valor);
    }
    public function setEmailAttribute($valor){
        $this->attributes['email'] = mb_strtolower($valor);
    }

    /*
     * Los accesores modifican el valor de un atributo antes de ser mostrado, por ejemplo aquí para cada uno de lo siguientes atributos,
     * con la funcion ucwords cada palabra la primer letra, la pone en mayúsculas, ucfirst solo la primer letra de toda la frase la pone en mayúsculas.
     * */
    public function getNombreAttribute($valor) {
        return ucwords($valor);
    }
    public function getApaternoAttribute($valor) {
        return ucwords($valor);
    }
    public function getAmaternoAttribute($valor) {
        return ucwords($valor);
    }

    public function getCargoAttribute($valor) {
        return ucfirst($valor);
    }

    /*
     * Estas son las relaciones*/


    public function roles() {
        return $this->belongsToMany(Role::class,'users_has_roles');
    }

    public function hasRoles(array $roles){
        foreach ($roles as $role) {

            if ($this->roles->name === $role){
                return true;
            }

        }
        return false;
    }

}
