<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\DocumentPermitionType;
use App\Models\User;


class DocumentPolicy
{
    /**
     * Determine whether the Document can view any models.
     */
    public function viewAny(Document $document): bool
    {
        return true;
    }

    /**
     * Determine whether the Document can view the model.
     */
    public function view(User $user, Document $document)
    {
        $userWithPermission = Document::join('document_permition_types', 'document_id', '=', 'document_permition_types.document_id')
            ->where('documents.id', $document->id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('department_id', $user->department_id);
            })
            ->where('document_permition_types.document_permition_id', 1)
            ->exists();

        return $userWithPermission;
    }


    /**
     * Determine whether the Document can create models.
     */
    public function create(Document $document): bool
    {
        return $document->type == ("Administrador");
    }

    /**
     * Determine whether the Document can update the model.
     */
    public function update(User $user, Document $document): bool
    {
        $userWithPermission = Document::join('document_permition_types', 'document_id', '=', 'document_permition_types.document_id')
            ->where('documents.id', $document->id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('department_id', $user->department_id);
            })
            ->where('document_permition_types.document_permition_id', 2)
            ->exists();

        return $userWithPermission;
    }


    /**
     * Determine whether the Document can delete the model.
     */
    public function delete(User $user, Document $document): bool
    {
        $userWithPermission = Document::join('document_permition_types', 'document_id', '=', 'document_permition_types.document_id')
            ->where('documents.id', $document->id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('department_id', $user->department_id);
            })
            ->where('document_permition_types.document_permition_id', 3)
            ->exists();

        return $userWithPermission;
    }



    /**
     * Determine whether the Document can restore the model.
     */
    public function restore(Document $document): bool
    {
        return true;
    }

    /**
     * Determine whether the Document can permanently delete the model.
     */
    public function forceDelete(Document $document): bool
    {
        return true;
    }
}
