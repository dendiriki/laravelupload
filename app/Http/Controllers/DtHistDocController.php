<?php
// app/Http/Controllers/DtHistDocController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DtHistDoc; // Sesuaikan dengan nama model yang Anda gunakan
use App\Models\Document;
use App\Models\User;
use App\Models\Company;
use App\Models\DtHistCover;
use App\Models\DtHistLampiran;
use App\Models\DtHistCatMut;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class DtHistDocController extends Controller
{
    public function index()
    {
        $dtHistDocs = DtHistDoc::where('id_sebelum', null)->get();

        return view('dthistdoc.index', compact('dtHistDocs'));
    }

    public function create()
    {
        $documents = Document::all();
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
        // Validasi request
        $request->validate([
            'description' => 'required',
            // Sesuaikan aturan validasi lain yang diperlukan
        ]);

        $document = Document::where('id', $request->doc_id)->value('path');

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

                // Simpan nama file dalam bentuk acak di kolom nodoc
                $nodoc = $randomFileName;

                // Menyimpan nama file PDF ke dalam model yang sesuai
        switch ($expectedFile) {
                case 'cover':
                    DtHistCover::create([
                        'description' => $request->input('description'),
                        'doc_id' => $request->input('doc_id'),
                        'vc_created_user' => $request->input('vc_created_user'),
                        'comp_id' => $request->input('comp_id'),
                        'revisi' => $request->input('revisi_cover'),
                        'link_document' => $pdfFilePath,
                        'nodoc' => $nodoc,
                        'doc_name' => $request->input('doc_name'),
                    ]);
                    break;
                case 'isi':
                    DtHistDoc::create([
                        'description' => $request->input('description'),
                        'doc_id' => $request->input('doc_id'),
                        'vc_created_user' => $request->input('vc_created_user'),
                        'comp_id' => $request->input('comp_id'),
                        'revisi' => $request->input('revisi_isi'),
                        'link_document' => $pdfFilePath,
                        'nodoc' => $nodoc,
                        'doc_name' => $request->input('doc_name'),
                    ]);
                    break;
                case 'attachment':
                    DtHistLampiran::create([
                        'description' => $request->input('description'),
                        'doc_id' => $request->input('doc_id'),
                        'vc_created_user' => $request->input('vc_created_user'),
                        'comp_id' => $request->input('comp_id'),
                        'revisi' => $request->input('revisi_attachment'),
                        'link_document' => $pdfFilePath,
                        'nodoc' => $nodoc,
                        'doc_name' => $request->input('doc_name'),
                    ]);
                    break;
                case 'record':
                    DtHistCatMut::create([
                        'description' => $request->input('description'),
                        'doc_id' => $request->input('doc_id'),
                        'vc_created_user' => $request->input('vc_created_user'),
                        'comp_id' => $request->input('comp_id'),
                        'revisi' => $request->input('revisi_record'),
                        'link_document' => $pdfFilePath,
                        'nodoc' => $nodoc,
                        'doc_name' => $request->input('doc_name'),
                    ]);
                    break;
                    default:
                    break;
                }

                Session::flash('success', "File $expectedFile berhasil diunggah ke folder: $folderPath");
            }
            // Jika file tidak diunggah, tambahkan logika yang sesuai di sini
        }

        return redirect()->route('dthistdoc.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $cover = DtHistCover::all();
        $lampiran = DtHistLampiran::all();
        $catmut = DtHistCatMut::all();
        $doc = DtHistDoc::all();
        $dtHistDoc = DtHistDoc::findOrFail($id);
        $documents = Document::find($dtHistDoc->doc_id);
        $users = User::all();
        $companies = Company::all();

        return view('dthistdoc.edit', compact('dtHistDoc', 'documents', 'users', 'companies','cover','lampiran','catmut','doc'));
    }

    public function update(Request $request, $id)
    {
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
                            'vc_created_user' => $request->input('vc_created_user'),
                            'comp_id' => $request->input('comp_id'),
                            'revisi' => $request->input('revisi_cover'),
                            'id_sebelum' => $request->input('cover'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $name,
                            // Sisanya seperti sebelumnya
                        ]);
                        break;
                    case 'isi':
                        DtHistDoc::where('id', $id)->create([
                            'description' => $request->input('description'),
                            'doc_id' => $request->input('doc_id'),
                            'vc_created_user' => $request->input('vc_created_user'),
                            'comp_id' => $request->input('comp_id'),
                            'revisi' => $request->input('revisi_isi'),
                            'id_sebelum' => $request->input('doc'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $name,
                            // Sisanya seperti sebelumnya
                        ]);
                        break;
                    case 'attachment':
                        DtHistLampiran::where('doc_id', $id)->create([
                            'description' => $request->input('description'),
                            'doc_id' => $request->input('doc_id'),
                            'vc_created_user' => $request->input('vc_created_user'),
                            'comp_id' => $request->input('comp_id'),
                            'revisi' => $request->input('revisi_attachment'),
                            'id_sebelum' => $request->input('lampiran'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $name,
                            // Sisanya seperti sebelumnya
                        ]);
                        break;
                    case 'record':
                        DtHistCatMut::where('doc_id', $id)->create([
                            'description' => $request->input('description'),
                            'doc_id' => $request->input('doc_id'),
                            'vc_created_user' => $request->input('vc_created_user'),
                            'comp_id' => $request->input('comp_id'),
                            'revisi' => $request->input('revisi_record'),
                            'id_sebelum' => $request->input('catmut'),
                            'link_document' => $pdfFilePath,
                            'nodoc' => $nodoc,
                            'doc_name' => $name,
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
        DtHistCover::where('doc_id', $dtHistDoc->doc_id)->delete();
        DtHistLampiran::where('doc_id', $dtHistDoc->doc_id)->delete();
        DtHistCatMut::where('doc_id', $dtHistDoc->doc_id)->delete();

        // Menghapus file dan folder terkait
        $document = Document::where('id', $dtHistDoc->doc_id)->value('path');
        $expectedFiles = ['cover', 'isi', 'attachment', 'record'];

        foreach ($expectedFiles as $expectedFile) {
            $folderPath = "$document/$expectedFile";

            if (Storage::exists($folderPath)) {
                Storage::deleteDirectory($folderPath);
            }
        }

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
         if (Storage::exists($filePath)) {
           Storage::delete($filePath);
      }

        $tableName->delete();

    return redirect()->route('dthistdoc.index')->with('success', 'Data dan file terkait berhasil dihapus.');
}

}
