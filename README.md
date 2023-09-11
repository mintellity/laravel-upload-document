# Upload documents for Laravel.

This is a package for Laravel to easy upload documents to any model.

## Installation

You can install the package via composer:

```bash
composer require mintellity/upload-document
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="upload-document-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="upload-document-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="upload-document-views"
```

## Usage

Add the trait to any model you want to has documents.
```php
use Mintellity\UploadDocument\Traits\InteractsWithDocuments;
```

Add the component form in some view to upload documents.
```html
<x-upload-document-upload-form/>
```
There are many variables with which you can configure the component.
```html
modelType - The model for which the document will be saved. Default model is User model.
modelLabel - If there are many model for the user to choose from, a label will be shown. Default value is 'Modelltyp'.
models - A collection from many models for the user to choose from.
selectedModelId - Default selected model id.
collectionNameLabel - If there are many collection names for the user to choose from, a label will be shown. Default value is 'Dateityp'.
collectionNames - A collection from many collection names for the user to choose from.
selectedCollectionName - Default selected collection name. Default value is 'default',
allowedMimeTypes - An array of allowed document types. Default value is '.pdf',
multiple - Boolean value for allowing the users to upload multiple files. Default value is 'false'.
```

Add the component table in some view to show documents.
```html
<x-document-table-document-table/>
```
There are also variables with which you can configure the component.
```html
documents - A collection from documents.
edit - Boolean value for allowing the users to update or delete the documents. Default value is 'false'.
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Mintellity](https://github.com/mintellity)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
