<?php

namespace Mintellity\UploadDocument\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mintellity\UploadDocument\UploadDocument
 */
class UploadDocument extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mintellity\UploadDocument\UploadDocument::class;
    }
}
