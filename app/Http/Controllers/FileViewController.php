<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Document;
use App\Models\ISO;
use App\Models\DtHistDoc;


class FileViewController extends Controller
{
    public function viewFiles($isoId)
    {
        $iso = ISO::find($isoId);
        if (!$iso) {
            return redirect()->route('file.list');
        }

        $documents = Document::where('iso_id', $isoId)->get();

        return view('file-list.view-files', compact('documents', 'iso'));
    }

    public function viewDocumentsInISO($isoId)
    {
        $iso = ISO::find($isoId);
        if (!$iso) {
            return redirect()->route('file-list'); // Ganti 'index' dengan rute yang sesuai
        }

        $documents = Document::where('iso_id', $isoId)->get();

        return view('file-list.view-documents', compact('documents', 'iso'));
    }

    public function viewDocumentDetail($isoId, $documentId)
    {
        $document = Document::where('iso_id', $isoId)->where('id', $documentId)->first();
        if (!$document) {
            return redirect()->route('file-list.view.documents.in.iso', ['isoId' => $isoId]);
        }

        // Ambil revisi dokumen atau detail terkait lainnya
        $revisions = DtHistDoc::where('doc_id', $documentId)->get();

        return view('file-list.view-document-detail', compact('document', 'revisions'));
    }

    public function viewFolderContents( $folder)
    {
        $folderPath = "uploads/$folder"; // Path relatif dari 'storage/app/public'

        if (!Storage::disk('public')->exists($folderPath)) {
            return redirect()->route('file.list')->with('error', 'Folder not found.');
        }

        $files = Storage::disk('public')->files($folderPath); // Mendapatkan semua file dalam folder

        return view('file-list.view-folder-contents', compact('files', 'isoId', 'folder'));
    }

    // public function viewDocument(Document $document)
    // {
    //     // Pastikan bahwa 'path' di model Document adalah path relatif dari direktori 'public'
    //     $filePath = 'uploads/' . $document->path; // Misalnya: 'ISO_9001_2015/PT__Ispat_Indo_Quality_Manual_/isi/fae2a2593d7be547.pdf'

    //     if (!Storage::disk('public')->exists($filePath)) {
    //         abort(404, 'File not found.');
    //     }

    //     // Dapatkan path absolut file
    //     $absolutePath = Storage::disk('public')->path($filePath);

    //     return response()->file($absolutePath);
    // }




}
