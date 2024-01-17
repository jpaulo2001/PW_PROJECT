<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $lastSevenDocuments = $this->dashboardService->getLastSevenDocuments();

        return view('dashboard.index', ['lastSevenDocuments' => $lastSevenDocuments]);
    }
}
