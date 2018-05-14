<?php

namespace App\Policies;

use App\Solicitud;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        if($authUser->hasRoles(['admin','coord_servicios_generales'])){
            return true;
        }
    }

    public function edit(User $authUser, User $user){
        return $authUser->id === $user->id;
    }
    public function update(User $authUser, User $user){
        return $authUser->id === $user->id;
    }


}
