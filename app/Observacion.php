<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $table = 'observaciones';


    protected $fillable = [
        'observacion',
        'requests_id',
        'users_id'
    ];


    public function solicitud(){
        return $this->belongsTo(Solcitud::class,'id','requests_id');
    }

    public function creador(){
        return $this->belongsTo(User::class,'users_id','id');
    }

}
