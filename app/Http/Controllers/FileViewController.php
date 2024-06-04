<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Query\Builder;
use App\Models\Document;
use App\Models\ISO;
use App\Models\DtHistDoc;
use App\Models\DtHistCover;
use App\Models\DtHistLampiran;
use App\Models\DtHistCatMut;
use App\Models\Histdocbaru;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use App\Models\Dep;


class FileViewController extends Controller
{
    public function viewFiles($isoId)
    {
        $iso = ISO::find($isoId);
        if (!$iso) {
            return redirect()->route('file.list');
        }

        $deps = Dep::all();

        // Ambil hanya dokumen yang memiliki entri terkait di DtHistDoc dan iso_id yang sesuai
        $documents = Document::where('iso_id', $isoId)
            ->whereHas('dtHistDocs')
            ->filter()
            ->orderBy('id', 'asc')
            ->paginate(6);

        return view('file-list.view-files', compact('documents', 'iso', 'deps'));
    }

    public function viewAllDocument()
    {
        $deps = Dep::all();

        // Ambil semua dokumen yang telah difilter
        $documents = DtHistDoc::with('document')->filter()->orderBy('doc_id', 'asc')->paginate(6);

        return view('file-list.all_documents', compact('documents', 'deps'));
    }



    public function viewDocument($folder)
    {
        $document = Document::where('id', $folder)->first();

        $documentFiles =  DtHistDoc::with(['document', 'createdBy'])
        ->join(DB::raw('(SELECT doc_id, MAX(lastdate) as max_lastdate FROM histdoclast GROUP BY doc_id) as b'), function ($join) {
            $join->on('dt_histdoc.doc_id', '=', 'b.doc_id')
                ->on('dt_histdoc.tgl_berlaku', '=', 'b.max_lastdate');
        })
        ->join('users', 'dt_histdoc.vc_created_user', '=', 'users.code_emp')
        ->where('dt_histdoc.doc_id', $document->id)
        ->select('dt_histdoc.*')
        ->get();

        // $coverFiles = DtHistCover::where('doc_id', $document->id)->get();
        // $documentFiles = DtHistDoc::where('doc_id', $document->id)->get();
        // $attachmentFiles = DtHistLampiran::where('doc_id', $document->id)->get();
        // $recordFiles = DtHistCatMut::where('doc_id', $document->id)->get();


        return view('file-list.view-folder-contents', compact('documentFiles','folder','document'));
    }

    public function viewDocumentall($folder)
    {
        $document = Document::where('id', $folder)->first();
        $documentFiles = DtHistDoc::where('doc_id', $document->id)->get();

        return view('file-list.view-folder-all', compact('documentFiles', 'folder','document'));
    }

    public function viewPdf($id)
    {
        $cover = DtHistCover::find($id);

        if (!$cover) {
            return redirect()->route('file.list')->with('error', 'Cover not found.');
        }

        return view('file-list.view-pdf', compact('cover'));
    }

    public function viewPdfdoc($id)
    {
        $doc = DtHistDoc::find($id);

        if (!$doc) {
            return redirect()->route('file.list')->with('error', 'doc not found.');
        }

        return view('file-list.view-pdfdoc', compact('doc'));
    }

    public function viewPdflampiran($id)
    {
        $lampiran = DtHistLampiran::find($id);

        if (!$lampiran) {
            return redirect()->route('file.list')->with('error', 'lampiran not found.');
        }

        return view('file-list.view-pdflampiran', compact('lampiran'));
    }

    public function viewPdfcatmut($id)
    {
        $catmut = DtHistCatMut::find($id);

        if (!$catmut) {
            return redirect()->route('file.list')->with('error', 'catmut not found.');
        }

        return view('file-list.view-pdfcatmut', compact('catmut'));
    }







}

