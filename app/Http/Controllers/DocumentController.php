<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ISO;
use App\Models\Type; // Ganti dengan model yang sesuai untuk mst_doctype
use App\Models\User;
use App\Models\Company;
use App\Models\Document; // Model untuk mst_document
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with(['type', 'iso', 'createdBy', 'company'])->get();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $types = Type::all();
        $isos = ISO::all();
        $users = User::all();
        $companies = Company::all();

        return view('documents.create', compact('types', 'isos', 'users', 'companies'));
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'description' => 'required',
            'iso_id' => 'required',
            'dt_modified_date' => 'required',
            'vc_created_user' => 'required',
            'comp_id' => 'required',
        ]);

        // Mengganti karakter non-alphanumeric menjadi underscore
        $folderDoc = preg_replace('/[^a-zA-Z0-9]/', '_', $request->description);

        // Mengambil description dari ISO berdasarkan iso_id
        $iso = ISO::where('id', $request->iso_id)->value('path');

        // Menentukan path folder
        $folderPath = "uploads/" . $iso . "/" . $folderDoc;

        // Mengecek apakah folder sudah ada, jika tidak maka buat folder baru
        if (!Storage::exists($folderPath)) {
            if (Storage::makeDirectory($folderPath)) {
                // Folder berhasil dibuat, simpan path ke dalam $request
                $request->merge(['path' => $folderDoc]);
            } else {
                // Gagal membuat folder, kembali ke halaman create dengan pesan error
                return redirect()->route('documents.create')->with('error', 'Failed to create folder');
            }
        }

        // Simpan dokumen
        $documentData = [
            'description' => $request->description,
            'doctype_id' => $request->doctype_id,
            'iso_id' => $request->iso_id,
            'dt_created_date' => $request->dt_modified_date,
            'vc_created_user' => $request->vc_created_user,
            'dt_modified_date' => $request->dt_modified_date,
            'vc_modified_user' => $request->vc_created_user,
            'comp_id' => $request->comp_id,
            'path' => $folderPath, // Path yang telah disimpan sebelumnya
        ];

        // Menyimpan data ISO
        Document::create($documentData);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('documents.index')->with('success', 'Document created successfully!');
    }
}
