<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SI-BILING</title>
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
            <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 bg-[#EEF2FF] text-[#4f46e5] rounded-xl font-semibold text-sm transition-colors">
                <i class="fa-solid fa-border-all w-5"></i> Dashboard
            </a>
            <a href="/admin/pengguna" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-users w-5"></i> Manajemen Pengguna
            </a>
            <a href="/admin/laporan" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-file-contract w-5"></i> Manajemen Laporan
            </a>
            <a href="/admin/kategori" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-tags w-5"></i> Kategori Masalah
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
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Halaman Superadmin</span>
            </div>
            <div class="flex items-center gap-5">
                <div class="w-10 h-10 bg-[#004133] rounded-full overflow-hidden ml-2 cursor-pointer shadow-sm flex items-center justify-center text-white font-bold">
                    AD
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Ikhtisar Sistem</h1>
                    <p class="text-gray-500 mt-2 text-sm font-medium">Ringkasan aktivitas dan metrik penggunaan SI-BILING.</p>
                </div>
                <div class="flex gap-3">
                    <a href="/admin/pengguna" class="bg-[#004133] text-white px-5 py-2.5 rounded-xl font-medium text-sm hover:bg-[#003328] transition-all shadow-sm flex items-center gap-2">
                        <i class="fa-solid fa-users"></i> Kelola Dosen
                    </a>
                </div>
            </div>

            <!-- Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Pengguna -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <span class="bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-1 rounded-md border border-blue-100">{{ $totalMahasiswa }} Mahasiswa, {{ $totalDosen }} Dosen</span>
                    </div>
                    <div>
                        <p class="text-gray-500 font-medium text-sm mb-1">Total Pengguna Aktif</p>
                        <h2 class="text-4xl font-extrabold text-gray-900">{{ $totalMahasiswa + $totalDosen }}</h2>
                    </div>
                </div>
                
                <!-- Laporan Masuk -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                            <i class="fa-solid fa-file-contract"></i>
                        </div>
                        <span class="bg-indigo-50 text-indigo-600 text-[10px] font-bold px-2 py-1 rounded-md border border-indigo-100">+24 minggu ini</span>
                    </div>
                    <div>
                        <p class="text-gray-500 font-medium text-sm mb-1">Total Laporan Konseling</p>
                        <h2 class="text-4xl font-extrabold text-gray-900">{{ $totalLaporan }}</h2>
                    </div>
                </div>

                <!-- Kategori Masalah -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-xl">
                            <i class="fa-solid fa-tags"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-gray-500 font-medium text-sm mb-1">Kategori Masalah Terdaftar</p>
                        <h2 class="text-4xl font-extrabold text-gray-900">{{ $totalKategori }}</h2>
                    </div>
                </div>
            </div>

            <!-- Activity Log -->
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Log Aktivitas Terbaru</h2>
                        <p class="text-xs text-gray-500 mt-1">Rekam jejak tindakan penting di dalam sistem.</p>
                    </div>
                </div>
                
                <div class="divide-y divide-gray-50">
                    @forelse($recentActivities as $activity)
                    <div class="p-5 hover:bg-gray-50 transition-colors flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-{{ $activity['color'] }}-50 text-{{ $activity['color'] }}-600 flex items-center justify-center shrink-0">
                            <i class="fa-solid {{ $activity['icon'] }} text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">{{ $activity['title'] }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $activity['description'] }}</p>
                        </div>
                        <span class="text-xs font-medium text-gray-400">{{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}</span>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500 font-medium">
                        Belum ada aktivitas tercatat di dalam sistem.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>

</body>
</html>
