<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\NotifyHODMail;
use App\Models\Ticket;
use App\Models\User;
use Exception;

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
        try {
            // Temukan tiket berdasarkan nomor tiket
            $ticket = Ticket::where('number_ticket', $number_ticket)->firstOrFail();

            // Cari HOD berdasarkan departemen tiket
            $hod = User::where('dep_id', $ticket->department_id)->where('role', 'HOD')->firstOrFail();

            // Ambil nama departemen HOD
            $departmentName = $hod->department->name;

            // Detail email
            $details = [
                'title' => 'Document Status Updated',
                'body' => "The status of the document with ticket number {$ticket->number_ticket} has been updated by the HOD of the {$departmentName} department."
            ];

            // Kirim email kepada HOD
            Mail::to($hod->email)->send(new NotifyHODMail($details));

            // Mengambil semua user dengan role 'admin'
            $admins = User::where('role', 'admin')->get();

            // Mengirim email kepada setiap admin
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new NotifyHODMail($details));
            }

            // Update status dokumen setelah email berhasil dikirim
            if ($ticket->document_note === 'revision document') {
                // Jika isi note_document adalah "revision document", beri status "Approved"
                $ticket->update(['document_status' => 'Approved']);
                $message = 'Document approved successfully.';
            } elseif ($ticket->document_note === 'new document') {
                // Jika isi note_document adalah "new document", beri status "Not Complete"
                $ticket->update(['document_status' => 'Not Complete']);
                $message = 'Document approved successfully.';
            } else {
                // Untuk kondisi lainnya, mungkin Anda ingin menangani secara khusus atau biarkan statusnya tidak berubah
                return redirect()->back()->with('error', 'Document status cannot be updated due to an unrecognized note.');
            }

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', $message);
        } catch (Exception $e) {
            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function showRejectForm($ticketNumber)
    {
        $ticket = Ticket::findOrFail($ticketNumber);
        return view('reject_ticket', compact('ticket'));
    }

    public function rejectTicket(Request $request, $ticketNumber)
    {
        // Validasi input
        $request->validate([
            'reason' => 'required|string|min:5', // Pastikan alasan penolakan diisi dengan minimal 5 karakter
            'document_file' => 'file|max:10240', // Max 10 MB
            // Tambahkan validasi untuk file lain jika perlu
        ]);

        $ticket = Ticket::findOrFail($ticketNumber);
        $name_document = $ticket->document_name; // Menggunakan nama dokumen tiket untuk nama folder

        $folderpath = "uploads/rejected/$name_document"; // Menyimpan di folder 'rejected' untuk membedakan


        // Update status dokumen dan alasan penolakan
        $ticket->document_status = 'Rejected';
       // Update status dokumen dan alasan penolakan
        $ticket->massage = $request->reason; // Menambahkan alasan penolakan ke deskripsi dengan spasi
        $ticket->save();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('approval.index')->with('success', 'Ticket has been rejected and files have been saved.');
    }


}
