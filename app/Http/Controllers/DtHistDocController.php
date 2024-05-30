<?php
// app/Http/Controllers/DtHistDocController.php

namespace App\Http\Controllers;

use App\Models\ISO;
use App\Models\User;
use App\Models\Company;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Dep;
use App\Models\DtHistDoc;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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
                        ->orderBy('doc_id','asc')
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
        $user = Auth::user();
        // Validasi request
        $rules=[
            'tgl_berlaku' => ['required'],
            'revisi_isi' => ['required'],
            'isiFile' => ['required']
            ];

        $this->validate($request,$rules);

        // Mendapatkan path dari model Document
        $document = Document::where('id', $request->doc_id)->value('path');

        $description = Document::where('id', $request->doc_id)->value('description');

        // Definisi nama file yang diharapkan
        $pdfFile = $request->file('isiFile');

        // Cek jika file diunggah
        if ($pdfFile) {
            // Validasi ekstensi file
            $allowedExtensions = ['pdf'];
            $fileExtension = $pdfFile->getClientOriginalExtension();

            if (!in_array($fileExtension, $allowedExtensions)) {
                return redirect()->back()->with('error', "Ekstensi file tidak diizinkan. Silakan unggah file PDF.");
            }

            // Buat folder jika belum ada
            $folderPath = $document; // Gunakan path dari model Document

            // Ganti karakter backslash (\) dengan forward slash (/) pada folderPath
            $folderPath = str_replace('\\', '/', $folderPath);

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
                'description' => $description,
                'doc_id' => $request->input('doc_id'),
                'vc_created_user' => $user->code_emp,
                'comp_id' => $user->comp_id,
                'revisi' => $request->input('revisi_isi'),
                'link_document' => $pdfFilePath,
                'nodoc' => $nodoc,
                'doc_name' => $request->input('doc_name'),
                'tgl_berlaku' => $request->input('tgl_berlaku'),
            ]);

            Session::flash('success', "File berhasil diunggah ke folder: $folderPath");
        } else {
            // Jika file tidak diunggah, tambahkan logika yang sesuai di sini
            return redirect()->back()->with('error', 'Tidak ada file yang diunggah.');
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

    public function update(Request $request)
    {
        $user = Auth::user();
        // Validasi request
        $request->validate([
            'description' => 'required',
            'tgl_berlaku' => 'required',
            'isiFile' => 'required',
            'revisi_isi' => 'required',
        ]);

        // Mendapatkan path dari model Document
        $document = Document::where('id', $request->doc_id)->value('path');

        $description = Document::where('id', $request->doc_id)->value('description');

        // Definisi nama file yang diharapkan
        $pdfFile = $request->file('isiFile');

        // Cek jika file diunggah
        if ($pdfFile) {
            // Validasi ekstensi file
            $allowedExtensions = ['pdf'];
            $fileExtension = $pdfFile->getClientOriginalExtension();

            if (!in_array($fileExtension, $allowedExtensions)) {
                return redirect()->back()->with('error', "Ekstensi file tidak diizinkan. Silakan unggah file PDF.");
            }

            // Buat folder jika belum ada
            $folderPath = $document; // Gunakan path dari model Document

            // Ganti karakter backslash (\) dengan forward slash (/) pada folderPath
            $folderPath = str_replace('\\', '/', $folderPath);

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

            // Menyimpan nama file PDF ke dalam model DtHistDoc sebagai revisi
            DtHistDoc::create([
                'description' => $description,
                'doc_id' => $request->input('doc_id'),
                'vc_created_user' => $user->code_emp,
                'comp_id' => $user->comp_id,
                'revisi' => $request->input('revisi_isi'),
                'link_document' => $pdfFilePath,
                'nodoc' => $nodoc,
                'doc_name' => $request->input('doc_name'),
                'tgl_berlaku' => $request->input('tgl_berlaku'),
                'id_sebelum' => $request->input('doc'),
            ]);

            Session::flash('success', "File berhasil diunggah ke folder: $folderPath");
        } else {
            // Jika file tidak diunggah, tambahkan logika yang sesuai di sini
            return redirect()->back()->with('error', 'Tidak ada file yang diunggah.');
        }

        return redirect()->route('dthistdoc.index')->with('success', 'Data revisi berhasil ditambahkan!');
    }



    public function destroy($id)
    {
        $dtHistDoc = DtHistDoc::findOrFail($id);

        $document = Document::where('id', $dtHistDoc->doc_id)->value('path');

        $folderPath = $document;

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
        $filePath = "$document/$nodoc.pdf";

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        $tableName->delete();

        return redirect()->route('dthistdoc.index')->with('success', 'Data dan file terkait berhasil dihapus.');
    }
}
