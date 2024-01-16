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
        $mdatas = Mdata::orderBy('mdata')->paginate(25);
        return view(
            'documentMdatas.index',
            [
                'mdatas' => $mdatas
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('documentMdatas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mdata = new Mdata;
        $mdata->mdata = $request->mdata;
        $mdata->save();
        return redirect()->route('documentMdatas.index')->with('sucess');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $format)
    {
        $mdatas = Mdata::all();

        return view('documentMdatas.show', ['mdatas' => $mdatas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mdatas = Mdata::find($id);
        return view('documentMdatas.edit', compact('mdatas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mdata = Mdata::find($id);
        if($mdata){
            $mdata->mdata = $request->mdata;
            $mdata->save();
        }
        return redirect()->route('documentMdatas.index')->with('success', 'Mdata updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Mdata $mdata)
    {
        $mdata->delete();

        return redirect()->route('documentMdatas.index')->with('success', 'User deleted successfully');
    }
}
