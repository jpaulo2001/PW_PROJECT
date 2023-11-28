<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\DocumentPermitionType;




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
    public function view(Document $document): string
    {
        return $document->DocumentPermitionType->name == ("document__");    
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
    public function update(Document $document): bool
    {
        return true;
    }




    /**
     * Determine whether the Document can delete the model.
     */
    public function delete(Document $document): bool
    {
        return true;
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