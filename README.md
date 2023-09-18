# Upload documents for Laravel.

This is a package for Laravel to easy upload documents to any model.

## Installation

You can install the package via composer:

```bash
composer require mintellity/upload-document
```

You can publish the assets and migration:

```bash
php artisan mintellity/upload-document:install
```

Optional you can publish the config and view files:


```bash
php artisan vendor:publish --tag="upload-document-config"
php artisan vendor:publish --tag="upload-document-views"
```

## Usage

Add the trait to any model you want to has documents.
```php
use Mintellity\UploadDocument\Traits\InteractsWithDocuments;
```

Optional add an array to any model you want to has a different document types.
```php
    /**
     * @var array
     */
    public array $documentType = [
        'first' => 'First',
        'second' => 'Second',
        'third' => 'Third',
    ];
```

Add the component form in some view to upload documents.
```html
<x-upload-document-upload-form/>
```
There are many variables with which you can configure the component.
```html
model - A model linked to documents.
model-label - A label for the models. Default value is 'Modelltyp'.
selected-model - If the specific model is already chosen.
collection-label - A label for the document types. Default value is 'Dateityp'.
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
selected-model - If the specific model is already chosen.
edit - Boolean value for allowing the users to update or delete the documents. Default value is 'true'.
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Mintellity](https://github.com/mintellity)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
