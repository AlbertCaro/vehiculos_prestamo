<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable=['nombre','apaterno','amaterno','parentesco','telefono','drivers_id'];
}
