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
        public string $collectionLabel = 'Gruppe',
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

    /**
     * @return View|Application|Factory
     */
    public function render(): View|Application|Factory
    {
        if (array_key_exists($this->model, config('upload-document'))) {
            $collection = config('upload-document.' . $this->model);
        } else {
            $selectedCollection = $this->default;
        }

        return view('upload-document::components.upload-form', [
            'collection' => $collection ?? null,
            'selectedCollection' => $selectedCollection ?? null,
        ]);
    }
}
