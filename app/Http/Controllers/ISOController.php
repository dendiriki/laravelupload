<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ISO;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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

        try {
            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);
            }

            $fileName = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $file->getClientOriginalName();
                $file->storeAs($folderPath, $fileName);
            }

            ISO::create([
                'description' => $request->description,
                'dt_created_date' => $request->dt_created_date,
                'vc_created_user' => $user->code_emp,
                'dt_modified_date' => $request->dt_created_date,
                'vc_modified_user' => $user->code_emp,
                'comp_id' => $user->comp_id,
                'path' => $folderPath,
                'file_name' => $fileName
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

        $folderPath = $iso->path;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs($folderPath, $fileName, 'external');

            $iso->file_name = $fileName;
        }

        $iso->update([
            'description' => $request->description,
            'dt_modified_date' => now(),
            'vc_modified_user' => $user->code_emp,
            'comp_id' => $user->comp_id,
        ]);

        return redirect()->route('isos.index')->with('success', 'ISO updated successfully!');
    }

    public function destroy($id)
    {
        $iso = ISO::findOrFail($id);

        $folderPath = $iso->path;
        if (Storage::exists($folderPath)) {
            Storage::deleteDirectory($folderPath);
        }

        $iso->delete();

        return redirect()->route('isos.index')->with('success', 'ISO deleted successfully!');
    }
}
