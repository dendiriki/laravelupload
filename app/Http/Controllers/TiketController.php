<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TiketController extends Controller
{

    public function registerDocument()
    {
        $document_status = 'not approve'; // Set status for new document
        $document_note = 'new document'; // Set note for new document

        return view('tiket.register_document', compact('document_status', 'document_note'));
    }

    /**
     * Show the form for registering a document revision.
     */
    public function registerRevision()
    {
        $document_status = 'not approve'; // Set status for document revision
        $document_note = 'revision document'; // Set note for document revision

        return view('tiket.register_revision', compact('document_status', 'document_note'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi input
         $request->validate([
            'document_name' => 'required|string|max:255',
            'document_file' => 'required|file|max:10240', // Max 10 MB
        ]);

        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();

        // Mendapatkan departemen dan perusahaan dari user yang sedang login
        $user = Auth::user();
        $departmentId = $user->dep_id;
        $companyId = $user->comp_id;

        // Menyimpan data tiket
        Ticket::create([
            'user_id' => $userId,
            'department_id' => $departmentId,
            'company_id' => $companyId,
            'document_name' => $request->document_name,
            'document_file' => $request->file('document_file')->store('files'), // Menyimpan file ke direktori 'storage/app/files'
            'document_status' => 'Not Approved',
            'document_note' => $request->document_note ?? ($request->has('revision') ? 'Revision Document' : 'New Document'),
            'tanggal' => now(), // Tanggal saat ini
        ]);

        // Redirect ke halaman yang sesuai, misalnya halaman index atau halaman sukses
        return redirect()->route('file.list')->with('success', 'Document created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tiket $tiket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tiket $tiket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tiket $tiket)
    {
        //
    }

}
