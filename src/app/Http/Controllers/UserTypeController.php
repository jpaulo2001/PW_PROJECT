<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use App\Models\UserTypePermition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UserTypeService;

class UserTypeController extends Controller
{
    protected $userTypeService;

    public function __construct(UserTypeService $userTypeService)
    {
        $this->userTypeService = $userTypeService;
    }

    public function index()
    {
        $usertypes = UserTypePermition::orderBy('type')->paginate(25);
        return view(
            'userTypes.index',
            [
                'userTypes' => $usertypes
            ]
        );
    }
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
        $validatedData = $request->validate([
            'user_type_permition' => 'required',
        ]);

        $user = Auth::user();

        $permission = UserTypePermition::firstOrCreate(['type' => $validatedData['user_type_permition']]);

        $userType = new UserType();
        $userType->user_id = $user->id;
        $userType->user_type_permition_id = $permission->id;
        $userType->save();

        return redirect()->route('userTypes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usertypespermition = new UserTypePermition();
        return view('userTypes.create', compact('usertypespermition'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usertypespermition = UserTypePermition::find($id);
        if (empty($usertypespermition)) {
            abort(404);
        }
        $usertypespermition->delete();
        return redirect()->route('userTypes.index');
    }
}
