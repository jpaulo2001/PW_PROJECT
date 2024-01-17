<?php

namespace App\Http\Controllers;

use App\Models\DocumentMdata;
use App\Services\DocumentMetadataService;

use Illuminate\Http\Request;

class DocumentMetadataController extends Controller
{
    protected $documentMetadataService;

    public function __construct(DocumentMetadataService $documentMetadataService)
    {
        $this->documentMetadataService = $documentMetadataService;
    }

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
        //
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
