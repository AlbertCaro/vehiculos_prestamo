<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $fillable = ['numero', 'vencimiento', 'archivo', 'licence_types_id', 'driver_id'];

    public function setNumero($value) {
        $this->attributes['nombre'] = mb_strtolower($value);
    }

    public function setVencimiento($value) {
        $this->attributes['vencimiento'] = Carbon::parse('d/m/Y', $value)->format('Y-m-d');
    }

    public function setArchivo($value) {
        $this->attributes['archivo'] = mb_strtolower($value);
    }

    public function getNumero($value) {
        return mb_strtoupper($value);
    }

    public function getVencimiento(){
        return Carbon::parse('Y-m-d',$this->attributes['vencimiento'])->format('d/m/Y');
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
