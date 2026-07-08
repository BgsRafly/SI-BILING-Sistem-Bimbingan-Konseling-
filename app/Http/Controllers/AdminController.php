<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Models\Ajuan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function checkRole()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Akses tidak sah. Anda bukan admin.');
        }
    }

    // 1. Dashboard Admin
    public function dashboard()
    {
        $this->checkRole();
        
        $totalDosen = User::where('role', 'dosen')->count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalLaporan = Ajuan::count();
        $totalKategori = Kategori::count();
        
        // Fetch real activities
        $activities = collect([]);
        
        // Recent Dosen
        $recentDosens = User::where('role', 'dosen')->latest()->take(5)->get();
        foreach ($recentDosens as $dosen) {
            $activities->push([
                'type' => 'dosen',
                'title' => 'Admin menambahkan akun Dosen baru',
                'description' => 'Nama: ' . $dosen->name . ', NIP: ' . $dosen->nim_nip,
                'icon' => 'fa-user-plus',
                'color' => 'blue',
                'created_at' => $dosen->created_at,
            ]);
        }
        
        // Recent Laporan
        $recentAjuans = Ajuan::with(['mahasiswa', 'dosen'])->latest()->take(5)->get();
        foreach ($recentAjuans as $ajuan) {
            $activities->push([
                'type' => 'laporan',
                'title' => 'Laporan Konseling Baru Terunggah',
                'description' => 'Oleh Mahasiswa: ' . ($ajuan->mahasiswa->name ?? 'Anonim') . ' • PA: ' . ($ajuan->dosen->name ?? 'Anonim'),
                'icon' => 'fa-file-arrow-up',
                'color' => 'indigo',
                'created_at' => $ajuan->created_at,
            ]);
        }
        
        // Recent Kategori
        $recentKategoris = Kategori::latest()->take(5)->get();
        foreach ($recentKategoris as $kategori) {
            $activities->push([
                'type' => 'kategori',
                'title' => 'Pembaruan Kategori Masalah',
                'description' => 'Kategori baru: "' . $kategori->nama_kategori . '"',
                'icon' => 'fa-tag',
                'color' => 'orange',
                'created_at' => $kategori->created_at,
            ]);
        }
        
        // Sort all by created_at desc and take top 5
        $recentActivities = $activities->sortByDesc('created_at')->take(5)->values();
        
        return view('Admin.dashboard', compact('totalDosen', 'totalMahasiswa', 'totalLaporan', 'totalKategori', 'recentActivities'));
    }

    // ==========================================
    // 2. MANAJEMEN PENGGUNA (DOSEN)
    // ==========================================

    public function pengguna()
    {
        $this->checkRole();
        
        $dosens = User::where('role', 'dosen')->orderBy('name')->get();
        return view('Admin.pengguna', compact('dosens'));
    }

    public function storeDosen(Request $request)
    {
        $this->checkRole();
        
        $request->validate([
            'nip' => 'required|unique:users,nim_nip',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'program_studi' => 'required|string',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'program_studi.required' => 'Program studi wajib dipilih.',
        ]);

        User::create([
            'nim_nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'dosen',
            'program_studi' => $request->program_studi,
            'password' => Hash::make('DosenUnud123!'),
        ]);

        return redirect('/admin/pengguna')->with('success', 'Akun dosen berhasil ditambahkan.');
    }

    public function updateDosen(Request $request, $id)
    {
        $this->checkRole();
        
        $dosen = User::where('role', 'dosen')->findOrFail($id);
        
        $request->validate([
            'nip' => 'required|unique:users,nim_nip,' . $dosen->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $dosen->id,
            'program_studi' => 'required|string',
        ]);

        $dosen->update([
            'nim_nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'program_studi' => $request->program_studi,
        ]);

        return redirect('/admin/pengguna')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroyDosen($id)
    {
        $this->checkRole();
        
        $dosen = User::where('role', 'dosen')->findOrFail($id);
        // Soft delete
        $dosen->delete();

        return redirect('/admin/pengguna')->with('success', 'Akun dosen berhasil dihapus dari sistem (Soft Delete).');
    }

    // ==========================================
    // 3. MANAJEMEN KATEGORI (MASTER DATA)
    // ==========================================

    public function kategori()
    {
        $this->checkRole();
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('Admin.kategori', compact('kategoris'));
    }

    public function storeKategori(Request $request)
    {
        $this->checkRole();
        
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/admin/kategori')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function updateKategori(Request $request, $id)
    {
        $this->checkRole();
        
        $kategori = Kategori::findOrFail($id);
        
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->id,
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyKategori($id)
    {
        $this->checkRole();
        
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil dihapus.');
    }

    // ==========================================
    // 4. MANAJEMEN LAPORAN GLOBAL
    // ==========================================

    public function laporan()
    {
        $this->checkRole();
        
        $ajuans = Ajuan::with(['mahasiswa', 'dosen'])
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return view('Admin.laporan', compact('ajuans'));
    }

    public function updateStatusLaporan(Request $request, $id)
    {
        $this->checkRole();
        
        $ajuan = Ajuan::findOrFail($id);
        
        $request->validate([
            'status' => 'required|string',
        ]);

        $ajuan->update([
            'status' => $request->status,
        ]);

        return redirect('/admin/laporan')->with('success', 'Status laporan berhasil diubah secara paksa oleh Admin.');
    }
}
