<?php

namespace Mintellity\UploadDocument\Services;

use Illuminate\Support\Facades\Storage;
use Mintellity\UploadDocument\Models\Document;

class DocumentService
{
    /**
     * @param $files
     * @param $params
     * @return void
     */
    public static function store($files, $params): void
    {
        foreach ($files as $file) {
            $originalFilename = $file->getClientOriginalName();
            $path = $file->storeAs(config('upload-document.storage_prefix'), $originalFilename);

            Document::create([
                'model_type'      => $params['model_type'],
                'model_id'        => $params['model_id'],
                'collection_name' => $params['collection_name'],
                'name'            => pathinfo($originalFilename, PATHINFO_FILENAME),
                'file_name'       => $path,
                'mime_type'       => $file->getClientMimeType(),
                'size'            => $file->getSize()
            ]);
        }
    }

    /**
     * @param $document
     * @param $data
     * @return void
     */
    public static function update($document, $data): void
    {
        $currentFilePath = $document->file_name;

        $newFilename = $data['name'] . '.' . pathinfo($currentFilePath, PATHINFO_EXTENSION);

        Storage::move($currentFilePath, config('upload-document.storage_prefix') . '/' . $newFilename);

        $document->update([
            'name' => $data['name'],
            'file_name' => config('upload-document.storage_prefix') . '/' . $newFilename,
        ]);
    }

    /**
     * @param $document
     * @return void
     */
    public static function destroy($document): void
    {
        $filePath = $document->file_name;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        $document->delete();
    }
}
