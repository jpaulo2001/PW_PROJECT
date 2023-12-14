<?php

namespace App\Services;

use App\Models\Mdata;

class MetadataService
{
    public function createMetadata(array $metadataData)
    {
        $mdata = new Mdata;
        $mdata->doc_name = $metadataData['doc_name'];
        $mdata->size = $metadataData['size'];
        $mdata->type = $metadataData['type'];
        $mdata->format = $metadataData['format'];
        $mdata->save();

        return $mdata;
    }

    public function updateMetadata(string $id, array $metadataData)
    {
        $mdata = Mdata::find($id);
        if ($mdata) {
            $mdata->doc_name = $metadataData['doc_name'];
            $mdata->size = $metadataData['size'];
            $mdata->type = $metadataData['type'];
            $mdata->format = $metadataData['format'];
            $mdata->save();
        }

        return $mdata;
    }

    public function deleteMetadata(string $id)
    {
        $mdata = Mdata::find($id);
        if ($mdata) {
            $mdata->delete();
        }
    }
}
