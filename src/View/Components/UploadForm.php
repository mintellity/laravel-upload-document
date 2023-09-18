<?php

namespace Mintellity\UploadDocument\View\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\View\Component;
use Mintellity\UploadDocument\Helpers\ModelHelper;

class UploadForm extends Component
{
    private array $default = [
        'default' => 'Standard'
    ];

    public function __construct(
        public $model = null,
        public $selectedModel = null,
        public string $modelLabel = 'Modelltyp',
        public string $collectionLabel = 'Dateityp',
        public array $allowedMimeTypes = ['.pdf'],
        public bool $multiple = false,
    )
    {

        if (is_null($this->model) && !is_null($this->selectedModel)) {
            foreach (ModelHelper::getAllModels() as $model) {
                if ($this->selectedModel instanceof $model) {
                    $this->model = $model;
                }
            }
        }
    }

    public function render(): View|Application|Factory
    {
        $collection = app($this->model)->documentType;
        $selectedCollection = null;
        if (is_null($collection)) {
            $selectedCollection = $this->default;
        }

        return view('upload-document::components.upload-form', [
            'collection' => $collection,
            'selectedCollection' => $selectedCollection,
        ]);
    }


}
