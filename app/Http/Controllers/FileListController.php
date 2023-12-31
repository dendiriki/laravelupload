<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileListController extends Controller
{
    public function index()
    {
        $folderPath = "uploads/";

        // Read the list of subfolders in the "uploads" folder
        $folders = Storage::directories($folderPath);

        // Display the list of folders
        return view('file-list.index', compact('folders'));
    }

    public function viewFiles($folder)
    {
        $folderPath = "uploads/" . $folder;

        // Periksa apakah folder yang diminta ada
        if (!Storage::exists($folderPath)) {
            return redirect()->route('file.list')->with('error', 'Folder not found.');
        }

        // Membaca daftar file dan subfolder dalam folder
        $files = Storage::files($folderPath);

        // Menampilkan daftar file dan subfolder
        return view('file-list.view-files', compact('folder', 'files'));
    }

}
