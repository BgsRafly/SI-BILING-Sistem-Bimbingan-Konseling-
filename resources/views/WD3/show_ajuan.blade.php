<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Eskalasi - SI-BILING</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-gray-800 h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between h-full flex-shrink-0 z-20">
        <div class="p-6 flex flex-col items-center border-b border-gray-50">
            <div class="w-12 h-12 bg-[#E6ECEB] text-[#004133] rounded-full flex items-center justify-center text-xl mb-3">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <h1 class="text-lg font-bold text-[#004133] tracking-tight">SI-BILING</h1>
            <p class="text-[9px] text-gray-400 font-medium text-center mt-1">Sistem Informasi Bimbingan dan Konseling</p>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="/wd3/dashboard" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-border-all w-5"></i> Dashboard
            </a>
            <a href="/wd3/eskalasi" class="flex items-center gap-3 px-4 py-3 bg-[#EEF2FF] text-[#4f46e5] rounded-xl font-semibold text-sm transition-colors">
                <i class="fa-solid fa-triangle-exclamation w-5"></i> Daftar Eskalasi
            </a>
            <a href="/wd3/rujukan" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-envelope-open-text w-5"></i> Surat Rujukan
            </a>
            <a href="/wd3/riwayat" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-file-lines w-5"></i> Riwayat Kasus
            </a>
        </nav>
        <div class="p-4 border-t border-gray-100 space-y-1">
            <form action="/logout" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-medium text-sm transition-colors">
                    <i class="fa-solid fa-arrow-right-from-bracket w-5"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Header -->
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8 flex-shrink-0">
            <a href="/wd3/eskalasi" class="text-sm font-semibold text-gray-500 hover:text-gray-900 flex items-center gap-2 transition-colors">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <div class="flex items-center gap-5">
                <div class="w-10 h-10 bg-gray-900 rounded-full overflow-hidden ml-2 cursor-pointer shadow-sm">
                    <img src="https://ui-avatars.com/api/?name=WD3&background=000&color=fff" alt="Profile" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8 relative">
            <div class="max-w-4xl mx-auto">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Detail Eskalasi Laporan</h1>
                        <p class="text-gray-500 mt-2 text-sm font-medium">Tinjauan rujukan dari Dosen Pembimbing Akademik.</p>
                    </div>
                    @if($ajuan->status === 'Eskalasi WD3' || $ajuan->status === 'Diproses Fakultas')
                        <button type="button" onclick="openModalTindakLanjut('{{ $ajuan->id }}', '{{ $ajuan->mahasiswa->name }}')" class="bg-[#004133] text-white px-5 py-2.5 rounded-xl font-medium text-sm hover:bg-[#003328] transition-all shadow-sm flex items-center gap-2">
                            <i class="fa-solid fa-gavel"></i> Tindak Lanjut Kasus
                        </button>
                    @endif
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-50 bg-slate-50 flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-[#004133]/10 text-[#004133] flex items-center justify-center font-bold text-xl shrink-0">
                                {{ strtoupper(substr($ajuan->mahasiswa->name, 0, 2)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">{{ $ajuan->mahasiswa->name }}</h3>
                                <p class="text-sm text-gray-500 mt-0.5">NIM: {{ $ajuan->mahasiswa->nim_nip }} • S1 {{ $ajuan->mahasiswa->program_studi }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Status Terkini</span>
                            @if($ajuan->status === 'Eskalasi WD3')
                                <span class="bg-red-50 text-red-600 text-xs font-bold px-3 py-1.5 rounded-md border border-red-100">Menunggu WD3</span>
                            @elseif($ajuan->status === 'Diproses Fakultas')
                                <span class="bg-orange-50 text-orange-600 text-xs font-bold px-3 py-1.5 rounded-md border border-orange-100">Diproses Fakultas</span>
                                @if($ajuan->tanggal_wd3)
                                    <div class="mt-2 flex items-center justify-end gap-1 text-[10px] font-bold text-purple-600 bg-purple-50 px-2 py-1 rounded border border-purple-100 w-max ml-auto">
                                        <i class="fa-solid fa-calendar-check"></i> Sudah menentukan jadwal
                                    </div>
                                @endif
                            @else
                                <span class="bg-green-50 text-green-600 text-xs font-bold px-3 py-1.5 rounded-md border border-green-100">{{ $ajuan->status }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-8 space-y-8">
                        <!-- Topik & Skala -->
                        <div class="grid grid-cols-2 gap-8 bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Topik Permasalahan</p>
                                <p class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-[#004133]"></span> {{ $ajuan->kategori_masalah }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Dosen Rujukan (PA)</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $ajuan->dosen->name }}</p>
                            </div>
                        </div>

                        <!-- Jadwal Pertemuan WD3 -->
                        @if($ajuan->tanggal_wd3)
                        <div class="bg-purple-50 p-6 rounded-xl border border-purple-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-8 h-8 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </div>
                                <p class="text-sm font-bold text-purple-900">Jadwal Pertemuan Mahasiswa dengan WD3</p>
                            </div>
                            <div class="grid grid-cols-2 gap-8">
                                <div>
                                    <p class="text-xs font-bold text-purple-600 uppercase tracking-wider mb-1">Tanggal</p>
                                    <p class="text-sm font-semibold text-purple-900">{{ \Carbon\Carbon::parse($ajuan->tanggal_wd3)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-purple-600 uppercase tracking-wider mb-1">Waktu</p>
                                    <p class="text-sm font-semibold text-purple-900">{{ $ajuan->waktu_wd3 ? date('H:i', strtotime($ajuan->waktu_wd3)) . ' WITA' : '-' }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Deskripsi -->
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Deskripsi Keluhan Mahasiswa</p>
                            <p class="text-sm text-gray-700 leading-relaxed bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                                "{{ $ajuan->deskripsi_keluhan }}"
                            </p>
                        </div>
                        
                        <!-- Dokumen Surat -->
                        @if($ajuan->file_eskalasi)
                        <div class="border border-red-100 bg-red-50 p-6 rounded-xl">
                            <p class="text-xs font-bold text-red-800 uppercase tracking-wider mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-file-pdf"></i> Dokumen Resmi Eskalasi
                            </p>
                            <p class="text-sm text-red-700 mb-4">Kasus ini telah dirujuk secara resmi melalui surat pengantar dari Dosen PA yang bersangkutan.</p>
                            <a href="{{ asset('storage/' . $ajuan->file_eskalasi) }}" target="_blank" class="inline-flex items-center gap-2 bg-white text-red-700 border border-red-200 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-red-100 transition-colors">
                                Unduh Surat Eskalasi PDF
                            </a>
                        </div>
                        @endif

                        <!-- Catatan Pimpinan -->
                        @if($ajuan->catatan_wd3)
                        <div>
                            <p class="text-xs font-bold text-[#004133] uppercase tracking-wider mb-3">Catatan / Keputusan Fakultas</p>
                            <p class="text-sm text-gray-700 leading-relaxed bg-emerald-50 border border-emerald-100 p-5 rounded-xl shadow-sm">
                                "{{ $ajuan->catatan_wd3 }}"
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tindak Lanjut WD3 -->
    <div id="modalTindakLanjut" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-[#F8FAFC]">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-gavel text-[#004133]"></i> Keputusan Tindak Lanjut
                </h3>
                <button onclick="closeModalTindakLanjut()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form id="formTindakLanjut" method="POST" class="p-6">
                @csrf
                <p class="text-sm text-gray-600 mb-4">Tentukan status penyelesaian akhir untuk kasus <strong id="modalNamaMahasiswa"></strong>.</p>
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Keputusan Akhir <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="Diproses Fakultas" class="peer sr-only" required onchange="toggleJadwalWD3(this)">
                            <div class="border border-gray-200 rounded-lg p-3 text-center peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-700 hover:bg-gray-50 transition-all text-sm font-semibold">
                                Diproses Fakultas
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="Selesai" class="peer sr-only" required onchange="toggleJadwalWD3(this)">
                            <div class="border border-gray-200 rounded-lg p-3 text-center peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 hover:bg-gray-50 transition-all text-sm font-semibold">
                                Selesai / Ditutup
                            </div>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4" id="jadwalWd3Container" style="display: none;">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal Pertemuan</label>
                        <input type="date" name="tanggal_wd3" class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Waktu Pertemuan</label>
                        <input type="time" name="waktu_wd3" class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 shadow-sm">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Catatan Penyelesaian <span class="text-red-500">*</span></label>
                    <textarea name="catatan_wd3" rows="4" required placeholder="Tuliskan hasil mediasi, keputusan, atau tindakan konkrit yang telah diambil..." class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 resize-none shadow-sm"></textarea>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModalTindakLanjut()" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-[#004133] text-white rounded-lg text-sm font-bold hover:bg-[#003328] shadow-sm flex items-center gap-2">
                        <i class="fa-solid fa-check"></i> Simpan Keputusan
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function openModalTindakLanjut(id, nama) {
            document.getElementById('modalTindakLanjut').classList.remove('hidden');
            document.getElementById('modalNamaMahasiswa').textContent = nama;
            document.getElementById('formTindakLanjut').action = `/wd3/pengajuan/${id}/status`;
        }

        function closeModalTindakLanjut() {
            document.getElementById('modalTindakLanjut').classList.add('hidden');
        }

        function toggleJadwalWD3(element) {
            if(element.value === 'Diproses Fakultas') {
                document.getElementById('jadwalWd3Container').style.display = 'grid';
            } else {
                document.getElementById('jadwalWd3Container').style.display = 'none';
            }
        }
    </script>
</body>
</html>
