@extends('layouts.dosen')
@section('title', 'Laporan & Statistik - SI-BILING')

@section('content')
<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Laporan & Statistik</h1>
        <p class="text-gray-500 mt-2 text-sm font-medium">Rekapitulasi data bimbingan mahasiswa Anda.</p>
    </div>
    <a href="/dosen/laporan/ekspor" class="bg-[#004133] text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-[#003328] transition-colors shadow-sm flex items-center gap-2">
        <i class="fa-solid fa-file-export"></i> Ekspor Laporan
    </a>
</div>

<!-- Ringkasan Status -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <p class="text-sm font-bold text-gray-600">Total Ajuan</p>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 mt-2">{{ $stats['total'] }}</h2>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">
                <i class="fa-solid fa-check-double"></i>
            </div>
            <p class="text-sm font-bold text-gray-600">Selesai</p>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 mt-2">{{ $stats['selesai'] }}</h2>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <p class="text-sm font-bold text-gray-600">Tertunda</p>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 mt-2">{{ $stats['pending'] }}</h2>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <p class="text-sm font-bold text-gray-600">Eskalasi WD3</p>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 mt-2">{{ $stats['eskalasi'] }}</h2>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Chart Status -->
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden p-6">
        <h2 class="text-base font-bold text-slate-800 mb-4">Statistik Status Laporan</h2>
        <div class="relative w-full h-[250px]">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <!-- Statistik Kategori -->
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden h-fit">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-slate-50">
            <h2 class="text-base font-bold text-slate-800">Berdasarkan Kategori</h2>
        </div>
        <div class="p-6">
            <ul class="space-y-4">
                @forelse($byKategori as $kat)
                <li class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#004133]"></span>
                        {{ $kat->kategori_masalah }}
                    </span>
                    <span class="text-sm font-bold text-gray-900">{{ $kat->total }}</span>
                </li>
                @empty
                <li class="text-sm text-gray-500 text-center">Belum ada data.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<!-- Semua Data Bimbingan -->
<div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-slate-50">
            <h2 class="text-base font-bold text-slate-800">Semua Data Bimbingan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wider bg-white">
                        <th class="p-4 font-semibold">Mahasiswa</th>
                        <th class="p-4 font-semibold">Tanggal & Waktu</th>
                        <th class="p-4 font-semibold">Kategori</th>
                        <th class="p-4 font-semibold">Status</th>
                        <th class="p-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($ajuans as $ajuan)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#004133]/10 text-[#004133] flex items-center justify-center font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($ajuan->mahasiswa->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-gray-800">{{ $ajuan->mahasiswa->name }}</p>
                                    <p class="text-[11px] text-gray-500">NIM: {{ $ajuan->mahasiswa->nim_nip }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            @if($ajuan->tanggal_bimbingan)
                                {{ \Carbon\Carbon::parse($ajuan->tanggal_bimbingan)->format('d/m/Y') }}<br>
                                <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($ajuan->jam_bimbingan)->format('H:i') }} WITA</span>
                            @else
                                <span class="text-gray-400 italic">Belum dijadwalkan</span>
                            @endif
                        </td>
                        <td class="p-4 text-sm text-gray-600 font-medium">
                            {{ $ajuan->kategori_masalah }}
                        </td>
                        <td class="p-4">
                            @if($ajuan->status === 'Pending')
                                <span class="bg-orange-50 text-orange-600 text-xs font-bold px-2.5 py-1 rounded-md border border-orange-100">Tertunda</span>
                            @elseif($ajuan->status === 'Disetujui' || $ajuan->status === 'Reschedule')
                                <span class="bg-blue-50 text-blue-600 text-xs font-bold px-2.5 py-1 rounded-md border border-blue-100">{{ $ajuan->status }}</span>
                            @elseif($ajuan->status === 'Selesai')
                                <span class="bg-green-50 text-green-600 text-xs font-bold px-2.5 py-1 rounded-md border border-green-100">Selesai</span>
                            @elseif($ajuan->status === 'Eskalasi WD3')
                                <span class="bg-red-50 text-red-600 text-xs font-bold px-2.5 py-1 rounded-md border border-red-100">Eskalasi WD3</span>
                            @else
                                <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2.5 py-1 rounded-md border border-gray-200">{{ $ajuan->status }}</span>
                            @endif
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/dosen/laporan/{{ $ajuan->id }}/pdf" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 rounded-lg text-xs font-bold transition-colors">
                                    <i class="fa-solid fa-file-pdf"></i> PDF
                                </a>
                                <a href="/dosen/pengajuan/{{ $ajuan->id }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#004133]/10 text-[#004133] hover:bg-[#004133]/20 border border-[#004133]/20 rounded-lg text-xs font-bold transition-colors">
                                    Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">Belum ada riwayat bimbingan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Tertunda', 'Eskalasi WD3', 'Disetujui', 'Reschedule', 'Ditolak'],
            datasets: [{
                data: [{{ $stats['selesai'] }}, {{ $stats['pending'] }}, {{ $stats['eskalasi'] }}, {{ $stats['disetujui'] }}, {{ $stats['reschedule'] }}, {{ $stats['ditolak'] }}],
                backgroundColor: [
                    '#10B981', // green-500
                    '#F97316', // orange-500
                    '#EF4444', // red-500
                    '#3B82F6', // blue-500
                    '#A855F7', // purple-500
                    '#6B7280'  // gray-500
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { family: 'Inter', size: 12 },
                        usePointStyle: true,
                        padding: 20
                    }
                }
            },
            cutout: '70%'
        }
    });
</script>
@endsection
