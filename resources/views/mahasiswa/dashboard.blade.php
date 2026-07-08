@extends('layouts.mahasiswa')
@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Dashboard Mahasiswa</h2>
        <p class="text-sm text-slate-500 mt-1">Selamat datang kembali, {{ explode(' ', trim($user->name))[0] }}.</p>
    </div>
    <div class="text-sm text-slate-500 font-medium mt-2 md:mt-0">
        Home <span class="mx-1">></span> <span class="text-slate-800">Dashboard</span>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xl shrink-0">
            <i class="fa-regular fa-file-lines"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Sedang Proses</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $totalProses }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
            <i class="fa-regular fa-circle-check"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Sesi Selesai</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $totalSelesai }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4 border-l-4 border-l-red-500">
        <div class="w-12 h-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-xl shrink-0">
            <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-red-600">Pengajuan Ditolak</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalDitolak }}</h3>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
        <h3 class="font-semibold text-slate-800">Ajuan Konseling Terakhir</h3>
        <a href="/mahasiswa/riwayat" class="text-sm text-[#004133] hover:underline font-medium">Lihat Semua</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider bg-white">
                    <th class="p-4 font-semibold">Topik Ajuan</th>
                    <th class="p-4 font-semibold">Tanggal Rencana</th>
                    <th class="p-4 font-semibold">Jenis Pertemuan</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($ajuans as $ajuan)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-4">
                        <p class="font-semibold text-slate-800">{{ $ajuan->kategori_masalah }}</p>
                    </td>
                    <td class="p-4 text-slate-600">{{ \Carbon\Carbon::parse($ajuan->tanggal_bimbingan)->format('d M Y') }}, {{ date('H:i', strtotime($ajuan->jam_bimbingan)) }}</td>
                    <td class="p-4"><span class="text-slate-600">{{ $ajuan->jenis_pertemuan ?? '-' }}</span></td>
                    <td class="p-4">
                        @if($ajuan->status == 'Pending')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-100 text-blue-700 border border-blue-200">
                            Menunggu
                        </span>
                        @elseif($ajuan->status == 'Selesai')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200">
                            Selesai
                        </span>
                        @elseif($ajuan->status == 'Disetujui')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-100 text-indigo-700 border border-indigo-200">
                            Disetujui
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                            {{ $ajuan->status }}
                        </span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <a href="/mahasiswa/pengajuan/{{ $ajuan->id }}" class="px-3 py-1.5 text-xs font-semibold bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-slate-500">Belum ada data pengajuan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection