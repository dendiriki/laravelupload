<?php
// app/Http/Controllers/DtHistDocController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DtHistDoc; // Sesuaikan dengan nama model yang Anda gunakan
use App\Models\Document;
use App\Models\User;
use App\Models\Company;
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
            // Sesuaikan aturan validasi yang diperlukan
        ]);

        // Lakukan operasi upload dan penyimpanan data sesuai dengan kode upload.php

        // Setelah data berhasil disimpan, redirect ke halaman index
        return redirect()->route('dthistdoc.index')->with('success', 'Data berhasil ditambahkan!');
    }
}
