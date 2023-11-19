<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::orderBy('id')->paginate(25);
        return view(
            'documents.index',
            [
                'documents' => $documents
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('documents')->with('sucess');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $documents)
    {
        return view(
            'documents.show',
            [
                'documents' => $documents
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $documents)
    {
        return view(
            'documents.edit',
            [
                'documents' => $documents
            ]
        );
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
    public function destroy(Document $documents)
    {
        return view(
            'documents.destory',
            [
                'documents'=> $documents
            ]
        );
    }
}
