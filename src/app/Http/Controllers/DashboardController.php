<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;



class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, DashboardService $service) //service layer
    {

        



        return view(
            'dashboard',
            [
                'data' => $this->getLastSevenDocuments()  // informaçao dos documentos nos ultimos 7 dias editados/criados/eliminados
            ]
        );
    }




}
