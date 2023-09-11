<div>
    <div class="card mb-6">
        <form action="{{ route('document.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header pt-7">
                <div class="card-title">
                    <h2>Daten importieren</h2>
                </div>
            </div>
            <div class="card-body pt-5">
                <input type="hidden" name="model_type" id="model_type" value="{{ $modelType }}">

                <!-- Select Model -->
                @if($models->isNotEmpty())
                    <div class="row mb-6">
                        <div class="col-md-12 form-group">
                            <label class="fs-6 fw-bold form-label mt-3" for="model_id">
                                {{ $modelLabel }}
                            </label>
                            <select class="form-control form-control-solid" name="model_id" id="model_id">
                                <option value="">Bitte auswählen</option>
                                @foreach ($models as $model)
                                    <option value="{{ $model->getKey() }}">{{ $model }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    <input type="hidden"
                           name="model_id"
                           id="model_id"
                           value="{{ $selectedModelId }}">
                @endif

                <!-- Select file type -->
                @if($collectionNames)
                    <div class="row mb-6">
                        <div class="col-md-12 form-group">
                            <label class="fs-6 fw-bold form-label mt-3" for="collection_name">
                                {{ $collectionNameLabel }}
                            </label>
                            <select class="form-control form-control-solid" name="collection_name" id="collection_name">
                                <option value="">Bitte auswählen</option>
                                @foreach ($collectionNames as $key => $name)
                                    <option value="{{ $key }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    <input type="hidden"
                           name="collection_name"
                           id="collection_name"
                           value="{{ $selectedCollectionName }}">
                @endif

                <!-- Upload File -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-7 form-group">
                            <label class="fs-6 fw-bold form-label mt-3" for="upload_document">
                                Import Datei
                            </label>
                            <input type="file"
                                   class="form-control form-control-solid"
                                   name="upload_document[]"
                                   id="upload_document"
                                   accept="{{ implode(', ', $allowedMimeTypes) }}"
                                   @if ($multiple) multiple @endif>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Hochladen
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



