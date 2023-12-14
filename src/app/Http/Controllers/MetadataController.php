<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mdata;
use App\Services\MetadataService;

class MetadataController extends Controller
{
    protected $metadataService;

    public function __construct(MetadataService $metadataService)
    {
        $this->metadataService = $metadataService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mdata = Mdata::orderBy('id');
        return view('Mdata.index',['Mdata' => $mdata]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('Mdata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mdata = new Mdata;
        $mdata->doc_name = $request->doc_name;
        $mdata->size = $request->size;
        $mdata->type = $request->type;
        $mdata->format = $request->format;
        $mdata->save();
        return redirect()->route('Mdata')->with('sucess');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $format)
    {
        $mdata = Mdata::all();

        return view('Mdata.show', ['Mdata' => $mdata]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mdata = Mdata::find($id);
        return view('Mdata.edit', compact('mdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mdata = Mdata::find($id);
        $mdata->doc_name = $request->input("doc_name");
        $mdata->size = $request->input("size");
        $mdata->type = $request->input("type");
        $mdata->format = $request->input("format");
        $mdata->update();
        return redirect()->route('Mdata.index')->with('sucess');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mdata = Mdata::find($id);
        if (empty($mdata)) {
            abort(404);
        }
        $mdata->delete();
        return redirect()->route('Mdata.index');
    }
}
