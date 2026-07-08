<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kasus - SI-BILING</title>
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
            <a href="/wd3/rujukan" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-envelope-open-text w-5"></i> Surat Rujukan
            </a>
            <a href="/wd3/riwayat" class="flex items-center gap-3 px-4 py-3 bg-[#EEF2FF] text-[#4f46e5] rounded-xl font-semibold text-sm transition-colors">
                <i class="fa-solid fa-file-lines w-5 relative"></i> Riwayat Kasus
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
                <input type="text" placeholder="Cari riwayat..." class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20">
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
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Riwayat Kasus Terselesaikan</h1>
                    <p class="text-gray-500 mt-2 text-sm font-medium">Log permasalahan eskalasi yang sudah diputuskan atau diselesaikan.</p>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-sm text-gray-500">
                                <th class="p-4 font-semibold rounded-tl-xl">Mahasiswa</th>
                                <th class="p-4 font-semibold">Tipe Kasus</th>
                                <th class="p-4 font-semibold">Keputusan WD3</th>
                                <th class="p-4 font-semibold">Waktu Selesai</th>
                                <th class="p-4 font-semibold text-center rounded-tr-xl">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($ajuans as $ajuan)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm shrink-0">
                                            {{ strtoupper(substr($ajuan->mahasiswa->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 text-sm">{{ $ajuan->mahasiswa->name }}</p>
                                            <p class="text-[11px] text-gray-500 mt-0.5">{{ $ajuan->mahasiswa->nim_nip }} • Dosen PA: {{ $ajuan->dosen->name ?? 'Belum ada PA' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-block px-2.5 py-1 bg-gray-100 text-gray-700 text-[10px] font-semibold rounded-md border border-gray-200 mb-1.5">{{ $ajuan->kategori_masalah }}</span>
                                </td>
                                <td class="p-4">
                                    @if($ajuan->status === 'Diproses Fakultas')
                                        <span class="inline-flex items-center gap-1.5 text-orange-700 text-[11px] font-bold bg-orange-100 px-2.5 py-1 rounded-full border border-orange-200">
                                            <i class="fa-solid fa-spinner"></i> Diproses Fakultas
                                        </span>
                                        @if($ajuan->tanggal_wd3)
                                            <div class="mt-1.5"><span class="inline-flex items-center gap-1 text-[9px] font-bold text-purple-600 bg-purple-50 px-1.5 py-0.5 rounded border border-purple-100">
                                                <i class="fa-solid fa-calendar-check"></i> Sudah menentukan jadwal
                                            </span></div>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-green-700 text-[11px] font-bold bg-green-100 px-2.5 py-1 rounded-full border border-green-200">
                                            <i class="fa-solid fa-check"></i> Selesai
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-xs font-medium text-gray-500">{{ \Carbon\Carbon::parse($ajuan->updated_at)->translatedFormat('d M Y') }}</td>
                                <td class="p-4 text-center">
                                    <a href="/wd3/pengajuan/{{ $ajuan->id }}" class="bg-white border border-gray-200 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-gray-50 transition-colors shadow-sm inline-flex items-center justify-center gap-1.5">
                                        Lihat Catatan
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500 font-medium">Belum ada riwayat kasus yang terselesaikan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
