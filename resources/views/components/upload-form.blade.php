<div>
    <div class="card mb-6">
        <form action="{{ route('document.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header pt-7">
                <div class="card-title">
                    <h2>Dokumente hochladen</h2>
                </div>
            </div>
            <div class="card-body pt-5">
                <input type="hidden" name="model_type" id="model_type" value="{{ $model }}">

                <!-- Select Model -->
                @if($selectedModel)
                    <input type="hidden" name="model_id" id="model_id" value="{{ $selectedModel->getKey() }}">
                @else
                    <div class="row mb-6">
                        <div class="col-md-12 form-group">
                            <label class="fs-6 fw-bold form-label mt-3" for="model_id">
                                {{ $modelLabel }}
                            </label>
                            <select class="form-control form-control-solid @error('model_id') is-invalid @enderror"
                                    name="model_id"
                                    id="model_id">
                                <option value="">Bitte auswählen</option>
                                @foreach ($model::all() as $model)
                                    <option value="{{ $model->getKey() }}">{{ $model }}</option>
                                @endforeach
                            </select>
                            @error('model_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                @endif

                <!-- Select document type -->
                @if($collection)
                    <div class="row mb-6">
                        <div class="col-md-12 form-group">
                            <label class="fs-6 fw-bold form-label mt-3" for="collection_name">
                                {{ $collectionLabel }}
                            </label>
                            <select class="form-control form-control-solid @error('collection_name') is-invalid @enderror"
                                    name="collection_name"
                                    id="collection_name">
                                <option value="">Bitte auswählen</option>
                                @foreach ($collection as $name)
                                    <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('collection_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                @else
                    <input type="hidden"
                           name="collection_name"
                           id="collection_name"
                           value="{{ array_key_first($selectedCollection) }}">
                @endif

                <!-- Upload File -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-7 form-group">
                            <label class="fs-6 fw-bold form-label mt-3" for="upload_document">
                                Import Datei
                            </label>
                            <input type="file"
                                   class="form-control form-control-solid @error('upload_document.*') is-invalid @enderror"
                                   name="upload_document[]"
                                   id="upload_document"
                                   accept="{{ implode(', ', $allowedMimeTypes) }}"
                                   @if ($multiple) multiple @endif>
                            @error('upload_document.*')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
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



