<?php
// app/Http/Controllers/DtHistDocController.php

namespace App\Http\Controllers;

use App\Models\ISO;
use App\Models\User;
use App\Models\Company;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Dep;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\DtHistDoc;
use Illuminate\Support\Facades\DB;

class DtHistDocController extends Controller
{
    public function index()
    {
        $isos = ISO::all();
        $deps = Dep::all(); // Ambil semua departemen berdasarkan singkatan
        $companies = Company::all(); // Ambil semua perusahaan

        $dtHistDocs = DtHistDoc::where('id_sebelum', null)
                        ->whereHas('document', function ($query) {
                            $query->whereExists(function ($subquery) {
                                $subquery->select(DB::raw(1))
                                         ->from('mst_document')
                                         ->whereColumn('mst_document.id', 'dt_histdoc.doc_id');
                            });
                        })
                        ->orderBy('id','asc')
                        ->filter()
                        ->paginate(20);

        return view('dthistdoc.index', compact('dtHistDocs', 'isos', 'deps', 'companies'));
    }

    public function create(Request $request)
    {
        $isos = ISO::all();
        $deps = Dep::all();
        $companies = Company::all();

        $documents = Document::orderBy('sequence', 'asc')
                             ->filter()
                             ->when($request->search, function ($query, $search) {
                                 $query->where('description', 'like', "%{$search}%");
                             })
                             ->when($request->iso, function ($query, $iso) {
                                 $query->where('iso_id', $iso);
                             })
                             ->when($request->dep, function ($query, $dep) {
                                 $query->where('dep_terkait', $dep);
                             })
                             ->when($request->company, function ($query, $company) {
                                 $query->where('comp_id', $company);
                             })
                             ->get();

        return view('dthistdoc.create', compact('documents', 'isos', 'deps', 'companies'));
    }



    public function detail($id)
    {
        $document = Document::find($id);
        $dtHistDoc = DtHistDoc::where('doc_id', $id)->get();

        return view('dthistdoc.detail', compact('dtHistDoc', 'document'));
    }

    public function store(Request $request)
    {

        $rules=[
            'tgl_berlaku' => ['required'],
            'revisi_isi' => ['required'],
            'isiFile' => ['required']
            ];

        $this->validate($request,$rules);


        $user = Auth::user();
        $docId = $request->input('doc_id');

        // Cek apakah dokumen sudah ada
        $entryExist = DtHistDoc::where('doc_id', $docId)->exists();
        if ($entryExist) {
            return redirect()->back()->with('error', 'Dokumen yang ingin anda isi sudah ada, mohon diperiksa kembali atau gunakan fitur revisi.');
        }

        // Ambil informasi dokumen
        $document = Document::where('id', $request->doc_id)->value('path');
        $nomer_document = Document::where('id', $request->doc_id)->value('doc_name');
        $nama_document = Document::where('id', $request->doc_id)->value('description');
        $sequence = Document::where('id', $request->doc_id)->value('sequence');

        // Definisi nama-nama file yang diharapkan
        $expectedFiles = ['cover', 'isi', 'attachment', 'record'];

        foreach ($expectedFiles as $expectedFile) {
            $pdfFile = $request->file($expectedFile . 'File');

            // Cek jika file diunggah
            if ($pdfFile) {
                // Validasi ekstensi file
                $allowedExtensions = ['pdf'];
                $fileExtension = $pdfFile->getClientOriginalExtension();

                if (!in_array($fileExtension, $allowedExtensions)) {
                    return redirect()->back()->with('error', "Ekstensi file $expectedFile tidak diizinkan. Silakan unggah file PDF.");
                }

                // Buat folder jika belum ada
                $folderPath = "documents";

                if (!Storage::exists($folderPath)) {
                    Storage::makeDirectory($folderPath);
                }

                // Generate nama acak untuk file
                $randomFileName = bin2hex(random_bytes(8));

                // Simpan file PDF ke folder dengan nama acak
                $pdfFilePath = $folderPath . '/' . $randomFileName . '.pdf';
                Storage::putFileAs($folderPath, $pdfFile, $randomFileName . '.pdf');

                // Simpan nama file dalam bentuk acak di kolom nodoc
                $nodoc = $randomFileName;

                // Menyimpan nama file PDF ke dalam model DtHistDoc
                DtHistDoc::create([
                    'description' => $nama_document,
                    'doc_id' => $request->input('doc_id'),
                    'vc_created_user' => $user->code_emp,
                    'comp_id' => $user->comp_id,
                    'revisi' => $request->input('revisi_' . $expectedFile),
                    'link_document' => $pdfFilePath,
                    'nodoc' => $nodoc,
                    'doc_name' => $nomer_document,
                    'tgl_berlaku' => $request->input('tgl_berlaku'),
                    'sequence' => $sequence
                ]);

                Session::flash('success', "File $expectedFile berhasil diunggah ke folder: $folderPath");
            }
        }

        return redirect()->route('dthistdoc.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $dtHistDoc = DtHistDoc::findOrFail($id);
        $document = Document::find($dtHistDoc->doc_id);

        if (!$document) {
            return redirect()->back()->with('error', 'Document not found');
        }

        $dtHistDocs = DtHistDoc::where('doc_id', $dtHistDoc->doc_id)->get();
        $users = User::all();
        $companies = Company::all();

        return view('dthistdoc.edit', compact('dtHistDoc', 'document', 'dtHistDocs', 'users', 'companies'));
    }


    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $request->validate([
            'description' => 'required',
            'tgl_berlaku' => 'required',
            'isiFile' => 'required',
            'revisi_isi' => 'required',
        ]);

        $dtHistDoc = DtHistDoc::findOrFail($id);
        $document = Document::find($dtHistDoc->doc_id);

        if (!$document) {
            return redirect()->back()->with('error', 'Document not found');
        }

        $folderPath = "documents";

        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }

        $pdfFile = $request->file('isiFile');

        if ($pdfFile) {
            $randomFileName = bin2hex(random_bytes(8));
            $pdfFilePath = $folderPath . '/' . $randomFileName . '.pdf';
            Storage::putFileAs($folderPath, $pdfFile, $randomFileName . '.pdf');

            $nodoc = $randomFileName;

            DtHistDoc::create([
                'description' => $request->input('description'),
                'doc_id' => $request->input('doc_id'),
                'vc_created_user' => $user->code_emp,
                'comp_id' => $user->comp_id,
                'revisi' => $request->input('revisi_isi'),
                'link_document' => $pdfFilePath,
                'nodoc' => $nodoc,
                'doc_name' => $document->doc_name,
                'tgl_berlaku' => $request->input('tgl_berlaku'),
            ]);

            Session::flash('success', "File berhasil diunggah ke folder: $folderPath");
        }

        return redirect()->route('dthistdoc.index')->with('success', 'Data berhasil diperbarui!');
    }




    public function destroy($id)
    {
        $dtHistDoc = DtHistDoc::findOrFail($id);
        $folderPath = "documents";

        if (Storage::exists($folderPath)) {
            Storage::deleteDirectory($folderPath);
        }

        DtHistDoc::where('doc_id', $dtHistDoc->doc_id)->delete();
        DtHistDoc::where('id_sebelum', $id)->update(['id_sebelum' => null]);

        $dtHistDoc->delete();

        return redirect()->route('dthistdoc.index')->with('success', 'Data dan file terkait berhasil dihapus.');
    }

    public function detaildelete($id, $type)
    {
        $tableName = DtHistDoc::findOrFail($id);
        $expectedFiles = 'isi';
        $document = Document::where('id', $tableName->doc_id)->value('path');
        $nodoc = $tableName->nodoc;
        $filePath = "documents/$nodoc.pdf";

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        $tableName->delete();

        return redirect()->route('dthistdoc.index')->with('success', 'Data dan file terkait berhasil dihapus.');
    }
}
