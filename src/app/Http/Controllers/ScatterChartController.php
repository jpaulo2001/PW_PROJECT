<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ScatterChartController extends Controller
{
    public function scatterChart()
    {
        // Replace this with your actual data retrieval logic
        $data = [
            'labels' => ['Data Point 1', 'Data Point 2', 'Data Point 3', 'Data Point 4', 'Data Point 5'],
            'data' => [
                ['x' => 10, 'y' => 20],
                ['x' => 15, 'y' => 25],
                ['x' => 20, 'y' => 30],
                ['x' => 25, 'y' => 35],
                ['x' => 30, 'y' => 40],
            ],
        ];
        return view('scatter-chart', compact('data'));
    }
}