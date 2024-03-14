<?php
// app/Http/Controllers/DtHistDocController.php

namespace App\Http\Controllers;

use App\Models\ISO;
use App\Models\User;
use App\Models\Company;
use App\Models\Document;
use App\Models\DtHistCover;
use App\Models\DtHistCatMut;
use Illuminate\Http\Request;
use App\Models\Dep;
use App\Models\DtHistLampiran;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor
use App\Models\DtHistDoc; // Sesuaikan dengan nama model yang Anda gunakan
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
                        ->orderBy('sequence','asc')
                        ->filter()
                        ->paginate(20);

        return view('dthistdoc.index', compact('dtHistDocs', 'isos', 'deps', 'companies'));
    }


    public function create()
    {
<<<<<<< HEAD
        // Mengurutkan dokumen berdasarkan 'description' dari A-Z
        $documents = Document::orderBy('sequence', 'asc')->get();
=======
        $documents = Document::orderBy('description','asc')->get();
>>>>>>> main
        $users = User::all();
        $companies = Company::all();

        return view('dthistdoc.create', compact('documents', 'users', 'companies'));
    }


    public function detail ($id){
       $document = Document::find($id);
       $dtHistDoc = DtHistDoc::where('doc_id', $id)->get();
       $dtHistCover = DtHistCover::where('doc_id', $id)->get();
       $dtHistLampiran = DtHistLampiran::where('doc_id', $id)->get();
       $dtHistCatMut = DtHistCatMut::where('doc_id', $id)->get();

       return view('dthistdoc.detail', compact ('dtHistDoc', 'dtHistCover', 'dtHistLampiran','dtHistCatMut','document'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
<<<<<<< HEAD

        $docId = $request->input('doc_id');

        $entryExist = DtHistDoc::where('doc_id',$docId)->exists();

        if($entryExist){
            return redirect()->back()->with('error','Dokumen yang ingin anda isi sudah ada mohon di perikas kembali atau gunakan fitur revisi');
        }

        $document = Document::where('id', $request->doc_id)->value('path');
        $nomer_document = Document::where('id', $request->doc_id)->value('doc_name');
        $nama_document = Document::where('id', $request->doc_id)->value('description');
        $sequence = Document::where('id', $request->doc_id)->value('sequence');

=======

        // Validasi request dasar
        $request->validate([
            'doc_id' => 'required|exists:mst_document,id',
            'tgl_berlaku' => 'required|date',
            // Tambahkan validasi lain jika diperlukan
        ]);

        $document = Document::where('id', $request->doc_id)->firstOrFail();
        $pathupload = realpath($document->path);
        $nomer_document = $document->doc_name;
        $nama_document = $document->description;
>>>>>>> main

        $expectedFiles = ['cover', 'isi', 'attachment', 'record'];

        foreach ($expectedFiles as $expectedFile) {
            $pdfFile = $request->file($expectedFile . 'File');

            $nodoc = null;
            $pdfFilePath = null;

            if ($pdfFile) {
<<<<<<< HEAD
// Validasi ekstensi file
=======
>>>>>>> main
                $allowedExtensions = ['pdf'];
                $fileExtension = $pdfFile->getClientOriginalExtension();
                if (!in_array($fileExtension, $allowedExtensions)) {
                    return back()->with('error', "Ekstensi file {$expectedFile} tidak diizinkan. Silakan unggah file PDF.");
                }

<<<<<<< HEAD
                // Buat folder jika belum ada
                $folderPath = "$document/$expectedFile";

                // Ganti karakter backslash (\) dengan forward slash (/) pada folderPath
=======
                $folderPath = "{$pathupload}/{$expectedFile}";
>>>>>>> main
                $folderPath = str_replace('\\', '/', $folderPath);

                if (!Storage::exists($folderPath)) {
                    Storage::makeDirectory($folderPath);
                }

<<<<<<< HEAD
// Generate nama acak untuk file
=======
>>>>>>> main
                $randomFileName = bin2hex(random_bytes(8));
                Storage::putFileAs($folderPath, $pdfFile, $randomFileName . '.pdf');

                $pdfFilePath = $folderPath . '/' . $randomFileName . '.pdf';
                $nodoc = $randomFileName;
            }

<<<<<<< HEAD
                // Menyimpan nama file PDF ke dalam model yang sesuai
                switch ($expectedFile) {
                    case 'cover':
                        DtHistCover::create([
=======
            // Menyimpan data ke database, termasuk ketika tidak ada file yang diunggah
            $dataToSave = [
>>>>>>> main
                'description' => $nama_document,
                'doc_id' => $request->input('doc_id'),
                'vc_created_user' => $user->code_emp,
                'comp_id' => $user->comp_id,
<<<<<<< HEAD
                'revisi' => $request->input('revisi_cover'),
=======
                'revisi' => $request->input('revisi_' . $expectedFile),
>>>>>>> main
                'link_document' => $pdfFilePath,
                'nodoc' => $nodoc,
                'doc_name' => $nomer_document,
                'tgl_berlaku' => $request->input('tgl_berlaku'),
<<<<<<< HEAD
                'sequence' => $sequence
            ]);
                    break;
                case 'isi':
                    DtHistDoc::create([
                            'description' => $nama_document,
                            'doc_id' => $request->input('doc_id'),
                            'vc_created_user' => $user->code_emp,
                            'comp_id' => $user->comp_id,
                            'revisi' => $request->input('revisi_isi'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $nomer_document,
                            'tgl_berlaku' => $request->input('tgl_berlaku'),
                            'sequence' => $sequence
                        ]);
                    break;
                case 'attachment':
                    DtHistLampiran::create([
                            'description' => $nama_document,
                            'doc_id' => $request->input('doc_id'),
                            'vc_created_user' => $user->code_emp,
                            'comp_id' => $user->comp_id,
                            'revisi' => $request->input('revisi_attachment'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $nomer_document,
                            'tgl_berlaku' => $request->input('tgl_berlaku'),
                            'sequence' => $sequence
                        ]);
                    break;
                case 'record':
                    DtHistCatMut::create([
                            'description' => $nama_document,
                            'doc_id' => $request->input('doc_id'),
                            'vc_created_user' => $user->code_emp,
                            'comp_id' => $user->comp_id,
                            'revisi' => $request->input('revisi_record'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $nomer_document,
                            'tgl_berlaku' => $request->input('tgl_berlaku'),
                            'sequence' => $sequence



                        ]);
                        break;
                    default:
                    break;
            }

                Session::flash('success', "File $expectedFile berhasil diunggah ke folder: $folderPath");
=======
            ];

            // Tentukan model berdasarkan $expectedFile
            switch ($expectedFile) {
                case 'cover':
                    DtHistCover::create($dataToSave);
                    break;
                case 'isi':
                    DtHistDoc::create($dataToSave);
                    break;
                case 'attachment':
                    DtHistLampiran::create($dataToSave);
                    break;
                case 'record':
                    DtHistCatMut::create($dataToSave);
                    break;
>>>>>>> main
            }
        }

        return redirect()->route('dthistdoc.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit($id)
    {
        // Ambil data DtHistDoc berdasarkan $id
        $dtHistDoc = DtHistDoc::findOrFail($id);

        // Ambil data cover yang memiliki doc_id sama dengan $id
        $cover = DtHistCover::where('doc_id', $dtHistDoc->doc_id)->get();

        // Ambil data lampiran yang memiliki doc_id sama dengan $id
        $lampiran = DtHistLampiran::where('doc_id', $dtHistDoc->doc_id)->get();

        // Ambil data catmutu yang memiliki doc_id sama dengan $id
        $catmut = DtHistCatMut::where('doc_id', $dtHistDoc->doc_id)->get();

        // Ambil data doc yang memiliki doc_id sama dengan $id
        $doc = DtHistDoc::where('doc_id', $dtHistDoc->doc_id)->get();

        // Ambil data Document berdasarkan doc_id pada DtHistDoc
        $documents = Document::find($dtHistDoc->doc_id);

        // Ambil data user dan company
        $users = User::all();
        $companies = Company::all();

        // Kirim data ke view
        return view('dthistdoc.edit', compact('dtHistDoc', 'documents', 'users', 'companies', 'cover', 'lampiran', 'catmut', 'doc'));
    }


    public function update(Request $request, $id)
    {

        $user = Auth::user();
        // Validasi request
        $request->validate([
            'description' => 'required',
            // Sesuaikan aturan validasi lain yang diperlukan
        ]);

        $document = Document::where('id', $request->doc_id)->value('path');
        $name = DtHistDoc::where('doc_id', $request->doc_id)->value('doc_name');



        // dd($name);
        // Ambil data dari formulir
        $pathupload = $document; // Tentukan path sesuai kebutuhan Anda

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
                $folderPath = "$pathupload/$expectedFile";
                if (!Storage::exists($folderPath)) {
                    Storage::makeDirectory($folderPath);
                }

                // Generate nama acak untuk file
                $randomFileName = bin2hex(random_bytes(8));

                // Simpan file PDF ke folder dengan nama acak
                $pdfFilePath = $folderPath . '/' . $randomFileName . '.pdf';
                Storage::putFileAs($folderPath, $pdfFile, $randomFileName . '.pdf');

                // Update nama file dalam bentuk acak di kolom nodoc
                $nodoc = $randomFileName;

                // Update nama file PDF ke dalam model yang sesuai
                switch ($expectedFile) {
                    case 'cover':
                        DtHistCover::where('doc_id', $id)->create([
                            'description' => $request->input('description'),
                            'doc_id' => $request->input('doc_id'),
                            'vc_created_user' => $user->code_emp,
                            'comp_id' => $user->comp_id,
                            'revisi' => $request->input('revisi_cover'),
                            'id_sebelum' => $request->input('cover'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $name,
                            'tgl_berlaku' => $request->input('tgl_berlaku'),
                            // Sisanya seperti sebelumnya
                        ]);
                        break;
                    case 'isi':
                        DtHistDoc::where('id', $id)->create([
                            'description' => $request->input('description'),
                            'doc_id' => $request->input('doc_id'),
                            'vc_created_user' => $user->code_emp,
                            'comp_id' => $user->comp_id,
                            'revisi' => $request->input('revisi_isi'),
                            'id_sebelum' => $request->input('doc'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $name,
                            'tgl_berlaku' => $request->input('tgl_berlaku'),
                            // Sisanya seperti sebelumnya
                        ]);
                        break;
                    case 'attachment':
                        DtHistLampiran::where('doc_id', $id)->create([
                            'description' => $request->input('description'),
                            'doc_id' => $request->input('doc_id'),
                            'vc_created_user' => $user->code_emp,
                            'comp_id' => $user->comp_id,
                            'revisi' => $request->input('revisi_attachment'),
                            'id_sebelum' => $request->input('lampiran'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $name,
                            'tgl_berlaku' => $request->input('tgl_berlaku'),
                            // Sisanya seperti sebelumnya
                        ]);
                        break;
                    case 'record':
                        DtHistCatMut::where('doc_id', $id)->create([
                            'description' => $request->input('description'),
                            'doc_id' => $request->input('doc_id'),
                            'vc_created_user' => $user->code_emp,
                            'comp_id' => $user->comp_id,
                            'revisi' => $request->input('revisi_record'),
                            'id_sebelum' => $request->input('catmut'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $name,
                            'tgl_berlaku' => $request->input('tgl_berlaku'),
                            // Sisanya seperti sebelumnya
                        ]);
                        break;
                }

                Session::flash('success', "File $expectedFile berhasil diperbarui ke folder: $folderPath");
            }
            // Jika file tidak diunggah, tambahkan logika yang sesuai di sini
        }

        return redirect()->route('dthistdoc.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dtHistDoc = DtHistDoc::findOrFail($id);

        // Menghapus entri terkait dari tabel DtHistCover, DtHistLampiran, dan DtHistCatMut


        // Menghapus file dan folder terkait
        $document = Document::where('id', $dtHistDoc->doc_id)->value('path');
        $expectedFiles = ['cover', 'isi', 'attachment', 'record'];

        foreach ($expectedFiles as $expectedFile) {
            $folderPath = "$document/$expectedFile";

            if (Storage::exists($folderPath)) {
                Storage::deleteDirectory($folderPath);
            }
        }

        DtHistCover::where('doc_id', $dtHistDoc->doc_id)->delete();
        DtHistLampiran::where('doc_id', $dtHistDoc->doc_id)->delete();
        DtHistCatMut::where('doc_id', $dtHistDoc->doc_id)->delete();
        DtHistDoc::where('doc_id', $dtHistDoc->doc_id)->delete();

        // Mengatur id_sebelum menjadi NULL pada baris yang merujuk ke baris ini
        DtHistDoc::where('id_sebelum', $id)->update(['id_sebelum' => null]);

        // Menghapus data dari database
        $dtHistDoc->delete();

        return redirect()->route('dthistdoc.index')->with('success', 'Data dan file terkait berhasil dihapus.');
    }

    public function detaildelete($id, $type)
{
    // Variabel untuk menyimpan nama tabel dan jenis dokumen
    $tableName = '';
    $pdfFolder = '';

    // Tentukan tabel dan folder/file PDF berdasarkan jenis dokumen
    switch ($type) {
        case 'dtHistDoc':
            $tableName = DtHistDoc::findOrFail($id);
            $expectedFiles = 'isi';
            break;

        case 'dtHistCover':
            $tableName = DtHistCover::findOrFail($id);
            $expectedFiles = 'cover';
            break;

        case 'dtHistLampiran':
            $tableName = DtHistLampiran::findOrFail($id);
            $expectedFiles = 'attachment';
            break;

        case 'dtHistCatMut':
            $tableName = DtHistCatMut::findOrFail($id);
            $expectedFiles = 'record';
            break;

        default:
            // Tindakan default jika jenis dokumen tidak dikenali
            return redirect()->route('dthistdoc.index')->with('error', 'Jenis dokumen tidak valid.');
    }

        $document = Document::where('id', $tableName->doc_id)->value('path');
        $nodoc = $tableName->nodoc;

        $filePath = "$document/$expectedFiles/$nodoc.pdf";

         // Hapus file jika ada
        // Hapus file jika ada
    if (Storage::exists($filePath)) {
        Storage::delete($filePath);
    }

        $tableName->delete();

    return redirect()->route('dthistdoc.index')->with('success', 'Data dan file terkait berhasil dihapus.');
}

}
