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
            $file->storeAs(config('upload-document.storage_prefix') . '/' . substr($params['model_id'],0,1) . '/' . $params['model_id'], $originalFilename);

            Document::create([
                'model_type'      => $params['model_type'],
                'model_id'        => $params['model_id'],
                'collection_name' => $params['collection_name'],
                'name'            => pathinfo($originalFilename, PATHINFO_FILENAME),
                'file_name'       => $originalFilename,
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
        $currentFilePath = self::getFilePath($document);

        $newFilename = $data['name'] . '.' . pathinfo($currentFilePath, PATHINFO_EXTENSION);
        $newPath     = config('upload-document.storage_prefix') . '/' . $document->model_id . '/' . $newFilename;

        Storage::move($currentFilePath, $newPath);

        $document->update([
            'name'      => $data['name'],
            'file_name' => $newFilename,
        ]);
    }

    /**
     * @param $document
     * @return void
     */
    public static function destroy($document): void
    {
        $filePath = self::getFilePath($document);

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        $document->delete();
    }

    /**
     * @param $document
     * @return string
     */
    public static function getFilePath($document): string
    {
        return config('upload-document.storage_prefix') . '/' . $document->model_id . '/' . $document->file_name;
    }
}
