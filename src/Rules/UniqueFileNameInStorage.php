<?php

namespace Mintellity\UploadDocument\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UniqueFileNameInStorage implements Rule
{
    public function __construct(private $directory, private $newFileName = null) {}

    public function passes($attribute, $value): bool
    {

        if (is_string($value)) {
            $fileName = $this->newFileName;
        } else {
            $fileName = $value->getClientOriginalName();
        }

        if (Storage::exists($this->directory . '/' . $fileName)) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'Es existiert bereits eine Datei mit demselben Namen.';
    }
}
