<?php

namespace Mintellity\UploadDocument\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Mintellity\UploadDocument\Http\Requests\UpdateDocumentRequest;
use Mintellity\UploadDocument\Http\Requests\UploadDocumentRequest;
use Mintellity\UploadDocument\Models\Document;
use Mintellity\UploadDocument\Services\DocumentService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    /**
     * @param UploadDocumentRequest $request
     * @return RedirectResponse
     */
    public function upload(UploadDocumentRequest $request): RedirectResponse
    {
        $data  = $request->validated();
        $files = $request->file('upload_document');
        DocumentService::store($files, $data);

        return redirect()->back();
    }

    /**
     * @param Document $document
     * @return StreamedResponse
     */
    public function download(Document $document): StreamedResponse|RedirectResponse
    {
        $filePath = DocumentService::getFilePath($document);

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, $document->document_name);
        }

        return redirect()->back()->with('error', 'Datei nicht gefunden.');
    }

    /**
     * @param UpdateDocumentRequest $request
     * @param Document $document
     * @return RedirectResponse
     */
    public function update(UpdateDocumentRequest $request, Document $document): RedirectResponse
    {
        $data = $request->validated();

        DocumentService::update($document, $data);

        return redirect()->back();
    }

    /**
     * @param Document $document
     * @return RedirectResponse
     */
    public function destroy(Document $document): RedirectResponse
    {
        DocumentService::destroy($document);

        return redirect()->back();
    }
}
