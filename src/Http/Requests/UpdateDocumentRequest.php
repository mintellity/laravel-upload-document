<?php

namespace Mintellity\UploadDocument\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mintellity\UploadDocument\Rules\UniqueFileNameInStorage;
use Mintellity\UploadDocument\Services\DocumentService;

class UpdateDocumentRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        $currentFilePath = DocumentService::getFilePath($this->route('document'));
        return [
            'name' => [
                'required',
                'string',
                new UniqueFileNameInStorage(
                    config('upload-document.storage_prefix') . '/' . $this->route('document')->model_id,
                    $this->name . '.' . pathinfo($currentFilePath, PATHINFO_EXTENSION)
                ),
            ],
        ];
    }
}
