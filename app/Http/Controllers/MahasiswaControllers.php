public function dashboard() {
    $user = Auth::user();
    $riwayat_konseling = Pengajuan::where('mahasiswa_id', $user->id)->latest()->take(5)->get(); // Menarik riwayat dari database
    
    return view('mahasiswa.dashboard', compact('user', 'riwayat_konseling'));
}