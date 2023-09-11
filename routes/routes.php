<?php

use Illuminate\Support\Facades\Route;
use Mintellity\UploadDocument\Http\Controllers\DocumentController;

Route::controller(DocumentController::class)
    ->middleware(config('upload-document.routes.middleware'))
     ->prefix('document')
     ->as('document.')
     ->group(function () {
         Route::get('/view/{document}', 'view')->name('view');
         Route::get('/download/{document}', 'download')->name('download');
         Route::post('/upload', 'upload')->name('upload');
         Route::patch('/update/{document}', 'update')->name('update');
         Route::get('/destroy/{document}', 'destroy')->name('destroy');
     });
