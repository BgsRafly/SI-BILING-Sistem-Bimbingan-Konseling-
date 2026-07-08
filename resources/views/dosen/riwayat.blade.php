@extends('layouts.dosen')
@section('title', 'Riwayat Sesi - SI-BILING')

@section('content')
<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Riwayat Sesi</h1>
        <p class="text-slate-500 mt-2 text-sm font-medium">Rekam jejak sesi konseling yang telah selesai atau ditolak.</p>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-sm text-slate-500">
                    <th class="p-4 font-semibold rounded-tl-xl">Mahasiswa</th>
                    <th class="p-4 font-semibold">Topik / Masalah</th>
                    <th class="p-4 font-semibold">Waktu Bimbingan</th>
                    <th class="p-4 font-semibold">Catatan Anda</th>
                    <th class="p-4 font-semibold text-center rounded-tr-xl">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($ajuans as $ajuan)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-xs shadow-inner">
                                {{ strtoupper(substr($ajuan->mahasiswa->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-800 text-sm">{{ $ajuan->mahasiswa->name }}</p>
                                <p class="text-xs text-slate-500 font-medium">{{ $ajuan->mahasiswa->nim_nip }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <p class="text-sm font-semibold text-slate-800">{{ $ajuan->kategori_masalah }}</p>
                        <p class="text-xs text-slate-500 line-clamp-1 max-w-[200px]" title="{{ $ajuan->deskripsi_keluhan }}">{{ Str::limit($ajuan->deskripsi_keluhan, 40) }}</p>
                    </td>
                    <td class="p-4">
                        <p class="text-sm font-medium text-slate-800">{{ \Carbon\Carbon::parse($ajuan->tanggal_bimbingan)->format('d M Y') }}</p>
                        <p class="text-xs text-slate-500">{{ $ajuan->jam_bimbingan }} ({{ $ajuan->jenis_pertemuan }})</p>
                    </td>
                    <td class="p-4">
                        <p class="text-xs text-slate-600 line-clamp-2 italic">"{{ $ajuan->catatan_dosen ?: 'Tidak ada catatan.' }}"</p>
                    </td>
                    <td class="p-4 text-center">
                        @if($ajuan->status === 'Selesai')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">Selesai</span>
                        @elseif($ajuan->status === 'Ditolak')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold border border-red-200">Ditolak</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-slate-500 font-medium">
                        Belum ada riwayat sesi konseling.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
