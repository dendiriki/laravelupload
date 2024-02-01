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
        $folderName = str_replace($uploadsFolder, '', $folderPath);

        try {
            // Gunakan penyimpanan eksternal
            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);
            }

            ISO::create([
                'description' => $request->description,
                'dt_created_date' => $request->dt_created_date,
                'vc_created_user' => $user->code_emp,
                'dt_modified_date' => $request->dt_created_date,
                'vc_modified_user' => $user->code_emp,
                'comp_id' => $user->comp_id,
                'path' => $folderName
            ]);

            return redirect()->route('isos.index')->with('success', 'ISO created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('isos.create')->with('error', 'Failed to create ISO: ' . $e->getMessage());
        }
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
            // Hapus folder terkait
            Storage::deleteDirectory($folderPath);
        }

        // Hapus ISO dari database
        $iso->delete();

        return redirect()->route('isos.index')->with('success', 'ISO deleted successfully!');
    }
}
