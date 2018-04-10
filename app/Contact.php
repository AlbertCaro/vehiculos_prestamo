<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable=['nombre','apaterno','amaterno','parentesco','telefono','domicilio','driver_id'];

    public function setNombreAttribute($value) {
        $this->attributes['nombre'] = mb_strtolower($value);
    }

    public function setApaternoAttribute($valor) {
        $this->attributes['apaterno'] = mb_strtolower($valor);
    }

    public function setAmaternoAttribute($valor) {
        $this->attributes['amaterno'] = mb_strtolower($valor);
    }

    public function getNombreAttribute($valor) {
        return ucwords($valor);
    }

    public function getApaternoAttribute($valor) {
        return ucwords($valor);
    }

    public function getAmaternoAttribute($valor) {
        return ucwords($valor);
    }

    public function driver() {
        return $this->belongsTo(Driver::class);
    }
}
