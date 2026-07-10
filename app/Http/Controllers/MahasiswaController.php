<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ajuan;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    // 1. Dashboard
    public function dashboard()
    {
        $user = Auth::user();
        
        // Asumsikan Auth belum berjalan penuh untuk sekarang kita pakai dummy auth dengan id 1 (atau yang ada)
        // Nanti pada saat login sesungguhnya berjalan, Auth::user() akan ada nilainya.
        // Untuk sekarang, kita fallback ke user pertama ber-role mahasiswa jika Auth::user() null untuk keperluan testing.
        if (!$user) {
            $user = \App\Models\User::where('role', 'mahasiswa')->first();
        }

        if (!$user) {
            return redirect('/login')->withErrors(['Tolong login terlebih dahulu.']);
        }

        $totalSelesai = Ajuan::where('mahasiswa_id', $user->id)->where('status', 'Selesai')->count();
        $totalProses = Ajuan::where('mahasiswa_id', $user->id)->whereIn('status', ['Pending', 'Disetujui', 'Reschedule'])->count();
        $totalDitolak = Ajuan::where('mahasiswa_id', $user->id)->where('status', 'Ditolak')->count();
        
        $ajuans = Ajuan::where('mahasiswa_id', $user->id)->orderBy('created_at', 'desc')->take(3)->get();

        return view('mahasiswa.dashboard', compact('user', 'totalSelesai', 'totalProses', 'totalDitolak', 'ajuans'));
    }

    // 2. Menampilkan form Ajuan Baru
    public function createAjuan()
    {
        $user = Auth::user() ?? \App\Models\User::where('role', 'mahasiswa')->first();
        
        // Cek apakah mahasiswa masih memiliki ajuan aktif
        $activeAjuan = Ajuan::where('mahasiswa_id', $user->id)
            ->whereNotIn('status', ['Selesai', 'Ditolak'])
            ->first();

        if ($activeAjuan) {
            return redirect('/mahasiswa/riwayat')->withErrors(['Anda masih memiliki pengajuan konseling yang sedang aktif. Anda baru bisa mengajukan kembali setelah sesi sebelumnya berstatus Selesai.']);
        }

        $kategoris = \App\Models\Kategori::orderBy('nama_kategori')->get();

        return view('mahasiswa.ajuan_baru', compact('user', 'kategoris'));
    }

    // 3. Menyimpan Ajuan Baru
    public function storeAjuan(Request $request)
    {
        $request->validate([
            'kategori_masalah' => 'required|string',
            'skala_beban_pikiran' => 'required|integer|min:1|max:5',
            'skala_urgensi' => 'required|integer|min:1|max:5',
            'deskripsi_keluhan' => 'required|string',
            'harapan_mahasiswa' => 'required|string',
            'tanggal_bimbingan' => 'required|date',
            'jam_bimbingan' => 'required',
            'jenis_pertemuan' => 'required|in:Online,Offline',
        ], [
            'kategori_masalah.required' => 'Kategori masalah wajib dipilih.',
            'deskripsi_keluhan.required' => 'Deskripsi keluhan tidak boleh kosong.',
            'harapan_mahasiswa.required' => 'Harapan bimbingan tidak boleh kosong.',
            'tanggal_bimbingan.required' => 'Tanggal bimbingan wajib diisi.',
            'jam_bimbingan.required' => 'Jam bimbingan wajib dipilih.',
        ]);

        $user = Auth::user() ?? \App\Models\User::where('role', 'mahasiswa')->first();

        // Cek kembali di sisi server untuk mencegah bypass form
        $activeAjuan = Ajuan::where('mahasiswa_id', $user->id)
            ->whereNotIn('status', ['Selesai', 'Ditolak'])
            ->first();

        if ($activeAjuan) {
            return redirect('/mahasiswa/riwayat')->withErrors(['Anda masih memiliki pengajuan konseling yang sedang aktif.']);
        }

        Ajuan::create([
            'mahasiswa_id' => $user->id,
            'dosen_id' => $user->dosen_pa_id,
            'kategori_masalah' => $request->kategori_masalah,
            'skala_beban_pikiran' => $request->skala_beban_pikiran,
            'skala_urgensi' => $request->skala_urgensi,
            'deskripsi_keluhan' => $request->deskripsi_keluhan,
            'harapan_mahasiswa' => $request->harapan_mahasiswa,
            'tanggal_bimbingan' => $request->tanggal_bimbingan,
            'jam_bimbingan' => $request->jam_bimbingan,
            'jenis_pertemuan' => $request->jenis_pertemuan,
            'lokasi_atau_link' => $request->lokasi_atau_link,
            'status' => 'Pending',
        ]);

        return redirect('/mahasiswa/riwayat')->with('success', 'Pengajuan konseling berhasil dikirim dan sedang menunggu persetujuan Dosen PA.');
    }

    // 4. Detail Ajuan
    public function showAjuan($id)
    {
        $user = Auth::user() ?? \App\Models\User::where('role', 'mahasiswa')->first();
        
        $ajuan = Ajuan::with('dosen')
            ->where('mahasiswa_id', $user->id)
            ->findOrFail($id);

        return view('mahasiswa.show_ajuan', compact('user', 'ajuan'));
    }

    // 4b. Batalkan Ajuan
    public function batalAjuan($id)
    {
        $user = Auth::user() ?? \App\Models\User::where('role', 'mahasiswa')->first();
        
        $ajuan = Ajuan::where('mahasiswa_id', $user->id)->findOrFail($id);

        if ($ajuan->status !== 'Pending') {
            return redirect('/mahasiswa/riwayat')->withErrors(['Pengajuan tidak dapat dibatalkan karena sudah diproses.']);
        }

        // Soft delete / delete permanent atau update status? Biasanya dihapus jika batal, atau status 'Dibatalkan'.
        // Jika kita gunakan 'Dibatalkan' kita harus ubah ENUM. Lebih aman delete saja.
        $ajuan->delete();

        return redirect('/mahasiswa/riwayat')->with('success', 'Pengajuan konseling berhasil dibatalkan.');
    }

    // 5. Riwayat Konseling
    public function riwayat()
    {
        $user = Auth::user() ?? \App\Models\User::where('role', 'mahasiswa')->first();
        
        $ajuans = Ajuan::where('mahasiswa_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('mahasiswa.riwayat', compact('user', 'ajuans'));
    }

    // 5. Profil Mahasiswa
    public function profil()
    {
        $user = Auth::user() ?? \App\Models\User::where('role', 'mahasiswa')->with('dosenPA')->first();
        return view('mahasiswa.profil', compact('user'));
    }

    // 6. Update Profil (No WhatsApp)
    public function updateProfil(Request $request)
    {
        $request->validate([
            'no_whatsapp' => 'required|string|regex:/^[0-9]+$/|max:15',
        ], [
            'no_whatsapp.regex' => 'No WhatsApp hanya boleh berisi angka.',
        ]);

        $user = Auth::user() ?? \App\Models\User::where('role', 'mahasiswa')->first();
        
        $user->update([
            'no_whatsapp' => $request->no_whatsapp,
        ]);

        return redirect('/mahasiswa/profil')->with('success', 'Nomor WhatsApp berhasil diperbarui.');
    }
}
