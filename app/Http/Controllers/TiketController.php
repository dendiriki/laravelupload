<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Document;
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
        $documents = Document::orderBy('sequence','asc')->get();
        $document_status = 'not approve'; // Set status for document revision
        $document_note = 'revision document'; // Set note for document revision

        return view('tiket.register_revision', compact('document_status', 'document_note','documents'));
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
        $validated = $request->validate([
            'document_name' => 'required|string|max:255',
            'document_file' => 'nullable|file|max:10240', // Maksimal 10 MB
            'description' => 'required|string|min:5',
            // Tambahkan validasi untuk file tambahan jika perlu
            'cover_file' => 'nullable|file|max:10240', // Opsional
            'record_file' => 'nullable|file|max:10240', // Opsional
            'attachment_file' => 'nullable|file|max:10240', // Opsional
        ]);

         // Mendapatkan ID user yang sedang login
        $userId = Auth::id();

        // Mendapatkan departemen dan perusahaan dari user yang sedang login
        $user = Auth::user();
        $departmentId = $user->dep_id;
        $companyId = $user->comp_id;

        $document_name = $request->document_name;
        $cleanedDocumentName = preg_replace('/[^A-Za-z0-9\-_]/', '', str_replace(' ', '-', $document_name));
        $maxTicket = Ticket::max('number_ticket');

        $max = $maxTicket + 1;
         // Menentukan basis path penyimpanan file menggunakan number_ticket / id
        $basePath = "uploads/tiket/$cleanedDocumentName/$max";
        // Membuat instance tiket baru
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'department_id' => $departmentId,
            'company_id' => $companyId,
            'document_name' => $validated['document_name'],
            'document_status' => 'Not Approved',
            'document_file' => $basePath,
            'document_note' => $request->input('document_note', 'New Document'),
            'tanggal' => now(),
            'description' => $validated['description'],
            // File akan diupdate setelah path diketahui
        ]);


        // Menyimpan document_file dan update tiket
        if ($request->hasFile('document_file')) {
            $documentFilePath = $request->file('document_file')->store("$basePath/document",'external');
        }

        // Menyimpan cover_file jika ada
        if ($request->hasFile('cover_file')) {
            $coverFilePath = $request->file('cover_file')->store("$basePath/cover",'external');
        }

        // Menyimpan record_file jika ada
        if ($request->hasFile('record_file')) {
            $recordFilePath = $request->file('record_file')->store("$basePath/record",'external');
        }

        // Menyimpan attachment_file jika ada
        if ($request->hasFile('attachment_file')) {
            $attachmentFilePath = $request->file('attachment_file')->store("$basePath/attachment",'external');
        }

        // Simpan update-an file ke database
        $ticket->save();

        // Redirect ke halaman yang sesuai, misalnya detail tiket atau halaman sukses
        return redirect()->route('new.document', $ticket->id)->with('success', 'Dokumen berhasil dibuat.');
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
