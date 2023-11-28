<?php

namespace App\Policies;
use App\Models\User;
use App\Models\Department;
use App\Models\UserTypePermition;


class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user)
    {
        $user->userType->name == ("Admin");    
    }




    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $userType->type == ("Administrador");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return true; /*|| $user->email = 'joaopaulo6069@hotmail.com'*/;
    }




    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        //
    }



    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        //
    }
}

