<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentPermition;



class DocumentPermitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentsPermitions = DocumentPermition::orderBy('id');
        return view(
            'documentsPermitions.index',
            [
                'documentsPermitions' => $documentsPermitions
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('documentsPermitions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('documentsPermitions')->with('sucess');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('documentsPermitions.show', ['documentsPermitions' => DocumentPermition::findOrFail($format)]);
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
