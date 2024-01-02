<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use App\Models\ISO;
use App\Models\DtHistDoc;
use App\Models\DtHistCover;
use App\Models\DtHistLampiran;
use App\Models\DtHistCatMut;

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

    public function viewDocument($folder)
    {
        $document = Document::where('id', $folder)->first();

        $coverFiles = DtHistCover::where('doc_id', $document->id)->get();
        $documentFiles = DtHistDoc::where('doc_id', $document->id)->get();
        $attachmentFiles = DtHistLampiran::where('doc_id', $document->id)->get();
        $recordFiles = DtHistCatMut::where('doc_id', $document->id)->get();

        return view('file-list.view-folder-contents', compact('coverFiles', 'documentFiles', 'attachmentFiles', 'recordFiles', 'folder','document'));
    }




}

