<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class UploadFileService
{
    public function processUploadedFile(UploadedFile $file)
    {
        // Exemplo de lógica de negócios para processar o arquivo
        $fileDetails = [
            'name' => $file->getClientOriginalName(),
            'extension' => $file->getClientOriginalExtension(),
            'realPath' => $file->getRealPath(),
            'size' => $file->getSize(),
            'mimeType' => $file->getMimeType(),
        ];

        // Move o arquivo para o destino desejado
        $destinationPath = 'uploads';
        $file->move($destinationPath, $fileDetails['name']);

        return $fileDetails;
    }
}
