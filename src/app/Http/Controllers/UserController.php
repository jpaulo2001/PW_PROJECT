<?php

namespace App\Http\Controllers;
use App\Models\UserType;

use App\Http\Controllers\Auth\Controller;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate(25);
        return view(
            'users.index',
            [
                'users' => $users
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $user = new User;
        return view('users.create', compact('user', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->department_id = $request->department_id;
        $user->save();

        $userType = new UserType;
        $userType->user_id = $user->id;
        $userType->user_type_permition_id = $request->user_type_permition_id;
        $userType->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view(
            'users.show',
            [
                'user' => $user
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $departments, User $user)
    {
        $departments = Department::all();
        return view('users.edit', compact('user', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            //'email' => 'required|email',
            'department_id' => 'required',
            'user_type_permition_id' => 'required',
        ]);

        $user->update($validatedData);

        // Update the UserType
        $userType = UserType::where('user_id', $user->id)->first();
        if ($userType) {
            $userType->user_type_permition_id = $request->user_type_permition_id;
            $userType->save();
        }

        return redirect()->route('users.index')->with('success', 'User and UserType updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
