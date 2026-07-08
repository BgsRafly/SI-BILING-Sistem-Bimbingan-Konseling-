@extends('layouts.dosen')
@section('title', 'Pengajuan & Jadwal - SI-BILING')

@section('content')
<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Pengajuan & Jadwal</h1>
        <p class="text-slate-500 mt-2 text-sm font-medium">Daftar pengajuan masuk dan jadwal bimbingan yang masih aktif.</p>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-sm text-slate-500">
                    <th class="p-4 font-semibold rounded-tl-xl">Mahasiswa</th>
                    <th class="p-4 font-semibold">Topik / Masalah</th>
                    <th class="p-4 font-semibold">Urgensi</th>
                    <th class="p-4 font-semibold">Waktu Bimbingan</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold text-center rounded-tr-xl">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($ajuans as $ajuan)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#004133] text-white flex items-center justify-center font-bold text-xs shadow-inner">
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
                        <p class="text-xs text-slate-500 line-clamp-1 max-w-[200px]" title="{{ $ajuan->deskripsi_keluhan }}">{{ $ajuan->deskripsi_keluhan }}</p>
                    </td>
                    <td class="p-4">
                        @if($ajuan->skala_urgensi >= 4)
                            <span class="text-red-600 font-bold text-sm">Tinggi</span>
                        @elseif($ajuan->skala_urgensi == 3)
                            <span class="text-blue-600 font-bold text-sm">Sedang</span>
                        @else
                            <span class="text-green-600 font-bold text-sm">Rendah</span>
                        @endif
                    </td>
                    <td class="p-4">
                        <p class="text-sm font-medium text-slate-800">{{ \Carbon\Carbon::parse($ajuan->tanggal_bimbingan)->format('d M Y') }}</p>
                        <p class="text-xs text-slate-500">{{ $ajuan->jam_bimbingan }} ({{ $ajuan->jenis_pertemuan }})</p>
                    </td>
                    <td class="p-4">
                        @if($ajuan->status === 'Pending')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold border border-yellow-200">Tertunda</span>
                        @elseif($ajuan->status === 'Disetujui')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold border border-blue-200">Disetujui</span>
                        @elseif($ajuan->status === 'Reschedule')
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold border border-purple-200">Reschedule</span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <a href="/dosen/pengajuan/{{ $ajuan->id }}" class="inline-block bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-50 hover:text-[#004133] transition-colors shadow-sm text-sm font-bold">
                            Tinjau
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-slate-500 font-medium">
                        Tidak ada pengajuan aktif.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection