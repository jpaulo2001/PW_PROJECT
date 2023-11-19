<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metadata;

class MetadataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Metadatas = Metadata::orderBy('id');
        return view(
            'Metadata.index',
            [
                'Metadata' => $Metadatas
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $format)
    {
        return view('Metadata.show', ['metadata' => Metadata::findOrFail($format)]);

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
