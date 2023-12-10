<?php

namespace App\Http\Controllers;

use App\Models\DocumentMdata;


use Illuminate\Http\Request;

class DocumentMetadata extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentMdata = DocumentMdata::orderBy('id')->paginate(25);
        return view(
            'documentMdata.index',
            [
                'documentMdata' => $documentMdata
            ]
        );
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
        $documentMdata = new DocumentMdata;
        $documentMdata->mdata_id = $request->mdata_id;
        $documentMdata->document_id = $request->document_id;
        $documentMdata->content = $request->content;
        $documentMdata->value = $request->value;
        $documentMdata->save();
        return redirect()->route('documentMdata')->with('sucess');
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
