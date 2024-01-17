<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Document;
use App\Models\Historic;

class DashboardService
{
    public function getLastSevenDocuments()
    {
        // Get the last seven documents
        $documents = Document::orderBy('created_at', 'desc')->take(7)->get();
    
        if ($documents->isEmpty()) {
            return collect(); // or handle the case where no documents are found
        }
    
        // Extract document IDs
        $documentIds = $documents->pluck('id');
    
        // Get historic records for the last seven documents
        $date = Carbon::now()->subDays(1000);
    
        return Historic::whereIn('document_id', $documentIds)
            ->where('created_at', '>=', $date)
            ->orderBy('created_at')
            ->get();
    }


}
