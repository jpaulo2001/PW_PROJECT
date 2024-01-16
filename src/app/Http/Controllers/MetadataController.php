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
        $mdata->mdata = $request->mdata;
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
    public function update(Request $request, Mdata $mdata)
    {
        $validatedData = $request->validate([
            'mdata' => 'required',
        ]);
        $mdata->update($validatedData);
        return redirect()->route('Mdata.index')->with('sucess');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Mdata $mdata)
    {
        $mdata->delete();

        return redirect()->route('Mdata.index')->with('success', 'User deleted successfully');
    }
}
