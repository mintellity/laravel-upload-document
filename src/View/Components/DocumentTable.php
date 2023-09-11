<?php

namespace Mintellity\UploadDocument\View\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\View\Component;

class DocumentTable extends Component
{
    public function __construct(
        public Collection $documents = new Collection,
        public bool $edit = false,
    )
    {
    }

    public function render(): View|Application|Factory
    {
        return view('upload-document::components.document-table');
    }
}
