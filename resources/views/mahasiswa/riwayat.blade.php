@extends('layouts.mahasiswa')
@section('title', 'Riwayat Ajuan')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Riwayat Ajuan Konseling</h2>
    <div class="text-sm text-slate-500 font-medium mt-2 md:mt-0">
        Home <span class="mx-1">></span> Layanan Konseling <span class="mx-1">></span> <span class="text-slate-800">Riwayat</span>
    </div>
</div>

@if(session('success'))
<div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 border border-green-200 font-medium">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6 border border-red-200">
    <ul class="list-disc pl-5">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-sm text-slate-500">
                    <th class="p-4 font-semibold rounded-tl-xl">Topik Masalah</th>
                    <th class="p-4 font-semibold">Kategori</th>
                    <th class="p-4 font-semibold">Tanggal & Waktu</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold text-center rounded-tr-xl">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($ajuans as $ajuan)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="p-4">
                        <h3 class="font-bold text-slate-800 text-base">{{ $ajuan->kategori_masalah }}</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Diajukan: {{ $ajuan->created_at->diffForHumans() }}</p>
                    </td>
                    <td class="p-4">
                        <span class="text-sm font-medium text-slate-600">{{ $ajuan->kategori_masalah }}</span>
                    </td>
                    <td class="p-4">
                        <p class="text-sm text-slate-800 font-medium">{{ \Carbon\Carbon::parse($ajuan->tanggal_bimbingan)->format('d M Y') }}</p>
                        <p class="text-xs text-slate-500">{{ date('H:i', strtotime($ajuan->jam_bimbingan)) }} ({{ $ajuan->jenis_pertemuan }})</p>
                    </td>
                    <td class="p-4">
                        @if($ajuan->status == 'Pending')
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-200 uppercase tracking-wider">Menunggu Dosen</span>
                        @elseif($ajuan->status == 'Disetujui')
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200 uppercase tracking-wider">Disetujui</span>
                        @elseif($ajuan->status == 'Reschedule')
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-purple-50 text-purple-600 border border-purple-200 uppercase tracking-wider">Reschedule</span>
                        @elseif($ajuan->status == 'Selesai')
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200 uppercase tracking-wider">Selesai</span>
                        @else
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-red-50 text-red-600 border border-red-200 uppercase tracking-wider">{{ $ajuan->status }}</span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="/mahasiswa/pengajuan/{{ $ajuan->id }}" class="px-3 py-1.5 text-xs font-semibold bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200">Detail</a>
                            @if($ajuan->status == 'Pending')
                            <form action="/mahasiswa/pengajuan/{{ $ajuan->id }}/batal" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan ini?');">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 text-xs font-semibold bg-red-100 text-red-600 rounded-lg hover:bg-red-200">Batal</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-slate-500">Belum ada riwayat pengajuan konseling.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection