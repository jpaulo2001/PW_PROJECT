<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Controller;
use App\Models\Department;
use App\Models\DocumentPermitionType;
use App\Models\DocumentPermition;
use App\Models\DocumentMdata;
use App\Models\User;
use App\Models\Mdata;
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

    public function publicShow($id)
    {
        $document = Document::find($id);

        // Certifique-se de que o documento existe
        if (!$document) {
            abort(404);
        }

        // Retorne a view do documento
        return view('documents.publicShow', ['document' => $document]);
    }


    /**
     * Share a specific document
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function share($id)
    {
        $document = Document::find($id);

        // Gere o link compartilhável
        $shareableLink = route('documents.publicShow', $document->id);

        return redirect()->route('documents.show', $document->id)->with('success', 'Documento partilhado com sucesso! Aqui está o seu link: ' . $shareableLink);
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
        //
        $document = new Document;
        $document->path = "C:\Users\joaop\AppData\Local\Temp\fak56E1.tmp";
        $document->save();


        //
        $mdata = new Mdata;
        $mdata->doc_name = $request->doc_name;  // nome documento
        $mdata->size = $request->size;
        $mdata->type = $request->type;
        $mdata->format = $request->format;
        $mdata->save();


        $documentsPermitionsTypes = new DocumentPermitionType;
        $documentsPermitionsTypes->document_permition_id = $request->document_permition_id;
        $documentsPermitionsTypes->document_id = $document->id;
        $user = auth()->user();
        $documentsPermitionsTypes->user_id = $user->id;
        $documentsPermitionsTypes->department_id = $request->department_id;
        $documentsPermitionsTypes->save();

        //
  

        return redirect()->route('documents.store')->with('sucess');



    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return view('documents.show', ['document' => $document]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $documents)
    {
        $document = Document::find($documents);
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

    public function destroy(User $user, Document $document)
    {

        if ($this->authorize('delete', $document)) {
            $document->delete();
            return redirect()->route('documents.index')->with('success', 'Document deleted successfully');
        }

        return redirect()->route('documents.index')->with('error', 'You do not have permission to delete this document');
    }
}
