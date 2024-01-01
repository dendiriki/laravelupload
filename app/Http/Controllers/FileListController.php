<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileListController extends Controller
{
    public function index()
    {
        $folderPath = "uploads/";

        // Membaca daftar subfolder dalam folder "uploads"
        $folders = Storage::directories($folderPath);

        // Menampilkan daftar folder
        return view('file-list.index', compact('folders'));
    }

    // public function viewFiles($folder)
    // {
    //     // Periksa apakah pengguna sudah login
    //     if (!auth()->check()) {
    //         return redirect()->route('login');
    //     }

    //     $folderPath = "uploads/" . $folder;

    //     // Periksa apakah folder yang diminta ada
    //     if (!Storage::exists($folderPath)) {
    //         return redirect()->route('file.list')->with('error', 'Folder not found.');
    //     }

    //     // Membaca daftar file dan subfolder dalam folder
    //     $files = Storage::allFiles($folderPath);

    //     // Menampilkan daftar file dan subfolder
    //     return view('file-list.view-files', compact('folder', 'files'));
    // }
}
