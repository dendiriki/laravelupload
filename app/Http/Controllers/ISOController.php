<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ISO;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ISOController extends Controller
{
    public function index()
    {
        $isos = ISO::with(['createdBy', 'modifiedBy', 'company'])->get();

        return view('isos.index', compact('isos'));
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();

        return view('isos.create', compact('users', 'companies'));
    }

    public function store(Request $request)
    {



        $folderISO = $request->description;

        $folderPath = "uploads/" . preg_replace('/[^a-zA-Z0-9]/', '_', $folderISO);

        $uploadsFolder = "uploads/";
        // dd("Masuk ke fungsi store"); // Tambahkan ini
        // Mengambil bagian setelah "uploads/"
        $folderName = str_replace($uploadsFolder, '', $folderPath);

        // dd("Berhasil mencapai sini"); // Tambahkan ini

        if (!Storage::exists($folderPath)) {
            if (Storage::makeDirectory($folderPath)) {
                // Folder berhasil dibuat
                $request->merge(['path' => $folderName]); // Menggabungkan path ke data request
                // dd("Folder berhasil dibuat"); // Tambahkan ini
            } else {
                dd("Gagal membuat folder"); // Tambahkan ini
                // Gagal membuat folder
                return redirect()->route('isos.create')->with('error', 'Failed to create folder');
            }
        }

        ISO::create($request->all());

        return redirect()->route('isos.index')->with('success', 'ISO created successfully!');
    }
}
