<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
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
            'Memoria Livre' => $freeMemoryGB,
        ];

        return $memoryData;
    }
    public function index()
    {
        $lastSevenDocuments = $this->dashboardService->getLastSevenDocuments();
        $fileSizes = $this->dashboardService->getFileSizes(); // Make sure this method is called correctly

        return view('dashboard.index', compact('lastSevenDocuments', 'fileSizes'));
    }


}
