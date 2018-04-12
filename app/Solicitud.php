<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    //
    protected $table = 'requests';

    protected $fillable= ['nombre_evento',
        'estatus',
        'fecha_solicitud',
        'fecha_respuesta',
        'fecha_evento',
        'event_types_id',
        'driver_id',
        'solicitante_id',
        'vehicles_id',
        'jefe_id',
        'escala',
        'domicilio',
        'personas',
        'distancia',
        'fecha_regreso',
        'vehiculo_propio',
        'solicita_conductor'];

    public $timestamps = false;
    public function Users(){
        $this->belongsToMany(Users::class);
    }

    public function Drivers(){
        $this->hasMany(Driver::class);
    }
    public function setFechaSolicitudAttribute($value){
        $this->attributes['fecha_solicitud'] = Carbon::parse($value);
    }
    public function setFechaEventoAttribute($value){
        $this->attributes['fecha_evento'] = Carbon::parse($value);
    }
    public function setFechaRespuestaAttribute($value){
        $this->attributes['fecha_respuesta'] = Carbon::parse($value);
    }
    public function setFechaRegresoAttribute($value){
        $this->attributes['fecha_regreso'] = Carbon::parse($value);
    }
}
