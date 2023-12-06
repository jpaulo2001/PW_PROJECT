<?php

namespace App\Http\Controllers;


use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function update(Request $request, UserType $userType)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'user_type_permition_id' => 'required',
        ]);

        $userType->update($validatedData);
    }
    public function store(Request $request)
    {
        $userType = new UserType();
        $userType->user_id = $request->user_id;
        $userType->user_type_permition_id = $request->user_type_permition_id;
        $userType->save();
    }
}
