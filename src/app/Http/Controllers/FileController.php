<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function getFileSizes()
    {
        $folderPath = storage_path('app/files');
        $files = File::files($folderPath);

        $fileSizes = [];

        foreach ($files as $file) {
            $fileSizes[basename($file)] = File::size($file);
        }

        return response()->json($fileSizes);
    }
}
