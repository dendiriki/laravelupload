<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use App\Models\Dep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah berdasarkan document_note
        $newDocumentCount = Ticket::where('document_note', 'new document')->where('document_status', '!=', 'Rejected')->count();
        $revisionDocumentCount = Ticket::where('document_note', 'revision document')->where('document_status', '!=', 'Rejected')->count();

        // Jumlah total tiket yang statusnya bukan Rejected
        $totalCount = Ticket::where('document_status', '!=', 'Rejected')->count(); // Total semua tiket, tidak termasuk Rejected

        // Jumlah berdasarkan status, tidak termasuk Rejected
        $notApprovedCount = Ticket::where('document_status', 'Not Approved')->where('document_status', '!=', 'Rejected')->count();
        $approvedCount = Ticket::whereIn('document_status', ['Approved', 'Not Complete'])->where('document_status', '!=', 'Rejected')->count();
        $releasedCount = Ticket::where('document_status', 'Released')->where('document_status', '!=', 'Rejected')->count();

        // Hitung persentase untuk grafik lingkaran berdasarkan document_note
        // Perhatikan bahwa total count sudah tidak termasuk Rejected, jadi tidak perlu menambahkan pengecekan lagi
        $newDocumentPercentage = ($totalCount > 0) ? ($newDocumentCount / $totalCount) * 100 : 0;
        $revisionDocumentPercentage = ($totalCount > 0) ? ($revisionDocumentCount / $totalCount) * 100 : 0;

        return view('dashboard', compact(
            'newDocumentCount', 'revisionDocumentCount',
            'newDocumentPercentage', 'revisionDocumentPercentage',
            'totalCount', 'notApprovedCount', 'approvedCount', 'releasedCount'
        ));
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
        // Mengambil data tiket dengan status "Not Complete" dan "Approved"
        $approvedTickets = Ticket::whereIn('document_status', ['Not Complete', 'Approved'])->get();

        // Mengirimkan data tiket ke view
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

        // Path folder lengkap berdasarkan document_file
        $folderPath = Storage::disk('external')->path($ticket->document_file);

        // Inisialisasi array untuk menyimpan daftar file
        $files = [];

        // Periksa apakah folder ada dan ambil daftar file
        if (file_exists($folderPath) && is_dir($folderPath)) {
            $files = array_diff(scandir($folderPath), ['.', '..']);
        }

        // Kirimkan data file ke view
        return view('view_ticket_files', compact('ticket', 'files'));
    }




    // Tambahkan dalam DashboardController

    public function editDescription($ticketNumber)
    {
        $ticket = Ticket::findOrFail($ticketNumber);
        return view('edit_description', compact('ticket'));
    }

    public function updateDescription(Request $request, $ticketNumber)
    {
        $request->validate([
            'description' => 'required|string', // Pastikan inputan 'description' diisi
        ]);

        $ticket = Ticket::findOrFail($ticketNumber);

        // Menambahkan inputan baru ke description yang sudah ada
        $ticket->document_number = $request->description; // Menambahkan spasi sebelum inputan baru

        // Jika status dokumen adalah 'Not Complete', ubah menjadi 'Approved'
        if ($ticket->document_status === 'Not Complete') {
            $ticket->document_status = 'Approved';
        }

        $ticket->save();

        return redirect()->route('approved.url')->with('success', 'Ticket updated successfully!');
    }

    public function showNewDocumentForm()
    {
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();

        // Mengambil tiket berdasarkan user_id
        $userTickets = Ticket::where('user_id', $userId)->get();

        return view('new_document', compact('userTickets'));
    }

    public function departmentChart()
    {
        $totalTickets = Ticket::count();
        $totalDepartments = Dep::count(); // Add this line to get the total number of departments
        $ticketsDataByDepartment = $this->getTicketsDataByDepartment();

        return view('department_chart', compact('ticketsDataByDepartment', 'totalTickets', 'totalDepartments'));
    }




    private function getTicketsDataByDepartment()
    {
        // Mengelompokkan tiket berdasarkan department_id dan menghitung jumlahnya
        $ticketCounts = Ticket::select('department_id', DB::raw('count(*) as total'))
                              ->groupBy('department_id')
                              ->get();

        // Membuat array asosiatif dari hasil query dengan menambahkan nama departemen
        $data = [];
        foreach ($ticketCounts as $count) {
            $departmentName = $count->department ? $count->department->short : 'Unknown';
            $data[$departmentName] = $count->total;
        }

        return $data;
    }

    public function dashboardticket()
    {
        $tickets = Ticket::with('user')->get(); // 'user' adalah nama relasi di model Ticket ke model User

        return view('dashboard.ticket', compact('tickets'));
    }

    public function showDepartmentsWithTickets()
    {
        $departments = Dep::with('tickets')->get();

        // Pengolahan data untuk menentukan departemen mana yang memiliki tiket dan yang tidak
        $departmentsWithTickets = [];
        $departmentsWithoutTickets = [];

        foreach ($departments as $department) {
            if ($department->tickets->isEmpty()) {
                $departmentsWithoutTickets[] = $department;
            } else {
                $departmentsWithTickets[] = $department;
            }
        }

        return view('dashboard.departement', compact('departmentsWithTickets', 'departmentsWithoutTickets'));
    }

}
