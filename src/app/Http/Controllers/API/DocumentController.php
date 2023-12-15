<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\documentResource;
use App\Http\Resources\documentResourceCollection;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class documentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::Document()->tokenCan('documents:list')) {
            return response()->json([
                'status' => 404,
                'message' => "Nao existe esse utilizador"
            ]);
        }
        return new DocumentResourceCollection(Document::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //verificar se o utilizador tem permissão para criar um novo documento
            //FAZER



        if($validator->fail()){ //document se falha retorna 403
            return abort(403);
        }else{


            $document = Document::create([
                //completar
        ]);
            //return 201 (created status and documents created)
            return response()->json([ 
                'status' => 200,
                'documents' => $document
            ]);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) //get()
    {
        if (!auth()->Document()->tokenCan('documents:show')) {
            abort('403');
        }

        try {
            $document = Document::findOrFail($document);
            return new documentResource($document);
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


    }else{
        return response()->json([
            'status' => 404,
            'message' => "Nao existe esse utilizador"
        ]);

        }
    }
};