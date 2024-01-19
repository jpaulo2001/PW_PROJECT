<?php

// App\Http\Controllers\UserController.php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->authorizeResource(User::class, 'user');
        $this->userService = $userService;
    }

    public function index()
    {
        $users = User::orderBy('name')->paginate(25);
        return view('users.index', ['users' => $users]);
    }

    public function store(CreateUserRequest $request)
    {
        $userDTO = $request->toDTO();
        $this->userService->createUser($userDTO);

        return redirect()->route('users.index');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $userDTO = $request->toDTO($user);
        $this->userService->updateUser($user, $userDTO);

        return redirect()->route('users.index')->with('success', 'User and UserType updated successfully');
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
