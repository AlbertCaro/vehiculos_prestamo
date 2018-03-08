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
}
