<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ISO;
use App\Models\Type; // Ganti dengan model yang sesuai untuk mst_doctype
use App\Models\User;
use App\Models\Company;
use App\Models\Document; // Model untuk mst_document
use App\Models\Dep;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor

class DocumentController extends Controller
{
    public function index()
    {
        $isos = ISO::all(); // Mendapatkan semua data ISO
        $documents = Document::with(['type', 'iso', 'createdBy', 'company'])
            ->orderBy('dt_created_date', 'desc')->filter()
            ->paginate(6);

        return view('documents.index', compact('documents', 'isos'));
    }


    public function create()
    {
        $deps = Dep::all();
        $types = Type::all();
        $isos = ISO::all();
        $users = User::all();
        $companies = Company::all();

        return view('documents.create', compact('types', 'isos', 'users', 'companies','deps'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // Validasi request
        $request->validate([
            'description' => 'required',
            'iso_id' => 'required',
            'dt_modified_date' => 'required',
            'doc_name' => ['required','unique:mst_document'],
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
            'vc_created_user' => $user->code_emp,
            'dt_modified_date' => $request->dt_modified_date,
            'vc_modified_user' => $user->code_emp,
            'comp_id' =>  $user->comp_id,
            'path' => $folderPath, // Path yang telah disimpan sebelumnya
            'dep_terkait' =>$request->dep_terkait,
            'doc_name' => $request->doc_name
        ];

        // Menyimpan data ISO
        Document::create($documentData);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('documents.index')->with('success', 'Document created successfully!');
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $types = Type::all();
        $isos = ISO::all();
        $users = User::all();
        $companies = Company::all();

        return view('documents.edit', compact('document', 'types', 'isos', 'users', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $document = Document::findOrFail($id);

        // Lakukan perubahan pada $document sesuai dengan $request
        $document->description = $request->input('description');
        $document->doctype_id = $request->input('doctype_id');
        $document->iso_id = $request->input('iso_id');
        $document->vc_created_user = $user->code_emp;
        $document->dt_modified_date = $request->input('dt_modified_date');
        $document->vc_modified_user = $user->code_emp;
        $document->comp_id =  $user->comp_id;
        $document->dep_terkait = $request->input('dep_terkait');
        $document->doc_name->input('doc_name');

        // Simpan perubahan
        $document->save();

        return redirect()->route('documents.index')->with('success', 'Document updated successfully!');
    }


    public function destroy($id)
    {
        // Ambil data dokumen berdasarkan ID
        $document = Document::findOrFail($id);

        // Ambil path folder dokumen
        $folderPath = $document->path;

        // Hapus folder dan isinya
        if (Storage::exists($folderPath)) {
            Storage::deleteDirectory($folderPath);
        }

        // Hapus data dokumen dari database
        $document->delete();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('documents.index')->with('success', 'Document deleted successfully!');
    }

    public function fetchDataForApi()
    {
        $documents = Document::all();


            return response()->json($documents)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

    }

}
