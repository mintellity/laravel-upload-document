<?php

namespace Mintellity\UploadDocument\View\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\View\Component;

class UploadForm extends Component
{
    public function __construct(
        public $modelType = null,
        public string $modelLabel = 'Modelltyp',
        public Collection $models = new Collection,
        public string|int|null $selectedModelId = null,
        public string $collectionNameLabel = 'Dateityp',
        public array|null $collectionNames = null,
        public string|int|null $selectedCollectionName = 'default',
        public array $allowedMimeTypes = ['.pdf'],
        public bool $multiple = false,
    )
    {
        if ($this->modelType === null) {
            $this->modelType = config('auth.providers.users.model');
        }
        if ($this->selectedModelId === null) {
            $this->selectedModelId = auth()->id();
        }
    }

    public function render(): View|Application|Factory
    {
        return view('upload-document::components.upload-form');
    }
}
