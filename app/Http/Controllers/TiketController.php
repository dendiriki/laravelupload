<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyHODMail;

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
        $documents = Document::orderBy('id','asc')->get();
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
            'document_file' => 'required|file|max:10240',
            'description' => 'required|string|min:5',
        ]);

        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();
        $user = Auth::user();
        $departmentId = $user->dep_id;
        $companyId = $user->comp_id;

        $document_name = $request->document_name;
        $cleanedDocumentName = preg_replace('/[^A-Za-z0-9\-_]/', '', str_replace(' ', '-', $document_name));
        $maxTicket = Ticket::max('number_ticket');
        $max = $maxTicket + 1;

        $basePath = "uploads/tiket/$cleanedDocumentName/$max";
        $ticket = Ticket::create([
            'user_id' => $userId,
            'department_id' => $departmentId,
            'company_id' => $companyId,
            'document_name' => $validated['document_name'],
            'document_status' => 'Not Approved',
            'document_file' => $basePath,
            'document_note' => $request->input('document_note', 'New Document'),
            'tanggal' => now(),
            'description' => $validated['description'],
        ]);

        if ($request->hasFile('document_file')) {
            $coverFilePath = $request->file('document_file')->store("$basePath");
        }

        $ticket->save();

        // Kirim email ke HOD
        $hod = User::where('dep_id', $departmentId)->where('role', 'HOD')->first();
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        if ($hod) {
            $details = [
                'title' => 'New Document',
                'body' => 'A new document has been registered and requires your approval.'
            ];

            Mail::to($hod->email)->send(new NotifyHODMail($details));

            if ($user) {
                Mail::to($user->email)->send(new NotifyHODMail($details));
            }
        }


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
