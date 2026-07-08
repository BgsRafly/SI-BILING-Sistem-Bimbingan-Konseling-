<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Masalah - SI-BILING</title>
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
            <a href="/admin/kategori" class="flex items-center gap-3 px-4 py-3 bg-[#EEF2FF] text-[#4f46e5] rounded-xl font-semibold text-sm transition-colors">
                <i class="fa-solid fa-tags w-5"></i> Kategori Masalah
            </a>
            <a href="/admin/laporan" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-xl font-medium text-sm transition-colors">
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
                <input type="text" id="searchInput" placeholder="Cari kategori..." class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20">
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
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Kategori Masalah</h1>
                    <p class="text-gray-500 mt-2 text-sm font-medium">Kelola master data topik atau permasalahan yang dapat dipilih mahasiswa.</p>
                </div>
                <div class="flex gap-3">
                    <button onclick="openModalTambah()" class="bg-[#004133] text-white px-5 py-2.5 rounded-xl font-medium text-sm hover:bg-[#003328] transition-all shadow-sm flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Tambah Kategori
                    </button>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <i class="fa-solid fa-circle-check"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
            @endif
            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span class="text-sm font-semibold">Terdapat kesalahan pada input form.</span>
            </div>
            @endif

            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-sm text-gray-500">
                                <th class="p-4 font-semibold rounded-tl-xl w-16 text-center">No</th>
                                <th class="p-4 font-semibold">Nama Kategori / Topik</th>
                                <th class="p-4 font-semibold">Deskripsi</th>
                                <th class="p-4 font-semibold text-center rounded-tr-xl w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="divide-y divide-gray-50">
                            @forelse($kategoris as $index => $kategori)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 text-sm text-gray-500 text-center font-medium">{{ $index + 1 }}</td>
                                <td class="p-4 font-bold text-gray-900 text-sm">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-[#004133]"></div>
                                        {{ $kategori->nama_kategori }}
                                    </div>
                                </td>
                                <td class="p-4 text-sm text-gray-600 max-w-xs truncate" title="{{ $kategori->deskripsi }}">{{ $kategori->deskripsi ?? '-' }}</td>
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openModalEdit('{{ $kategori->id }}', '{{ $kategori->nama_kategori }}', '{{ $kategori->deskripsi }}')" class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <form action="/admin/kategori/{{ $kategori->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? (Laporan yang sudah menggunakan kategori ini tidak akan terhapus, namun kategori ini tidak bisa dipilih lagi).');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500 font-medium">Belum ada kategori masalah yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- Modal Tambah Kategori -->
    <div id="modalTambah" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-[#F8FAFC]">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-tags text-[#004133]"></i> Tambah Kategori
                </h3>
                <button onclick="closeModalTambah()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="/admin/kategori" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kategori" required placeholder="Contoh: Akademik" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" rows="3" placeholder="Contoh: Permasalahan mengenai nilai, KRS..." class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20"></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModalTambah()" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-[#004133] text-white rounded-lg text-sm font-bold hover:bg-[#003328] shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <div id="modalEdit" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-[#F8FAFC]">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-pen text-blue-600"></i> Edit Kategori
                </h3>
                <button onclick="closeModalEdit()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form id="formEdit" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kategori" id="edit_nama" required class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" id="edit_deskripsi" rows="3" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20"></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModalEdit()" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModalTambah() {
            document.getElementById('modalTambah').classList.remove('hidden');
        }
        function closeModalTambah() {
            document.getElementById('modalTambah').classList.add('hidden');
        }
        function openModalEdit(id, nama, deskripsi) {
            document.getElementById('modalEdit').classList.remove('hidden');
            document.getElementById('formEdit').action = `/admin/kategori/${id}`;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_deskripsi').value = deskripsi || '';
        }
        function closeModalEdit() {
            document.getElementById('modalEdit').classList.add('hidden');
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
