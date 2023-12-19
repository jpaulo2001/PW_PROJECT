<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\DocumentResource;
use App\Http\Resources\DocumentResourceCollection;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use Illuminate\Support\Facades\Input;



class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     
    public function index()
    {
        $documents = Document::all();
        if ($documents->count() > 0){
            return response()->json([
                'status' => 200,
                'documents' => $documents
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'documents' => "sem documentos"], 404);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //verificar se o utilizador tem permissão para criar um novo documento
            //FAZER

       //validar dados name email password e departement
       $validator = Validator::make($request->all(),[
        'name' => 'required|string|max:191',
        'email' => 'required|email|max:191',
        'password' => 'required|string|max:20',
        'department_id' => 'required|digits|max:1'
    ]);


        $validator = Validator::make(Input::all(), $validator);

        if($validator->fail()){ //document se falha retorna 403
            return abort(403);
        }else{


            $document = Document::create([
                //completar
        ]);
            //return 201 (created status and documents created)
            return response()->json([ 
                'status' => 201,
                'documents' => $document
            ]);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) //get()
    {
        $document = Document::find($id);
        if ($document) {
            return response()->json([
            'status'=> 200,
            'document'=> $document
            ],200);
        }else{
                return response()->json([
                    "status"=> 404,
                    "message"=> "sem document"
                    ],404);

            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {

        
        if($validator->fail()){ //document se falha retorna 404
            return response()->json([
                'status' => 404,
                'message' => "Nao existe esse utilizador"
            ]);
        }else{

            $document = Document::find($id); //find by id the document and update after
            if($document){
                $document = Document::update([
                    //COMPLETAR
         ]);
            
            //return 201 (created status and documents created)
            return response()->json([ 
                'status' => 200,
                'documents' => $document
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
        //DELETE
        $document = Document::find($id);
        if ($document) {
            $document ->delete();
            return response()->json([
                "status"=> 200, 
                "message"=> "removido com sucesso"]);



    }else{
        return response()->json([
            'status' => 404,
            'message' => "Nao existe esse utilizador"
        ]);

        }
    }
};