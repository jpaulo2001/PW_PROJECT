<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->tokenCan('users:list')) {
            abort(403);
        }
        return new UserResourceCollection(User::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) //get()
    {
        if (!auth()->user()->tokenCan('users:show')) {
            abort('403');
        }

        try {
            $user = User::findOrFail($user);
            return new UserResource($user);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Não encontrado'], 404);
            }
            return response()->json(['message' => 'Ocorreu um erro de comunicação'], 503);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
