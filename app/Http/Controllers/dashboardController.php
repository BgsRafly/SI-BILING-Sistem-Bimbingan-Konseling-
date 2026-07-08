<?php

namespace App\Http\Controllers;
use App\Models\Pengajuan; // Model Database
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingRequests = Pengajuan::where('status', 'tertunda')->get();
        $pendingCount = $pendingRequests->count();

        $schedules = Pengajuan::where('status', 'disetujui')->get();

        return view('dosen.dashboard', compact('pendingRequests', 'pendingCount', 'schedules'));
    }
}