<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ISO;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor

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

        $user = Auth::user();

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


            ISO::create([
                'description' => $request->description,
                'dt_created_date' => $request->dt_created_date,
                'vc_created_user' => $user->code_emp, // Menggunakan username dari user yang login
                'dt_modified_date' => $request->dt_created_date,
                'vc_modified_user' => $user->code_emp, // Menggunakan username dari user yang login
                'comp_id' => $user->comp_id, // Menggunakan comp_id dari user yang login
                'path' =>  $folderName
        ]);

        return redirect()->route('isos.index')->with('success', 'ISO created successfully!');
    }
    public function edit($id)
    {
        $iso = ISO::findOrFail($id);
        $users = User::all();
        $companies = Company::all();

        return view('isos.edit', compact('iso', 'users', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $iso = ISO::findOrFail($id);

        $iso->update([
            'description' => $request->description,
            'dt_modified_date' => now(),
            'vc_modified_user' => $user->code_emp, // Menggunakan username dari user yang login
            'comp_id' => $user->comp_id, // Menggunakan comp_id dari user yang login
        ]);

        return redirect()->route('isos.index')->with('success', 'ISO updated successfully!');
    }

    public function destroy($id)
    {
        $iso = ISO::findOrFail($id);

        // Hapus folder terkait
        $folderPath = "uploads/" . str_replace(' ', '_', $iso->path);

        if (Storage::exists($folderPath)) {
            Storage::deleteDirectory($folderPath);
        }

        // Hapus ISO dari database
        $iso->delete();

        return redirect()->route('isos.index')->with('success', 'ISO deleted successfully!');
    }
}
