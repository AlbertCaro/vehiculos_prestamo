<?php

namespace App\Policies;

use App\Solicitud;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SolicitudPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function before(User $authUser, $ability){
        if($authUser->hasRoles(['admin'])){
            return true;
        }
    }

    public function owner(User $authUser, Solicitud $solicitud){
        return $authUser->id === $solicitud->solicitante_id;
    }
}
