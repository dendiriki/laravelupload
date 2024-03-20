<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $notApprovedCount = Ticket::where('document_status', 'Not Approved')->count();
        $approvedCount = Ticket::where('document_status', 'Approved')->count();
        $totalCount = $notApprovedCount + $approvedCount;

        // Hitung persentase
        $notApprovedPercentage = ($totalCount > 0) ? ($notApprovedCount / $totalCount) * 100 : 0;
        $approvedPercentage = ($totalCount > 0) ? ($approvedCount / $totalCount) * 100 : 0;

        return view('dashboard', compact('notApprovedCount', 'approvedCount', 'notApprovedPercentage', 'approvedPercentage'));
    }


    public function handleNotApprovedUrl()
    {
        // Mengambil data tiket dengan status "Not Approved"
        $notApprovedTickets = Ticket::where('document_status', 'Not Approved')->get();

        // Mengirimkan data tiket ke view
        return view('not_approved_tickets', compact('notApprovedTickets'));
    }

    // Fungsi untuk menampilkan detail tiket
    public function showTicketDetail($number_ticket)
    {
        // Temukan tiket berdasarkan nomor tiket
        $ticket = Ticket::where('number_ticket', $number_ticket)->firstOrFail();

        // Tampilkan view detail tiket dan kirimkan data tiket
        return view('ticket_detail', compact('ticket'));
    }


    public function handleApprovedUrl()
    {
        // Ambil tiket yang memiliki status 'Approved'
        $approvedTickets = Ticket::where('document_status', 'Approved')->get();

        // Kirim data tiket ke view
        return view('approved_tickets', compact('approvedTickets'));
    }


    public function viewReleasedTickets()
    {
    // Ambil tiket yang sudah direlease
    $releasedTickets = Ticket::where('document_status', 'Released')->get();

    return view('released_tickets', compact('releasedTickets'));
    }


    public function viewTicketFiles($ticketNumber)
    {
        // Cari tiket berdasarkan nomor tiket
        $ticket = Ticket::where('number_ticket', $ticketNumber)->firstOrFail();

        // Inisialisasi array untuk menyimpan isi setiap folder
        $folders = [];

        // Daftar folder yang ingin Anda periksa
        $folderNames = ['attachment', 'cover', 'document', 'record'];

        // Loop melalui setiap folder
        foreach ($folderNames as $folderName) {
            // Path folder lengkap
            $folderPath = storage_path("app/public/{$ticket->document_file}/{$folderName}");

            // Ambil daftar file dari folder tiket jika folder ada
            if (file_exists($folderPath) && is_dir($folderPath)) {
                $files = array_diff(scandir($folderPath), ['.', '..']);
                $folders[$folderName] = $files;
            } else {
                $folders[$folderName] = [];
            }
        }

        // Kirimkan data file ke view
        return view('view_ticket_files', compact('ticket', 'folders'));
    }




}
