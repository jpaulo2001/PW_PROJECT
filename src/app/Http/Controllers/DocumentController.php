<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Controller;
use App\Models\Department;
use App\Models\DocumentPermitionType;
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
        $userId = auth()->user()->id;
        $userDepartmentId = auth()->user()->department_id;
        $documents = Document::whereHas('documentPermitionType', function ($query) use ($userId, $userDepartmentId) {
            $query->where('user_id', $userId)
                ->orWhere('department_id', $userDepartmentId);
        })->orderBy('id')->paginate(25);

        return view('documents.index',['documents' => $documents]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        $departments = Department::all();
        return view('documents.create', compact('user', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $document = new Document;
        $document->path = "C:\Users\joaop\AppData\Local\Temp\fak56E1.tmp";
        $document->save();
        return redirect()->route('documents.store')->with('sucess');
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
