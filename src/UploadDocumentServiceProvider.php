<?php

namespace Mintellity\UploadDocument;

use Mintellity\UploadDocument\View\Components\DocumentTable;
use Mintellity\UploadDocument\View\Components\UploadForm;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

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
            ->hasConfigFile()
            ->hasViews()
            ->hasViewComponent('upload-document', UploadForm::class)
            ->hasViewComponent('document-table', DocumentTable::class)
            ->hasAssets()
            ->hasRoutes('routes')
            ->hasMigration('create_documents_table')
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishAssets()
                    ->publishMigrations()
                    ->publishConfigFile()
                    ->askToRunMigrations();
            });;
    }
}
