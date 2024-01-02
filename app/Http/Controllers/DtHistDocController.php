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
        $dtHistDocs = DtHistDoc::all(); // Sesuaikan dengan model yang Anda gunakan

        return view('dthistdoc.index', compact('dtHistDocs'));
    }

    public function create()
    {
        $documents = Document::all();
        $users = User::all();
        $companies = Company::all();

        return view('dthistdoc.create', compact('documents', 'users', 'companies'));
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
                    'tgl_perubahan' => $request->input('dt_modified_date'),
                    'tgl_berlaku' => $request->input('dt_modified_date'),
                    'vc_created_user' => $request->input('vc_created_user'),
                    'comp_id' => $request->input('comp_id'),
                    'revisi' => $request->input('revisi_cover'),
                    'link_document' => $pdfFilePath,
                    'nodoc' => $nodoc, // Simpan nama file acak di kolom nodoc
                ]);
                break;
            case 'isi':
                DtHistDoc::create([
                    'description' => $request->input('description'),
                    'doc_id' => $request->input('doc_id'),
                    'tgl_perubahan' => $request->input('dt_modified_date'),
                    'tgl_berlaku' => $request->input('dt_modified_date'),
                    'vc_created_user' => $request->input('vc_created_user'),
                    'comp_id' => $request->input('comp_id'),
                    'revisi' => $request->input('revisi_isi'),
                    'link_document' => $pdfFilePath,
                    'nodoc' => $nodoc, // Simpan nama file acak di kolom nodoc
                ]);
                break;
            case 'attachment':
                DtHistLampiran::create([
                    'description' => $request->input('description'),
                    'doc_id' => $request->input('doc_id'),
                    'tgl_perubahan' => $request->input('dt_modified_date'),
                    'tgl_berlaku' => $request->input('dt_modified_date'),
                    'vc_created_user' => $request->input('vc_created_user'),
                    'comp_id' => $request->input('comp_id'),
                    'revisi' => $request->input('revisi_attachment'),
                    'link_document' => $pdfFilePath,
                    'nodoc' => $nodoc, // Simpan nama file acak di kolom nodoc
                ]);
                break;
            case 'record':
                DtHistCatMut::create([
                    'description' => $request->input('description'),
                    'doc_id' => $request->input('doc_id'),
                    'tgl_perubahan' => $request->input('dt_modified_date'),
                    'tgl_berlaku' => $request->input('dt_modified_date'),
                    'vc_created_user' => $request->input('vc_created_user'),
                    'comp_id' => $request->input('comp_id'),
                    'revisi' => $request->input('revisi_record'),
                    'link_document' => $pdfFilePath,
                    'nodoc' => $nodoc, // Simpan nama file acak di kolom nodoc
                ]);
                break;
            default:
                break;
        }

        // Simpan pesan sukses
        Session::flash('success', "File $expectedFile berhasil diunggah ke folder: $folderPath");
    }

    return redirect()->route('dthistdoc.index')->with('success', 'Data berhasil ditambahkan!');
    }
}
