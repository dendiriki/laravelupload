<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ISO;

class FileListController extends Controller
{
    public function index()
    {
        $isos = ISO::all(); // Mengambil semua data ISO

        return view('file-list.index', compact('isos'));
    }

}
