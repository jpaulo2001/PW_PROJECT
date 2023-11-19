<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;



class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, DashboardService $service)
    {
        return view(
            'dashboard',
            [
                'data' => $this->getLastSevenDocuments()
            ]
        );
    }
}
