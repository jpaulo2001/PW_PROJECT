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
            return response()->json([
                'status' => 404,
                'message' => "Nao existe esse utilizador"
            ]);
        }
        return new UserResourceCollection(User::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar dados name email password e departement
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:20',
            'department_id' => 'required|digits|max:1'
        ]);
        
        if($validator->fail()){ //user se falha retorna 403
            return abort(403);
        }else{


            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
        ]);
            //return 201 (created status and users created)
            return response()->json([ 
                'status' => 200,
                'users' => $user
            ]);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) //get()
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
    public function update(Request $request, int $id)
    {
        //validar dados name email password e departement
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:20',
            'department_id' => 'required|digits|max:1'
        ]);
        
        if($validator->fail()){ //user se falha retorna 404
            return response()->json([
                'status' => 404,
                'message' => "Nao existe esse utilizador"
            ]);
        }else{

            $user = User::find($id); //find by id the user and update after
            if($user){
                $user = User::update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'department_id' => $request->department_id,
         ]);
            
            //return 201 (created status and users created)
            return response()->json([ 
                'status' => 200,
                'users' => $user
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Nao existe esse utilizador"
            ]);
        }
    };



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        $user = User::find($id);
        if ($user) {
            $user ->delete();


    }else{
        return response()->json([
            'status' => 404,
            'message' => "Nao existe esse utilizador"
        ]);

        }
    }
};