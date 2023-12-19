<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;
use App\Dto\UserDTO;

class UserService
{
    public function createUser(UserDTO $userDTO)
    {
        $user = new User;
        $user->name = $userDTO['name'];
        $user->email = $userDTO['email'];
        $user->password = Hash::make($userDTO['password']);
        $user->department_id = $userDTO['department_id'];
        $user->save();


        $userType = new UserType;
        $userType->user_id = $user->id;
        $userType->user_type_permition_id = $userDTO['user_type_permition_id'];
        $userType->save();

        return $user;
    }

    public function updateUser(User $user, UserDTO $userDTO)
    {
        $user->update([
            'name' => $userDTO['name'],
            'email' => $userDTO['email'],
            'department_id' => $userDTO['department_id'],
        ]);

        $userType = UserType::where('user_id', $user->id)->first();
        if ($userType) {
            $userType->user_type_permition_id = $userDTO['user_type_permition_id'];
            $userType->save();
        }

        return $user;
    }

    public function deleteUser(User $user)
    {

        $userType = UserType::where('user_id', $user->id)->first();
        if ($userType) {
            $userType->delete();
        }

        $user->delete();
    }
}
