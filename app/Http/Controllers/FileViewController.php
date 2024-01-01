<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileViewController extends Controller
{
    public function viewFiles($folder)
    {
        // Periksa apakah pengguna sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $folderPath = "uploads/" . $folder;

        // Periksa apakah folder yang diminta ada
        if (!Storage::exists($folderPath)) {
            return redirect()->route('file.list')->with('error', 'Folder not found.');
        }

        $files = Storage::allFiles($folderPath);
        $directories = Storage::directories($folderPath);

        return view('file-view.view-files', compact('folder', 'files', 'directories'));
    }

    public function showFolderContents($iso, $folder)
    {
        // Membentuk path ke folder
        $folderPath = "uploads/$iso/$folder";

        // Periksa apakah folder ada
        if (Storage::exists($folderPath)) {
            // Folder ada, tampilkan isinya
            $files = Storage::files($folderPath);

            return view('file-list.file-contents', compact('files', 'iso', 'folder'));
        } else {
            // Folder tidak ditemukan, tampilkan pesan error
            return view('file-list.folder-not-found', compact('iso', 'folder'));
        }
    }
}
