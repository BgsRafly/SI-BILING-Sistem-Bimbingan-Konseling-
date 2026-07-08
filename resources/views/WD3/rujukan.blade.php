<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Rujukan - SI-BILING</title>
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
            <a href="/wd3/eskalasi" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-triangle-exclamation w-5"></i>
                Daftar Eskalasi
            </a>
            <a href="/wd3/rujukan" class="flex items-center gap-3 px-4 py-3 bg-[#EEF2FF] text-[#4f46e5] rounded-xl font-semibold text-sm transition-colors">
                <i class="fa-solid fa-envelope-open-text w-5 relative"></i> Surat Rujukan
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
                <input type="text" placeholder="Cari arsip surat..." class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20">
            </div>
            <div class="flex items-center gap-5">
                <div class="w-10 h-10 bg-gray-900 rounded-full overflow-hidden ml-2 cursor-pointer shadow-sm">
                    <img src="https://ui-avatars.com/api/?name=WD3&background=000&color=fff" alt="Profile" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Arsip Surat Rujukan</h1>
                    <p class="text-gray-500 mt-2 text-sm font-medium">Kumpulan dokumen PDF surat rujukan resmi yang diterbitkan oleh Dosen PA.</p>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($ajuans as $ajuan)
                    <div class="border border-gray-200 rounded-xl p-5 hover:shadow-md transition-shadow flex flex-col">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center text-2xl">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2.5 py-1 rounded-md">
                                {{ \Carbon\Carbon::parse($ajuan->updated_at)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        <h3 class="font-bold text-gray-900 text-base mb-1 truncate">Surat Eskalasi - {{ $ajuan->mahasiswa?->name ?? 'Mahasiswa tidak ditemukan' }}</h3>
                        <p class="text-xs text-gray-500 mb-4 truncate">Dosen Pengirim: {{ $ajuan->dosen?->name ?? 'Dosen tidak ditemukan' }}</p>
                        
                        <div class="mt-auto flex gap-2">
                            <a href="{{ asset('storage/' . $ajuan->file_eskalasi) }}" target="_blank" class="flex-1 bg-red-600 hover:bg-red-700 text-white text-center py-2 rounded-lg text-sm font-semibold transition-colors flex items-center justify-center gap-2">
                                <i class="fa-solid fa-download"></i> Unduh PDF
                            </a>
                            <a href="/wd3/pengajuan/{{ $ajuan->id }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-center py-2 px-4 rounded-lg text-sm font-semibold transition-colors">
                                Detail
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full p-8 text-center text-gray-500 font-medium">
                        <i class="fa-solid fa-folder-open text-4xl mb-3 text-gray-300"></i>
                        <p>Belum ada arsip surat rujukan eskalasi yang diterbitkan.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

</body>
</html>
