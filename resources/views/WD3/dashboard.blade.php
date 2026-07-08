<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Wakil Dekan III - SI-BILING</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
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
            <a href="/wd3/dashboard" class="flex items-center gap-3 px-4 py-3 bg-[#EEF2FF] text-[#4f46e5] rounded-xl font-semibold text-sm transition-colors">
                <i class="fa-solid fa-border-all w-5"></i> Dashboard
            </a>
            <a href="/wd3/eskalasi" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-triangle-exclamation w-5 relative">
                    <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                    </span>
                </i>
                Daftar Eskalasi
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
            <div class="flex flex-col">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Halaman Wakil Dekan III</span>
            </div>
            <div class="flex items-center gap-5">
                <div class="w-10 h-10 bg-gray-900 rounded-full overflow-hidden ml-2 cursor-pointer shadow-sm">
                    <img src="https://ui-avatars.com/api/?name=WD&background=000&color=fff" alt="Profile" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Halaman Permasalahan Mahasiswa</h1>
                    <p class="text-gray-500 mt-2 text-sm font-medium">Daftar kasus rujukan dari Dosen PA yang memerlukan penanganan pimpinan fakultas.</p>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <i class="fa-solid fa-circle-check"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
            @endif

            <!-- Aksi Diperlukan -->
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Aksi Diperlukan</h2>
                        <p class="text-xs text-gray-500 mt-1">Permasalahan dari Dosen PA yang membutuhkan perhatian WD3</p>
                    </div>
                    <a href="/wd3/eskalasi" class="text-sm font-semibold text-[#004133] hover:underline">Lihat Semua</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse($ajuans as $ajuan)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm shrink-0">
                                    {{ strtoupper(substr($ajuan->mahasiswa->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">{{ $ajuan->mahasiswa->name }}</h3>
                                    <p class="text-[11px] text-gray-500 mt-0.5">NIM: {{ $ajuan->mahasiswa->nim_nip }} • S1 {{ $ajuan->mahasiswa->program_studi }}</p>
                                </div>
                            </div>
                            <span class="bg-red-100 text-red-700 text-[10px] font-bold px-2.5 py-1 rounded-full border border-red-200">
                                {{ $ajuan->kategori_masalah }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-4 pl-13 line-clamp-2">"{{ $ajuan->deskripsi_keluhan }}"</p>
                        
                        <div class="flex items-center gap-4 pl-13">
                            <span class="text-xs font-medium text-gray-500"><i class="fa-regular fa-user mr-1"></i> Dosen: {{ $ajuan->dosen->name }}</span>
                            <span class="text-xs font-medium text-gray-500"><i class="fa-regular fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($ajuan->updated_at)->diffForHumans() }}</span>
                            <div class="ml-auto flex gap-2">
                                @if($ajuan->file_eskalasi)
                                <a href="{{ asset('storage/' . $ajuan->file_eskalasi) }}" target="_blank" class="text-xs font-semibold text-white bg-red-600 border border-red-600 px-3 py-1.5 rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 shadow-sm">
                                    <i class="fa-solid fa-file-pdf"></i> Unduh PDF Surat
                                </a>
                                @endif
                                <button type="button" onclick="openModalTindakLanjut('{{ $ajuan->id }}', '{{ $ajuan->mahasiswa->name }}')" class="text-xs font-semibold text-white bg-[#004133] border border-[#004133] px-3 py-1.5 rounded-lg hover:bg-[#003328] transition-colors shadow-sm">
                                    Tindak Lanjut Kasus
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500 font-medium">
                        Tidak ada kasus yang dieskalasi saat ini.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>

    <!-- Modal Tindak Lanjut WD3 -->
    <div id="modalTindakLanjut" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">
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
                <p class="text-sm text-gray-600 mb-4">Silakan tentukan status penyelesaian akhir untuk kasus mahasiswa <strong id="modalNamaMahasiswa"></strong>.</p>
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Keputusan Akhir <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="Diproses Fakultas" class="peer sr-only" required>
                            <div class="border border-gray-200 rounded-lg p-3 text-center peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-700 hover:bg-gray-50 transition-all text-sm font-semibold">
                                Diproses Fakultas
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="Selesai" class="peer sr-only" required>
                            <div class="border border-gray-200 rounded-lg p-3 text-center peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 hover:bg-gray-50 transition-all text-sm font-semibold">
                                Selesai / Ditutup
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Catatan Penyelesaian <span class="text-red-500">*</span></label>
                    <textarea name="catatan_wd3" rows="3" required placeholder="Tuliskan hasil mediasi, keputusan, atau tindakan yang telah diambil oleh pihak fakultas..." class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 resize-none shadow-sm"></textarea>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModalTindakLanjut()" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-[#004133] text-white rounded-lg text-sm font-bold hover:bg-[#003328] shadow-sm flex items-center gap-2">
                        <i class="fa-solid fa-check"></i> Simpan Keputusan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .pl-13 { padding-left: 3.25rem; }
    </style>
    
    <script>
        function openModalTindakLanjut(id, nama) {
            document.getElementById('modalTindakLanjut').classList.remove('hidden');
            document.getElementById('modalNamaMahasiswa').textContent = nama;
            document.getElementById('formTindakLanjut').action = `/wd3/pengajuan/${id}/status`;
        }

        function closeModalTindakLanjut() {
            document.getElementById('modalTindakLanjut').classList.add('hidden');
        }
    </script>
</body>
</html>
