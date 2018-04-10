<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    //
    protected $table = 'requests';



    public function Users(){
        $this->belongsToMany(Users::class);
    }

    public function Drivers(){
        $this->hasMany(Driver::class);
    }
}
