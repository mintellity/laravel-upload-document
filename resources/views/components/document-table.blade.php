<div>
    <div class="card">
        <div class="card-header pt-7">
            <div class="card-title">
                <h2>Daten</h2>
            </div>
        </div>
        <div class="card-body pt-5">

            <!-- Documents preview -->
            <table class="table align-middle fs-6 gy-5 no-footer">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th>Bezeichnung</th>
                    <th class="text-end">Aktion</th>
                </tr>
                </thead>
                <tbody class="fw-bold text-gray-600">
                @foreach($documents as $key => $documentGroup)
                    @foreach($documentGroup as $document)
                        <tr class="odd">
                            <form id="editDocumentForm"
                                  action="{{ route('document.update', ['document' => $document->getKey()]) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')
                                <td>
                                    <span class="document-name @error('name') is-invalid @enderror">{{ $document->name }}</span>
                                    <label for="name" class="d-none"></label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="form-control form-control-lg form-control-solid d-none"
                                           value="{{ $document->name }}">
                                    @error('name')
                                    @if(old('name') === $document->name)
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong>
                                        </span>
                                    @endif
                                    @enderror
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('document.download', ['document' => $document->getKey()]) }}"
                                       class="btn btn-secondary">
                                        <span class="fas fa-download"></span>
                                    </a>
                                    @if($edit)
                                        <button type="button" class="btn btn-primary edit-document-button">
                                            <span class="fas fa-edit"></span>
                                        </button>
                                        <button type="submit" class="btn btn-success save-document-button d-none">
                                            <span class="fas fa-check"></span>
                                        </button>
                                        <button type="button" class="btn btn-danger cancel-document-button d-none">
                                            <span class="fas fa-times"></span>
                                        </button>
                                        <a href="{{ route('document.destroy', ['document' => $document->getKey()]) }}"
                                           class="btn btn-danger">
                                            <span class="fas fa-trash"></span>
                                        </a>
                                    @endif
                                </td>
                            </form>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<script src="{{ asset('vendor/upload-document/upload-document.all.js')  }}"></script>

