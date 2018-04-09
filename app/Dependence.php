<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependence extends Model
{
    protected $fillable = ['nombre'];

    public function setNombre($value) {
        $this->attributes['nombre'] = mb_strtolower($value);
    }

    public function getNombre($value) {
        return ucwords($value);
    }

    public function driver() {
        return $this->HasOne(Driver::class);
    }
}
