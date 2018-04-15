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
       // dd($value);
        $this->attributes['fecha_solicitud'] = Carbon::parse(strtotime($value.':00'));
    }
    public function setFechaEventoAttribute($value){
        $this->attributes['fecha_evento'] = Carbon::parse(strtotime($value.':00'));
    }
    public function setFechaRespuestaAttribute($value){
        $this->attributes['fecha_respuesta'] = Carbon::parse(strtotime($value.':00'));
    }
    public function setFechaRegresoAttribute($value){
        $this->attributes['fecha_regreso'] = Carbon::parse(strtotime($value.':00'));
    }

    /*public function getEstatusAttribute(){
        $this->attributes['estatus'] = Solicitud::interpretaEstatus($this->attributes['estatus']);
    }*/

    public static function interpretaEstatus($estatus){

        switch ($estatus){
            case 1:
                return "Nuevo";
                break;
            case 2:
                return "Aprobado por el jefe inmediato";
                break;
            case 3:
                return "Aprobado por el secretario administrativo";
                break;
            case 4:
                return "Aprobado por el coordinador de Servicios Generales";
                break;
            case 5:
                return "Rechazado por alguna instancia";
                break;
        }
    }
}
