<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $userDepartmentId = Auth::user()->dep_id;

        $notApprovedTickets = Ticket::where('document_status', 'Not Approved')
                                    ->where('department_id', $userDepartmentId)
                                                        ->get();

        return view('approved', compact('notApprovedTickets'));
    }
    public function approveDocument($number_ticket)
    {
        // Temukan tiket berdasarkan nomor tiket
        $ticket = Ticket::where('number_ticket', $number_ticket)->firstOrFail();

        // Ubah status dokumen menjadi "Approved"
        $ticket->update(['document_status' => 'Approved']);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Document approved successfully.');
    }
}
