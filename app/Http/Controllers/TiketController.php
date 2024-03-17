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
        'document_file' => 'required|file|max:10240',
        'description' => 'required|string|min:5',// Max 10 MB
    ]);

    // Mendapatkan ID user yang sedang login
    $userId = Auth::id();

    // Mendapatkan departemen dan perusahaan dari user yang sedang login
    $user = Auth::user();
    $departmentId = $user->dep_id;
    $companyId = $user->comp_id;

    $name_document = $request->document_name;

    // Menyimpan file document yang diberikan
    $documentFilePath = $request->file('document_file')->store("uploads/tiket/$name_document/document");

    $folderpath = "uploads/tiket/$name_document";

    // Menyimpan data tiket
    $ticketData = [
        'user_id' => $userId,
        'department_id' => $departmentId,
        'company_id' => $companyId,
        'document_name' => $request->document_name,
        'document_file' => $folderpath,
        'document_status' => 'Not Approved',
        'document_note' => $request->document_note ?? ($request->has('revision') ? 'Revision Document' : 'New Document'),
        'tanggal' => now(), // Tanggal saat ini
        'description' => $request->description
    ];

    // Cek apakah ada deskripsi, jika ada tambahkan ke data tiket
    if ($request->has('description')) {
        $ticketData['description'] = $request->description;
    }

    // Simpan file-file tambahan jika diunggah
    if ($request->hasFile('record_file')) {
        $recordFilePath = $request->file('record_file')->store("uploads/tiket/$name_document/record");
        $ticketData['record_file'] = $recordFilePath;
    }

    if ($request->hasFile('attachment_file')) {
        $attachmentFilePath = $request->file('attachment_file')->store("uploads/tiket/$name_document/attachment");
        $ticketData['attachment_file'] = $attachmentFilePath;
    }

    if ($request->hasFile('cover_file')) {
        $coverFilePath = $request->file('cover_file')->store("uploads/tiket/$name_document/cover");
        $ticketData['cover_file'] = $coverFilePath;
    }

    // Simpan data tiket
    Ticket::create($ticketData);

    // Redirect ke halaman yang sesuai, misalnya halaman index atau halaman sukses
    return redirect()->route('file.list')->with('success', 'Dokumen berhasil dibuat.');
}


    public function releaseDocument($number_ticket)
    {
        // Temukan tiket berdasarkan nomor tiket
        $ticket = Ticket::where('number_ticket', $number_ticket)->firstOrFail();

        // Lakukan logika untuk melepaskan dokumen
        // Misalnya, ubah status dokumen menjadi "Released"
        $ticket->update(['document_status' => 'Released']);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Document released successfully.');
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
