<?php

namespace Mintellity\UploadDocument\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UploadDocumentRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        /** @var Model $uploadModel */
        $uploadModel = app($this->input('model_type'));

        return [
            'model_type'        => 'required|string',
            'model_id'          => [
                'required',
                'string',
                Rule::exists($uploadModel?->getTable(), $uploadModel?->getKeyName()),
            ],
            'collection_name'   => [
                'required',
                'string',
            ],
            'upload_document'   => [
                'required',
                'array',
                'min:1',
            ],
            'upload_document.*' => [
                'required',
                'file',
            ],
        ];
    }
}
