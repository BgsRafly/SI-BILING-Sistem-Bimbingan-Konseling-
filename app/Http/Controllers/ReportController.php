<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    // 1. Menampilkan seluruh laporan untuk halaman Admin (Read)
    public function indexAdmin()
    {
        // Menarik semua data reports berserta data mahasiswa dan dosen yang berelasi
        $reports = Report::with(['mahasiswa', 'dosen'])->orderBy('created_at', 'desc')->get();
        
        return view('Admin.laporan', compact('reports'));
    }

    // 2. Fungsi pendukung untuk mengubah status laporan (Update)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,on-progress,resolved'
        ]);

        $report = Report::findOrFail($id);
        $report->status = $request->status;
        $report->save();

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}
