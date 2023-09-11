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
                    <th>Dateiname</th>
                    @if($edit)
                        <th>Aktion</th>
                    @endif
                </tr>
                </thead>
                <tbody class="fw-bold text-gray-600">
                @foreach($documents as $document)
                    <tr>
                        <form action="{{ route('document.update', ['document' => $document->getKey()]) }}"
                              method="POST">
                            @csrf
                            @method('PATCH')
                            <td>
                                <div class="d-flex">
                                    <label for="name" class="d-none"></label>
                                    <input type="text"
                                           name="name"
                                           class="form-control form-control-lg form-control-solid"
                                           value="{{ $document->name }}"
                                           @if(!$edit) disabled @endif>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('document.view', ['document' => $document->getKey()]) }}" target="_blank" class="btn btn-info">
                                    Anzeigen
                                </a>
                                <a href="{{ route('document.download', ['document' => $document->getKey()]) }}" class="btn btn-secondary">
                                    Herunterladen
                                </a>
                                @if($edit)
                                <button type="submit" class="btn btn-primary">
                                    Aktualisieren
                                </button>
                                <a href="{{ route('document.destroy', ['document' => $document->getKey()]) }}" class="btn btn-danger">
                                    Löschen
                                </a>
                                @endif
                            </td>
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
