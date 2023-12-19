<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        if ($users->count() > 0){
            return response()->json([
                'status' => 200,
                'users' => $users
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'documents' => "sem user"], 404);
        }
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
            return response()->json([
                'status'=> 422,
                'error' => $validator->messages(),
            ] ,422);
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
    public function show(Request $request,int $id) //get()
    {
        if (!Auth()->user()->tokenCan('users:show')) {
            abort('403');
        }

        try {
            $user = User::findOrFail($id);
            return new UserResource($id);
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