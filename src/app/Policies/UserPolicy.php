<?php

namespace App\Policies;
use App\Models\User;
use App\Models\Department;
use App\Models\UserTypePermition;
use Illuminate\Support\Facades\Auth;


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

    public function view(User $user): bool
    {
        $authUser = Auth::user();
        if ($authUser->id == $user->id) {
            return true;
        }
        $userType = $authUser->userType()->where('user_type_permition_id', 1)->first();
        if ($userType !== null) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $userType = $user->userType()->where('user_type_permition_id', 1);
        if ($userType !== null) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        $authUser = Auth::user();
        if ($authUser->id == $user->id) {
            return true;
        }
        $userType = $authUser->userType()->where('user_type_permition_id', 1)->first();
        if ($userType !== null) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        $userType = $user->userType()->where('user_type_permition_id', 1)->first();
        if ($userType !== null) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        $userType = $user->userType()->where('user_type_permition_id', 1)->first();
        if ($userType !== null) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        $userType = $user->userType()->where('user_type_permition_id', 1)->first();
        if ($userType !== null) {
            return true;
        }
        return false;
    }
}
