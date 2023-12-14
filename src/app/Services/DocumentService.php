<?php

namespace App\Services;

use App\Models\Document;
use App\Models\DocumentMdata;
use App\Models\DocumentPermitionType;
use App\Models\Mdata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function createDocument(array $documentData, array $mdataData, array $documentPermitionTypeData)
    {
        $document = new Document;
        $document->path = $documentData['path'];
        $document->save();

        $mdata = new Mdata;
        $mdata->doc_name = $mdataData['doc_name'];
        $mdata->size = $mdataData['size'];
        $mdata->type = $mdataData['type'];
        $mdata->format = $mdataData['format'];
        $mdata->save();

        $documentPermitionType = new DocumentPermitionType;
        $documentPermitionType->document_permition_id = $documentPermitionTypeData['document_permition_id'];
        $documentPermitionType->document_id = $document->id;
        $user = Auth::user();
        $documentPermitionType->user_id = $user->id;
        $documentPermitionType->department_id = $documentPermitionTypeData['department_id'];
        $documentPermitionType->save();

        return $document;
    }

    public function updateDocument(Document $document, array $documentData)
    {
        $document->update(['path' => $documentData['path']]);
        return $document;
    }

    public function deleteDocument(Document $document)
    {
        // Adicione lógica adicional se necessário, como excluir permissões relacionadas
        $document->delete();
    }

    public function downloadDocument(Document $document)
    {
        $path = $document->path;

        if (!Storage::exists($path)) {
            // Pode ser uma boa ideia lançar uma exceção aqui ou retornar uma mensagem de erro
            return false;
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
