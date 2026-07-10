<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ajuan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    private function getDosen()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'dosen') {
            // Fallback for testing if not properly logged in
            $user = User::where('role', 'dosen')->first();
        }
        return $user;
    }

    // 1. Dashboard
    public function dashboard()
    {
        $dosen = $this->getDosen();
        
        $totalTertunda = Ajuan::where('dosen_id', $dosen->id)->where('status', 'Pending')->count();
        $totalSelesai = Ajuan::where('dosen_id', $dosen->id)->where('status', 'Selesai')->count();

        // 1. Total Mahasiswa Bimbingan
        $totalMahasiswa = User::where('role', 'mahasiswa')->where('dosen_pa_id', $dosen->id)->count();

        // 2. Sesi minggu ini
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek();
        $sesiMingguIni = Ajuan::where('dosen_id', $dosen->id)
            ->whereIn('status', ['Disetujui', 'Reschedule', 'Selesai'])
            ->whereBetween('tanggal_bimbingan', [$startOfWeek, $endOfWeek])
            ->count();

        // 3. Permintaan Tertunda
        $ajuanTertunda = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // 4. Jadwal Mendatang
        $jadwalMendatang = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->whereIn('status', ['Disetujui', 'Reschedule'])
            ->where('tanggal_bimbingan', '>=', \Carbon\Carbon::today())
            ->orderBy('tanggal_bimbingan', 'asc')
            ->orderBy('jam_bimbingan', 'asc')
            ->take(3)
            ->get();

        // 5. Catatan Sesi Terkini
        $catatanTerkini = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->where('status', 'Selesai')
            ->whereNotNull('catatan_dosen')
            ->orderBy('updated_at', 'desc')
            ->take(2)
            ->get();

        return view('dosen.dashboard', compact(
            'dosen', 'totalTertunda', 'totalSelesai', 'ajuanTertunda',
            'totalMahasiswa', 'sesiMingguIni', 'jadwalMendatang', 'catatanTerkini'
        ));
    }

    // 2. Pengajuan & Jadwal
    public function pengajuan()
    {
        $dosen = $this->getDosen();
        
        // Menampilkan yang Pending, Reschedule, atau Disetujui
        $ajuans = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->whereIn('status', ['Pending', 'Reschedule', 'Disetujui'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dosen.pengajuan', compact('dosen', 'ajuans'));
    }

    // 3. Detail Ajuan (Tinjau)
    public function showAjuan($id)
    {
        $dosen = $this->getDosen();
        
        $ajuan = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->findOrFail($id);

        return view('dosen.show_ajuan', compact('dosen', 'ajuan'));
    }

    // 4. Update Status Ajuan (Terima, Tolak, Reschedule, Selesai)
    public function updateAjuanStatus(Request $request, $id)
    {
        $dosen = $this->getDosen();
        
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak,Reschedule,Selesai',
            'catatan_dosen' => 'nullable|string',
            'tanggal_bimbingan' => 'nullable|date',
            'jam_bimbingan' => 'nullable',
            'jenis_pertemuan' => 'nullable|in:Online,Offline',
            'lokasi_atau_link' => 'nullable|string',
        ]);

        $ajuan = Ajuan::where('dosen_id', $dosen->id)->findOrFail($id);

        $dataUpdate = [
            'status' => $request->status,
            'catatan_dosen' => $request->catatan_dosen,
        ];

        if (in_array($request->status, ['Disetujui', 'Reschedule'])) {
            $dataUpdate['jenis_pertemuan'] = $request->jenis_pertemuan;
            $dataUpdate['lokasi_atau_link'] = $request->lokasi_atau_link;
        }

        if ($request->status === 'Reschedule') {
            $dataUpdate['tanggal_bimbingan'] = $request->tanggal_bimbingan;
            $dataUpdate['jam_bimbingan'] = $request->jam_bimbingan;
        }

        $ajuan->update($dataUpdate);

        $message = 'Status pengajuan berhasil diperbarui menjadi ' . $request->status . '.';
        return redirect('/dosen/pengajuan')->with('success', $message);
    }

    // 5. Eskalasi ke WD3
    public function prosesEskalasi(Request $request, $id)
    {
        $dosen = $this->getDosen();
        
        $ajuan = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->findOrFail($id);

        $request->validate([
            'catatan_eskalasi' => 'required|string',
        ]);

        $catatan = $request->catatan_eskalasi;
        $nomor_surat = 'B/' . rand(100, 999) . '/UN14.III/KM.04.02/' . date('Y');
        $tanggal = date('Y-m-d');

        // Generate PDF
        $pdf = Pdf::loadView('pdf.surat_eskalasi', [
            'ajuan' => $ajuan,
            'mahasiswa' => $ajuan->mahasiswa,
            'dosen' => $dosen,
            'catatan_eskalasi' => $catatan,
            'nomor_surat' => $nomor_surat,
            'tanggal' => $tanggal
        ]);

        $filename = 'eskalasi_' . $ajuan->id . '_' . time() . '.pdf';
        
        // Simpan PDF ke storage/app/public/eskalasi
        Storage::disk('public')->put('eskalasi/' . $filename, $pdf->output());

        // Update Ajuan
        $ajuan->update([
            'status' => 'Eskalasi WD3',
            'file_eskalasi' => 'eskalasi/' . $filename,
            // Jika Anda ingin juga menyimpan catatan eskalasi ini ke kolom catatan_dosen:
            // 'catatan_dosen' => $ajuan->catatan_dosen ? $ajuan->catatan_dosen . "\n\nCatatan Eskalasi: " . $catatan : "Catatan Eskalasi: " . $catatan
        ]);

        return redirect('/dosen/pengajuan')->with('success', 'Kasus berhasil dieskalasi ke WD3 beserta surat resmi telah terbuat.');
    }

    // 6. Riwayat Sesi
    public function riwayat()
    {
        $dosen = $this->getDosen();
        
        $ajuans = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->whereIn('status', ['Selesai', 'Ditolak'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('dosen.riwayat', compact('dosen', 'ajuans'));
    }

    // 5. Placeholder for other routes
    public function eskalasi()
    {
        $dosen = $this->getDosen();
        
        $ajuans = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->where('status', 'Eskalasi WD3')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('dosen.eskalasi', compact('dosen', 'ajuans'));
    }

    public function laporan()
    {
        $dosen = $this->getDosen();
        
        $stats = [
            'total' => Ajuan::where('dosen_id', $dosen->id)->count(),
            'pending' => Ajuan::where('dosen_id', $dosen->id)->where('status', 'Pending')->count(),
            'disetujui' => Ajuan::where('dosen_id', $dosen->id)->where('status', 'Disetujui')->count(),
            'selesai' => Ajuan::where('dosen_id', $dosen->id)->where('status', 'Selesai')->count(),
            'ditolak' => Ajuan::where('dosen_id', $dosen->id)->where('status', 'Ditolak')->count(),
            'eskalasi' => Ajuan::where('dosen_id', $dosen->id)->where('status', 'Eskalasi WD3')->count(),
            'reschedule' => Ajuan::where('dosen_id', $dosen->id)->where('status', 'Reschedule')->count(),
        ];

        $byKategori = Ajuan::where('dosen_id', $dosen->id)
            ->select('kategori_masalah', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('kategori_masalah')
            ->get();

        $ajuans = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dosen.laporan', compact('dosen', 'stats', 'byKategori', 'ajuans'));
    }

    public function eksporLaporan()
    {
        $dosen = $this->getDosen();
        
        $stats = [
            'total' => Ajuan::where('dosen_id', $dosen->id)->count(),
            'pending' => Ajuan::where('dosen_id', $dosen->id)->where('status', 'Pending')->count(),
            'selesai' => Ajuan::where('dosen_id', $dosen->id)->where('status', 'Selesai')->count(),
            'eskalasi' => Ajuan::where('dosen_id', $dosen->id)->where('status', 'Eskalasi WD3')->count(),
            'reschedule' => Ajuan::where('dosen_id', $dosen->id)->where('status', 'Reschedule')->count(),
        ];

        $ajuans = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf.laporan_dosen', compact('dosen', 'stats', 'ajuans'));
        
        return $pdf->download('Rekap_Laporan_Bimbingan_'. $dosen->nim_nip .'.pdf');
    }

    public function eksporDetailPdf($id)
    {
        $dosen = $this->getDosen();
        
        $ajuan = Ajuan::with('mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->findOrFail($id);

        $pdf = Pdf::loadView('pdf.laporan_detail', [
            'ajuan' => $ajuan,
            'mahasiswa' => $ajuan->mahasiswa,
            'dosen' => $dosen
        ]);

        return $pdf->download('Laporan_Konseling_' . $ajuan->mahasiswa->nim_nip . '_' . $ajuan->id . '.pdf');
    }

    public function bimbinganPA()
    {
        $dosen = $this->getDosen();
        
        $mahasiswas = User::where('role', 'mahasiswa')
            ->where('dosen_pa_id', $dosen->id)
            ->withCount(['ajuans' => function($query) {
                $query->where('status', 'Selesai');
            }])
            ->with(['ajuans' => function($query) {
                $query->latest()->take(1);
            }])
            ->orderBy('name')
            ->get();
            
        return view('dosen.bimbingan_pa', compact('dosen', 'mahasiswas'));
    }

    public function pengaturan()
    {
        return view('dosen.pengaturan');
    }
}
