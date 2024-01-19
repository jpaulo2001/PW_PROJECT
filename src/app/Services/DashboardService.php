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
        // Get the documents created in the last day
        $startDate = Carbon::now()->subDays(1)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $documents = Document::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        return $documents;
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
