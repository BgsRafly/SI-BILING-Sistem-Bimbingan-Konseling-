<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ajuan;

class WD3Controller extends Controller
{
    private function checkRole()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user || $user->role !== 'wd3') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Wakil Dekan 3.');
        }
    }

    public function dashboard()
    {
        $this->checkRole();
        
        $ajuans = Ajuan::with(['mahasiswa', 'dosen'])
            ->where('status', 'Eskalasi WD3')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
            
        return view('WD3.dashboard', compact('ajuans'));
    }

    public function eskalasi()
    {
        $this->checkRole();
        
        $ajuans = Ajuan::with(['mahasiswa', 'dosen'])
            ->where('status', 'Eskalasi WD3')
            ->orderBy('updated_at', 'desc')
            ->get();
            
        return view('WD3.eskalasi', compact('ajuans'));
    }

    public function riwayat()
    {
        $this->checkRole();
        
        $ajuans = Ajuan::with(['mahasiswa', 'dosen'])
            ->whereIn('status', ['Diproses Fakultas', 'Selesai'])
            ->orderBy('updated_at', 'desc')
            ->get();
            
        return view('WD3.riwayat', compact('ajuans'));
    }

    public function rujukan()
    {
        $this->checkRole();
        
        // Menampilkan semua kasus yang memiliki file surat eskalasi (surat rujukan dari dosen PA)
        $ajuans = Ajuan::with(['mahasiswa', 'dosen'])
            ->whereNotNull('file_eskalasi')
            ->orderBy('updated_at', 'desc')
            ->get();
            
        return view('WD3.rujukan', compact('ajuans'));
    }

    public function show($id)
    {
        $this->checkRole();
        
        $ajuan = Ajuan::with(['mahasiswa', 'dosen'])->findOrFail($id);
            
        return view('WD3.show_ajuan', compact('ajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $this->checkRole();
        
        $request->validate([
            'status' => 'required|in:Diproses Fakultas,Selesai',
            'catatan_wd3' => 'required|string'
        ], [
            'status.required' => 'Keputusan harus dipilih.',
            'catatan_wd3.required' => 'Catatan penyelesaian wajib diisi.'
        ]);

        $ajuan = Ajuan::findOrFail($id);

        $ajuan->update([
            'status' => $request->status,
            'catatan_wd3' => $request->catatan_wd3
        ]);

        return redirect('/wd3/dashboard')->with('success', 'Status laporan berhasil diperbarui menjadi ' . $request->status . '.');
    }
}
