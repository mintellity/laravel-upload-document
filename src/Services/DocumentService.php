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
            $file->storeAs(self::getStoragePrefix($params['model_id']), $originalFilename);

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
     * @param $filePath
     * @param $object
     * @param $collection
     * @param $sourceFileSystem
     * @return void
     */
    public static function attach($filePath, $object, $collection, $sourceFileSystem = null): void
    {
        if(is_null($sourceFileSystem))
        {
            $sourceFileSystem = env('FILESYSTEM_DRIVER');
        }
        $originalFilename = pathinfo($filePath, PATHINFO_BASENAME);
        $newFilePath      = self::getStoragePrefix($object->getKey()) . '/' . $originalFilename;

        Storage::put($newFilePath, Storage::disk($sourceFileSystem)->get($filePath));

        Document::create([
            'model_type'      => get_class($object),
            'model_id'        => $object->getKey(),
            'collection_name' => $collection,
            'name'            => pathinfo($originalFilename, PATHINFO_FILENAME),
            'file_name'       => $originalFilename,
            'mime_type'       => Storage::mimeType($newFilePath),
            'size'            => Storage::fileSize($newFilePath)
        ]);
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
        $newPath     = self::getStoragePrefix($document->model_id) . '/' . $newFilename;

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
        return self::getStoragePrefix($document->model_id) . '/' . $document->file_name;
    }

    /**
     * @param $objectId
     * @return string
     */
    public static function getStoragePrefix($objectId): string
    {
        return substr($objectId,0,1) . '/' . $objectId . '/';
    }
}
