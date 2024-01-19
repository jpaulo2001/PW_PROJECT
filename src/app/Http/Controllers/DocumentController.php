<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Controller;
use App\Models\Department;
use App\Models\DocumentPermitionType;
use App\Models\DocumentPermition;
use App\Models\DocumentMdata;
use App\Models\User;
use App\Models\Mdata;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Historic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\DocumentService;
use Ramsey\Uuid\Uuid;
use App\DTO\DocumentDTO;


class DocumentController extends Controller
{
    protected $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

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


    public function publicShow($uuid)
    {
        $document = Document::where('uuid', $uuid)->first();

        if (!$document) {
            abort(404);
        }

        return view('documents.publicShow', ['document' => $document]);
    }


    /**
     * Share a specific document
     */
    public function share($id)
    {
        $document = Document::find($id);

        if (!$document) {
            abort(404);
        }

        $shareableLink = route('documents.publicShow', $document->uuid);

        return redirect()->route('documents.show', $document->id)->with('success', 'Documento partilhado com sucesso! Aqui está o seu link: ' . $shareableLink);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $users = User::all();
        $departments = Department::all();
        $permitions = DocumentPermition::all();
        $mdatas = Mdata::all();
        $historics = Historic::all();

        return view('documents.create', compact('users', 'departments', 'permitions', 'mdatas','historics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('file');

        $document = new Document;
        $document->path = $file->storeAs('files', $request->input('mdata_value')[0] . '.' . $file->getClientOriginalExtension());
        $document->uuid = Uuid::uuid4()->toString();
        $document->save();

        $size = $file->getSize();
        $extension = $file->getClientOriginalExtension();

        $mdatas_ids = $request->input('mdata_id');
        $mdatas_values = $request->input('mdata_value');

// Adiciona o tamanho e a extensão no inico do array
        array_unshift($mdatas_values, $size, $extension);
        array_unshift($mdatas_ids, 1, 2); // Adiciona IDs ficticios pro size e tipo

        for($key = 0; $key < count($mdatas_ids); $key++) {
            $documentMdata = new DocumentMdata;
            $documentMdata->mdata_id = $mdatas_ids[$key];
            $documentMdata->document_id = $document->id;
            $documentMdata->content = $mdatas_values[$key];
            $documentMdata->save();
        }
        $userDocument= new UserDocument;
        $userDocument->document_id = $document->id;
        $userDocument->user_id = Auth::user()->id;
        $userDocument-> save();
        
        $historic = new Historic;
        $historic->document_id = $document->id;
        $historic->body = 'Document created';  // You can customize the body message
        $historic->save();

        // Permissao para o user que carregou o documento
        for ($permition_id = 1; $permition_id <= 4; $permition_id++) {
            $docPermition = new DocumentPermitionType;
            $docPermition->user_id = Auth::user()->id;
            $docPermition->document_permition_id = $permition_id;
            $docPermition->document_id = $document->id;
            $docPermition->save();
        }



        $selectedDepartments = $request->selected_departments;
        $selected_permissions = $request->selected_permissions;
        if ($selectedDepartments) {
            foreach ($selectedDepartments as $departmentId) {
                foreach ($selected_permissions as $permissionsID) {
                    DocumentPermitionType::firstOrCreate(
                        ['document_permition_id' => $permissionsID,
                            'department_id' => $departmentId,
                            'document_id' => $document->id],
                        ['user_id' => Auth::user()->id]
                    );
                }
            }
        }

        $selectedUsers = $request->selected_users;
        $selectedUserPermissions = $request->selected_user_permissions;

        if ($selectedUsers) {
            foreach ($selectedUsers as $userId) {
                if (isset($selectedUserPermissions[$userId])) {
                    foreach ($selectedUserPermissions[$userId] as $permissionId) {
                        DocumentPermitionType::firstOrCreate(
                            ['document_permition_id' => $permissionId,
                                'user_id' => $userId,
                                'document_id' => $document->id],
                        );
                    }
                }
            }
        }

        return redirect()->route('documents.store')->with('success');
    }


    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        if (Auth::user()->can('view', $document)) {
            return view('documents.show', ['document' => $document]);
        } else {
            abort(403);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $document = Document::find($id);
        $departments = Department::all();
        $permitions = DocumentPermition::all();
        $users = User::all();
        $mdatas = Mdata::all();

        return view('documents.edit', compact('document', 'departments', 'permitions', 'users', 'mdatas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $document = Document::find($id);

        if ($document) {
            $file = $request->file('file');
            if ($file) {
                $document->path = $file->storeAs('files', $request->input('mdata_value')[2] . '.' . $file->getClientOriginalExtension());
                $size = $file->getSize();
                $extension = $file->getClientOriginalExtension();

                $mdatas_ids = $request->input('mdata_id');
                $mdatas_values = $request->input('mdata_value');

                $document->save();

                // Update the size metadata
                $sizeMdata = DocumentMdata::where('mdata_id', 1)->where('document_id', $document->id)->first();
                if ($sizeMdata) {
                    $sizeMdata->content = $size;
                    $sizeMdata->save();
                } else {
                    DocumentMdata::create(['mdata_id' => 1, 'document_id' => $document->id, 'content' => $size]);
                }

                // Update the format metadata
                $formatMdata = DocumentMdata::where('mdata_id', 2)->where('document_id', $document->id)->first();
                if ($formatMdata) {
                    $formatMdata->content = $extension;
                    $formatMdata->save();
                } else {
                    DocumentMdata::create(['mdata_id' => 2, 'document_id' => $document->id, 'content' => $extension]);
                }

                // Update the rest of the metadata
                foreach($mdatas_ids as $key => $mdata_id) {
                    if ($mdata_id != 1 && $mdata_id != 2) {
                        $documentMdata = DocumentMdata::where('mdata_id', $mdata_id)->where('document_id', $document->id)->first();
                        if ($documentMdata) {
                            $documentMdata->content = $mdatas_values[$key];
                            $documentMdata->save();
                        }
                    }
                }
            }

            $selectedDepartments = $request->selected_departments;
            $selected_permissions = $request->selected_permissions;

            if ($selectedDepartments) {
                foreach ($selectedDepartments as $departmentId) {
                    foreach ($selected_permissions as $permissionsID) {
                        $docPermition = DocumentPermitionType::firstOrCreate(
                            ['document_permition_id' => $permissionsID,
                                'department_id' => $departmentId,
                                'document_id' => $document->id],
                            ['user_id' => Auth::user()->id]
                        );
                        if (!$docPermition->wasRecentlyCreated) {
                            $docPermition->user_id = Auth::user()->id;
                            $docPermition->save();
                        }
                    }
                }
            }

            $selectedUsers = $request->selected_users;
            $selectedUserPermissions = $request->selected_user_permissions;

            if ($selectedUsers) {
                foreach ($selectedUsers as $userId) {
                    if (isset($selectedUserPermissions[$userId])) {
                        foreach ($selectedUserPermissions[$userId] as $permissionId) {
                            $docPermition = DocumentPermitionType::firstOrCreate(
                                ['document_permition_id' => $permissionId,
                                    'user_id' => $userId,
                                    'document_id' => $document->id],
                            );
                            if (!$docPermition->wasRecentlyCreated) {
                                $docPermition->user_id = $userId;
                                $docPermition->save();
                            }
                        }
                    }
                }
            }


            $document->save();

            return redirect()->route('documents.index', $id)->with('success', 'Documento atualizado com sucesso!');
        } else {
            return redirect()->route('documents.index', $id)->with('error', 'Documento não encontrado!');
        }
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

    /**
     * Download the specified document.
     */
    public function download(Document $document)
    {
        $path = $document->path;

        if (!Storage::exists($path)) {
            return redirect()->back()->with('error', 'The document doesnt exist.');
        }

        return Storage::download($path);
    }

    public function getDocumentData($documentId)
    {
        return DocumentMdata::join('mdatas', 'document_mdatas.mdata_id', '=', 'mdatas.id')
            ->select('mdatas.*')
            ->where('document_mdatas.document_id', $documentId)
            ->first();
    }

}
