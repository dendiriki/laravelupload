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
        // Logika atau aksi yang diperlukan saat bagian kuning dari grafik di-klik
    }


    public function handleApprovedUrl()
    {
        // Logika atau aksi yang diperlukan saat bagian kuning dari grafik di-klik
    }
}
