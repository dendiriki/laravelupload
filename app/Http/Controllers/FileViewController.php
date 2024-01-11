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
use Illuminate\Support\Facades\DB;

class FileViewController extends Controller
{
    public function viewFiles($isoId)
    {
        $iso = ISO::find($isoId);
        if (!$iso) {
            return redirect()->route('file.list');
        }

        $user = Auth::user(); // Mengambil informasi pengguna saat ini

        $documents = Document::whereHas('docDept', function ($query) use ($user) {
            $query->where('dep_id', $user->dep_id);
        })->where('iso_id', $isoId)->get();

        return view('file-list.view-files', compact('documents', 'iso'));
    }




    public function viewDocument($folder)
    {
        $document = Document::where('id', $folder)->first();

        // $documentFiles = DtHistDoc::where('doc_id', $document->id)->whereDate('created_at',$docs)->last();
        $coverFiles =  DtHistCover::with(['document', 'createdBy'])
        ->join(DB::raw('(SELECT doc_id, MAX(lastdate) as max_lastdate FROM histcoverbaru GROUP BY doc_id) as b'), function ($join) {
            $join->on('dt_histcover.doc_id', '=', 'b.doc_id')
                ->on('dt_histcover.created_at', '=', 'b.max_lastdate');
        })
        ->join('users', 'dt_histcover.vc_created_user', '=', 'users.code_emp')
        ->where('dt_histcover.doc_id', $document->id)
        ->select('dt_histcover.*')
        ->get();

        $documentFiles =  DtHistDoc::with(['document', 'createdBy'])
        ->join(DB::raw('(SELECT doc_id, MAX(lastdate) as max_lastdate FROM histdocbaru GROUP BY doc_id) as b'), function ($join) {
            $join->on('dt_histdoc.doc_id', '=', 'b.doc_id')
                ->on('dt_histdoc.created_at', '=', 'b.max_lastdate');
        })
        ->join('users', 'dt_histdoc.vc_created_user', '=', 'users.code_emp')
        ->where('dt_histdoc.doc_id', $document->id)
        ->select('dt_histdoc.*')
        ->get();

        $attachmentFiles = DtHistLampiran::with(['document', 'createdBy'])
        ->join(DB::raw('(SELECT doc_id, MAX(lastdate) as max_lastdate FROM histlambaru GROUP BY doc_id) as b'), function ($join) {
            $join->on('dt_histlampiran.doc_id', '=', 'b.doc_id')
                ->on('dt_histlampiran.created_at', '=', 'b.max_lastdate');
        })
        ->join('users', 'dt_histlampiran.vc_created_user', '=', 'users.code_emp')
        ->where('dt_histlampiran.doc_id', $document->id)
        ->select('dt_histlampiran.*')
        ->get();

        $recordFiles = DtHistCatMut::with(['document', 'createdBy'])
        ->join(DB::raw('(SELECT doc_id, MAX(lastdate) as max_lastdate FROM histcatmutbaru GROUP BY doc_id) as b'), function ($join) {
            $join->on('dt_histcatmut.doc_id', '=', 'b.doc_id')
                ->on('dt_histcatmut.created_at', '=', 'b.max_lastdate');
        })
        ->join('users', 'dt_histcatmut.vc_created_user', '=', 'users.code_emp')
        ->where('dt_histcatmut.doc_id', $document->id)
        ->select('dt_histcatmut.*')
        ->get();

        // $coverFiles = DtHistCover::where('doc_id', $document->id)->get();
        // $documentFiles = DtHistDoc::where('doc_id', $document->id)->get();
        // $attachmentFiles = DtHistLampiran::where('doc_id', $document->id)->get();
        // $recordFiles = DtHistCatMut::where('doc_id', $document->id)->get();


        return view('file-list.view-folder-contents', compact('coverFiles','documentFiles', 'attachmentFiles', 'recordFiles', 'folder','document'));
    }

    public function viewDocumentall($folder)
    {
        $document = Document::where('id', $folder)->first();

        $coverFiles = DtHistCover::where('doc_id', $document->id)->get();
        $documentFiles = DtHistDoc::where('doc_id', $document->id)->get();
        $attachmentFiles = DtHistLampiran::where('doc_id', $document->id)->get();
        $recordFiles = DtHistCatMut::where('doc_id', $document->id)->get();


        return view('file-list.view-folder-all', compact('coverFiles','documentFiles', 'attachmentFiles', 'recordFiles', 'folder','document'));
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

