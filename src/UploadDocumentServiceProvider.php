<?php

namespace Mintellity\UploadDocument;

use Mintellity\UploadDocument\View\Components\DocumentTable;
use Mintellity\UploadDocument\View\Components\UploadForm;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UploadDocumentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('upload-document')
            ->hasViews()
            ->hasConfigFile()
            ->hasRoutes('routes')
            ->hasViewComponent('upload-document', UploadForm::class)
            ->hasViewComponent('document-table', DocumentTable::class)
            ->hasMigration('create_documents_table');
    }
}
