<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $fillable = ['numero', 'vencimiento', 'archivo', 'driver_id'];

    public function setNumero($value) {
        $this->attributes['nombre'] = mb_strtolower($value);
    }

    public function setVencimiento($value) {
        $this->attributes['vencimiento'] = mb_strtolower($value);
    }

    public function setArchivo($value) {
        $this->attributes['archivo'] = mb_strtolower($value);
    }

    public function getNumero($value) {
        return mb_strtoupper($value);
    }

    public function getVencimiento($value){
        return ucwords($value);
    }

    public function getArchivo($value) {
        return ucwords($value);
    }

    public function driver() {
        return $this->belongsTo(Driver::class);
    }

    public function type() {
        return $this->belongsToMany(LicenceType::class);
    }
}
