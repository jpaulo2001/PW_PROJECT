<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class DocumentPermitionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $documentsPermitions = new DocumentPermitionType;
        $documentsPermitions->document_permition_id = $request->document_permition_id;
        $documentsPermitions->document_id = $request->document_id;
        $documentsPermitions->user_id = $request->user_id;
        $documentsPermitions->department_id = $request->department_id;
        $documentsPermitions->save();
        return redirect()->route('documentsPermitions')->with('sucess');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
