<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Redirect;


class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::orderBy('id')->paginate(25);
        return view('documents.index',['documents' => $documents]);
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
        $document = new Document;
        $document->name = $request->path;
        $document->save();
        return redirect()->route('documents')->with('sucess');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        $document = Document::all();

        return view('documents.show', ['documents' => $document]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $documents)
    {
        $document = Document::find($id);
        return view('documents.edit', compact('documents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update logic
        $document = Document::find($id);
        $document->name = $request->input('path');
        $document->update();
        return redirect()->route('documents.index')->with('sucess');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $documents)
    {
        $document = Document::find($id);
        if (empty($document)) {
            abort(404);
        }
        $document->delete();
        return redirect()->route('documents.index');
    }
}
