<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - SI-BILING</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] flex h-screen overflow-hidden text-slate-800">

    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col h-full z-10 shrink-0">
        <div class="py-8 flex flex-col items-center border-b border-slate-50">
            <div class="w-16 h-16 bg-[#D1E0FF] rounded-full flex items-center justify-center mb-4">
                <i class="fa-solid fa-graduation-cap text-[#004133] text-2xl"></i>
            </div>
            <h1 class="text-xl font-bold text-[#004133] tracking-wider uppercase">SI-BILING</h1>
            <p class="text-[10px] text-slate-500 text-center mt-1 px-4 leading-relaxed">
                Sistem Informasi Bimbingan dan Konseling
            </p>
        </div>

        <div class="flex-1 overflow-y-auto py-6">
            <div class="px-6 mb-2">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Menu Utama</p>
            </div>
            <nav class="space-y-1 mb-6 px-3">
                <a href="/mahasiswa/dashboard" class="flex items-center px-3 py-2.5 {{ request()->is('mahasiswa/dashboard') ? 'bg-[#EEF2FF] text-[#004133] font-semibold' : 'text-slate-600 hover:bg-slate-50 font-medium' }} rounded-lg text-sm transition-colors">
                    <i class="fa-solid fa-border-all w-6 text-center mr-2"></i> Dashboard
                </a>
                <a href="/mahasiswa/profil" class="flex items-center px-3 py-2.5 {{ request()->is('mahasiswa/profil') ? 'bg-[#EEF2FF] text-[#004133] font-semibold' : 'text-slate-600 hover:bg-slate-50 font-medium' }} rounded-lg text-sm transition-colors">
                    <i class="fa-regular fa-user w-6 text-center mr-2"></i> Profil Saya
                </a>
            </nav>

            <div class="px-6 mb-2">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Layanan Konseling</p>
            </div>
            <nav class="space-y-1 px-3">
                <div class="bg-blue-50/30 rounded-lg">
                    <div class="flex items-center justify-between px-3 py-2.5 text-[#004133] font-semibold text-sm">
                        <div class="flex items-center">
                            <i class="fa-regular fa-file-lines w-6 text-center mr-2"></i> Ajuan Konseling
                        </div>
                        <i class="fa-solid fa-chevron-up text-xs"></i>
                    </div>
                    <div class="pl-11 pr-3 pb-2 space-y-1">
                        <a href="/mahasiswa/pengajuan/baru" class="block py-2 px-3 text-sm {{ request()->is('mahasiswa/pengajuan/baru') ? 'font-semibold text-[#004133] bg-[#004133]/10' : 'font-medium text-slate-500 hover:text-slate-700' }} rounded-md">
                            Buat Ajuan Baru
                        </a>
                        <a href="/mahasiswa/riwayat" class="block py-2 px-3 text-sm {{ request()->is('mahasiswa/riwayat') ? 'font-semibold text-[#004133] bg-[#004133]/10' : 'font-medium text-slate-500 hover:text-slate-700' }} rounded-md">
                            Riwayat Ajuan
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-100 space-y-1">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-2.5 text-slate-600 hover:bg-red-50 hover:text-red-600 rounded-lg text-sm font-medium transition-colors">
                    <i class="fa-solid fa-arrow-right-from-bracket w-6 text-center mr-2"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-end px-8 shrink-0">
            <div class="flex items-center gap-3 cursor-pointer">
                <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold text-sm">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                </div>
                <span class="text-sm font-semibold text-slate-700">
                    {{ auth()->user()->name ?? 'User Mahasiswa' }} 
                    <i class="fa-solid fa-chevron-down text-xs ml-1 text-slate-400"></i>
                </span>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>