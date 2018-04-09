<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenceType extends Model
{
    protected $fillable = ['tipo'];

    public function setTipo($value) {
        $this->attributes['tipo'] = mb_strtolower($value);
    }

    public function getTipo($value) {
        return ucwords($value);
    }

    public function licence() {
        return $this->hasMany(Licence::class);
    }
}
