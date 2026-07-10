<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Global - SI-BILING</title>
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
            <p class="text-[9px] text-gray-400 font-medium text-center mt-1">Admin Panel</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-border-all w-5"></i> Dashboard
            </a>
            <a href="/admin/pengguna" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-users w-5"></i> Manajemen Dosen
            </a>
            <a href="/admin/kategori" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
                <i class="fa-solid fa-tags w-5"></i> Kategori Masalah
            </a>
            <a href="/admin/laporan" class="flex items-center gap-3 px-4 py-3 bg-[#EEF2FF] text-[#4f46e5] rounded-xl font-semibold text-sm transition-colors">
                <i class="fa-solid fa-file-contract w-5"></i> Laporan Global
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
                <input type="text" id="searchInput" placeholder="Cari laporan..." class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20">
            </div>
            <div class="flex items-center gap-5">
                <div class="w-10 h-10 bg-[#004133] rounded-full overflow-hidden ml-2 shadow-sm flex items-center justify-center text-white font-bold">
                    AD
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Laporan Global Konseling</h1>
                    <p class="text-gray-500 mt-2 text-sm font-medium">Pantau semua pengajuan bimbingan dari seluruh role dan status secara terpusat.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="/admin/laporan/pdf?{{ http_build_query(request()->all()) }}" class="bg-red-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-red-700 transition-colors shadow-sm flex items-center gap-2">
                        <i class="fa-solid fa-file-pdf"></i> Ekspor PDF
                    </a>
                    <a href="/admin/laporan/ekspor?{{ http_build_query(request()->all()) }}" class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-emerald-700 transition-colors shadow-sm flex items-center gap-2">
                        <i class="fa-solid fa-file-excel"></i> Ekspor CSV
                    </a>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 mb-8">
                <form action="/admin/laporan" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label for="tanggal" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 bg-gray-50">
                    </div>
                    <div>
                        <label for="bulan" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Bulan</label>
                        <select name="bulan" id="bulan" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 bg-gray-50">
                            <option value="">-- Semua Bulan --</option>
                            @foreach([
                                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                            ] as $key => $name)
                                <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tahun" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tahun</label>
                        <select name="tahun" id="tahun" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 bg-gray-50">
                            <option value="">-- Semua Tahun --</option>
                            @foreach($years as $yr)
                                <option value="{{ $yr }}" {{ request('tahun') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 bg-[#004133] text-white px-4 py-2.5 rounded-xl font-bold text-sm hover:bg-[#003328] transition-colors shadow-sm flex items-center justify-center gap-2">
                            <i class="fa-solid fa-filter"></i> Filter
                        </button>
                        <a href="/admin/laporan" class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-50 flex items-center justify-center">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <i class="fa-solid fa-circle-check"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
            @endif

            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-sm text-gray-500">
                                <th class="p-4 font-semibold rounded-tl-xl">Tanggal</th>
                                <th class="p-4 font-semibold">Mahasiswa</th>
                                <th class="p-4 font-semibold">Dosen PA</th>
                                <th class="p-4 font-semibold">Topik</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-center rounded-tr-xl">Intervensi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="divide-y divide-gray-50">
                            @forelse($ajuans as $ajuan)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($ajuan->created_at)->format('d M Y') }}</td>
                                <td class="p-4 font-bold text-gray-900 text-sm">{{ $ajuan->mahasiswa->name ?? 'Terhapus' }}</td>
                                <td class="p-4 font-medium text-gray-700 text-sm">{{ $ajuan->dosen->name ?? 'Terhapus' }}</td>
                                <td class="p-4 text-sm text-gray-600">{{ $ajuan->kategori_masalah }}</td>
                                <td class="p-4">
                                    @if($ajuan->status == 'Pending')
                                        <span class="bg-yellow-50 text-yellow-700 px-2.5 py-1 rounded-md text-xs font-semibold border border-yellow-100">Menunggu</span>
                                    @elseif($ajuan->status == 'Disetujui' || $ajuan->status == 'Reschedule')
                                        <span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-semibold border border-blue-100">Diproses Dosen</span>
                                    @elseif($ajuan->status == 'Selesai')
                                        <span class="bg-green-50 text-green-700 px-2.5 py-1 rounded-md text-xs font-semibold border border-green-100">Selesai</span>
                                    @elseif($ajuan->status == 'Ditolak')
                                        <span class="bg-red-50 text-red-700 px-2.5 py-1 rounded-md text-xs font-semibold border border-red-100">Ditolak</span>
                                    @elseif($ajuan->status == 'Eskalasi WD3')
                                        <span class="bg-red-50 text-red-600 px-2.5 py-1 rounded-md text-xs font-semibold border border-red-100">Eskalasi WD3</span>
                                    @elseif($ajuan->status == 'Diproses Fakultas')
                                        <span class="bg-orange-50 text-orange-600 px-2.5 py-1 rounded-md text-xs font-semibold border border-orange-100">Diproses Fakultas</span>
                                    @else
                                        <span class="bg-gray-50 text-gray-700 px-2.5 py-1 rounded-md text-xs font-semibold border border-gray-200">{{ $ajuan->status }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    <button onclick="openModalEditStatus('{{ $ajuan->id }}', '{{ $ajuan->status }}')" class="text-blue-600 hover:bg-blue-50 px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors border border-blue-200">
                                        Ubah Status
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-500 font-medium">Belum ada laporan dari mahasiswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Edit Status Laporan -->
    <div id="modalEditStatus" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-[#F8FAFC]">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-wrench text-orange-500"></i> Intervensi Status
                </h3>
                <button onclick="closeModalEditStatus()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form id="formEditStatus" method="POST" class="p-6">
                @csrf
                <p class="text-xs text-gray-500 mb-4">Ubah status ini hanya jika terjadi kesalahan alur (deadlock) pada sisi pengguna.</p>
                
                <div class="mb-5">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Pilih Status Baru <span class="text-red-500">*</span></label>
                    <select name="status" id="select_status" required class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 bg-white">
                        <option value="Pending">Pending (Menunggu)</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Reschedule">Reschedule</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Eskalasi WD3">Eskalasi WD3</option>
                        <option value="Diproses Fakultas">Diproses Fakultas</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModalEditStatus()" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-orange-500 text-white rounded-lg text-sm font-bold hover:bg-orange-600 shadow-sm">Ubah Paksa</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModalEditStatus(id, currentStatus) {
            document.getElementById('modalEditStatus').classList.remove('hidden');
            document.getElementById('formEditStatus').action = `/admin/laporan/${id}/status`;
            document.getElementById('select_status').value = currentStatus;
        }
        function closeModalEditStatus() {
            document.getElementById('modalEditStatus').classList.add('hidden');
        }

        // Live Search Script
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.getElementById('tableBody').getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                let row = rows[i];
                if (row.getElementsByTagName('td').length > 1) { // Abaikan baris kosong
                    let text = row.textContent.toLowerCase();
                    if (text.indexOf(filter) > -1) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            }
        });
    </script>
</body>
</html>
