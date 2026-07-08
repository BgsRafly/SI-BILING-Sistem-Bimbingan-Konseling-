<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Eskalasi - SI-BILING</title>
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
            <a href="/wd3/dashboard" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-border-all w-5"></i> Dashboard
            </a>
            <a href="/wd3/eskalasi" class="flex items-center gap-3 px-4 py-3 bg-[#EEF2FF] text-[#4f46e5] rounded-xl font-semibold text-sm transition-colors">
                <i class="fa-solid fa-triangle-exclamation w-5 relative">
                    @if($ajuans->count() > 0)
                    <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                    </span>
                    @endif
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
            <div class="relative w-96">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Cari eskalasi..." class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20">
            </div>
            <div class="flex items-center gap-5">
                <button class="text-gray-400 hover:text-gray-600 relative">
                    <i class="fa-regular fa-bell text-xl"></i>
                    @if($ajuans->count() > 0)
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    @endif
                </button>
                <div class="w-10 h-10 bg-gray-900 rounded-full overflow-hidden ml-2 cursor-pointer shadow-sm">
                    <img src="https://ui-avatars.com/api/?name=WD3&background=000&color=fff" alt="Profile" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Daftar Eskalasi Laporan</h1>
                    <p class="text-gray-500 mt-2 text-sm font-medium">Seluruh laporan mahasiswa yang dilimpahkan (eskalasi) ke tingkat fakultas.</p>
                </div>
            </div>

            <!-- List Eskalasi -->
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-slate-50">
                    <h2 class="text-base font-bold text-slate-800">Menunggu Keputusan / Tindak Lanjut</h2>
                    <span class="bg-red-50 text-red-600 text-xs font-bold px-3 py-1 rounded-full">{{ $ajuans->count() }} Laporan</span>
                </div>
                
                <div class="divide-y divide-gray-50">
                    @forelse($ajuans as $ajuan)
                    <div class="p-6 hover:bg-slate-50 transition-colors">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm shrink-0">
                                    {{ strtoupper(substr($ajuan->mahasiswa->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">{{ $ajuan->mahasiswa->name }}</h3>
                                    <p class="text-[11px] text-gray-500 mt-0.5">NIM: {{ $ajuan->mahasiswa->nim_nip }} • Dosen PA: {{ $ajuan->dosen->name }}</p>
                                </div>
                            </div>
                            <span class="bg-red-100 text-red-700 text-[10px] font-bold px-2.5 py-1 rounded-full border border-red-200 shadow-sm">
                                ! {{ $ajuan->kategori_masalah }}
                            </span>
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-4 pl-13 line-clamp-2">"{{ $ajuan->deskripsi_keluhan }}"</p>
                        
                        <div class="flex items-center justify-between pl-13">
                            <span class="text-xs font-medium text-gray-500"><i class="fa-regular fa-calendar mr-1"></i> Dieskalasi pada: {{ \Carbon\Carbon::parse($ajuan->updated_at)->format('d M Y') }}</span>
                            <div class="flex gap-2">
                                <a href="/wd3/pengajuan/{{ $ajuan->id }}" class="text-xs font-semibold text-gray-700 bg-white border border-gray-200 px-3 py-1.5 rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-1">
                                    Lihat Detail Kasus
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-12 text-center flex flex-col items-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 text-3xl mb-4">
                            <i class="fa-solid fa-inbox"></i>
                        </div>
                        <h3 class="text-gray-900 font-bold mb-1">Tidak Ada Eskalasi Baru</h3>
                        <p class="text-sm text-gray-500">Semua kasus yang masuk telah ditangani.</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>

    <style>
        .pl-13 { padding-left: 3.25rem; }
    </style>
</body>
</html>
