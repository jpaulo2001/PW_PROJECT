<?php

namespace App\Services;
use Carbon\Carbon;
use App\Models\Document;
use App\Models\Historic;
use Illuminate\Support\Facades\File;

class DashboardService
{
    public function getLastSevenDocuments()
    {
        // Get the last seven documents
        $documents = Document::orderBy('created_at', 'desc')->take(5)->get();

        if ($documents->isEmpty()) {
            return collect(); // or handle the case where no documents are found
        }

        // Extract document IDs
        $documentIds = $documents->pluck('id');

        // Get historic records for the last seven documents
        $date = Carbon::now()->subDays(5);

        return Historic::whereIn('document_id', $documentIds)
            ->where('created_at', '>=', $date)
            ->orderByDesc('created_at') // Order by 'created_at' in descending order
            ->get();
    }


    public function getFileSizes()
    {
        $folderPath = storage_path('app/files');
        $files = File::files($folderPath);

        $totalMemoryGB = 1; // Assume a total memory of 1 GB
        $totalMemoryBytes = $totalMemoryGB * 1024 * 1024 * 1024; // Convert to bytes
        $occupiedMemory = 0;

        foreach ($files as $file) {
            $occupiedMemory += File::size($file);
        }

        $freeMemory = max(0, $totalMemoryBytes - $occupiedMemory); // Ensure non-negative value for free memory

        // Convert to GB for the response
        $occupiedMemoryGB = $occupiedMemory / (1024 * 1024 * 1024);
        $freeMemoryGB = $freeMemory / (1024 * 1024 * 1024);

        $memoryData = [
            'Memoria Ocupada' => $occupiedMemoryGB,
            'Memoria Livre' => $freeMemoryGB
        ];

        return $memoryData;
    }
}
