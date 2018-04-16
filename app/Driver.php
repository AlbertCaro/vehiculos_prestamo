<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['id', 'dependencies_id', 'nombre', 'apaterno', 'amaterno', 'celular'];

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

    public function contact() {
        return $this->hasOne(Contact::class);
    }

    public function licence() {
        return $this->hasOne(Licence::class);
    }

    public function dependence() {
        return $this->belongsTo(Dependence::class);
    }

    public function request(){
        return $this->belongsTo(Solicitud::class);
    }

    public function Dependencia(){
        return $this->belongsTo(Dependence::class,'dependencies_id','id');
    }
}
