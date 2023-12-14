<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $userData, array $userTypeData)
    {
        $user = new User;
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = Hash::make($userData['password']);
        $user->department_id = $userData['department_id'];
        $user->save();


        $userType = new UserType;
        $userType->user_id = $user->id;
        $userType->user_type_permition_id = $userTypeData['user_type_permition_id'];
        $userType->save();

        return $user;
    }

    public function updateUser(User $user, array $userData, array $userTypeData)
    {
        $user->update([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'department_id' => $userData['department_id'],
        ]);

        $userType = UserType::where('user_id', $user->id)->first();
        if ($userType) {
            $userType->user_type_permition_id = $userTypeData['user_type_permition_id'];
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
