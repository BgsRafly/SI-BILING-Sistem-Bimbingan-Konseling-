@extends('layouts.dosen')
@section('title', 'Eskalasi - SI-BILING')

@section('content')
<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Eskalasi</h1>
        <p class="text-gray-500 mt-2 text-sm font-medium">Laporan kasus mahasiswa yang telah Anda teruskan ke Wakil Dekan 3.</p>
    </div>
</div>

<div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden mb-8">
    <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-slate-50">
        <h2 class="text-lg font-bold text-slate-800">Daftar Eskalasi</h2>
    </div>
    
    <div class="divide-y divide-gray-50">
        @forelse($ajuans as $ajuan)
        <div class="p-6 hover:bg-slate-50 transition-colors">
            <div class="flex justify-between items-start mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm shrink-0">
                        {{ strtoupper(substr($ajuan->mahasiswa->name, 0, 2)) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm">{{ $ajuan->mahasiswa->name }}</h3>
                        <p class="text-[11px] text-gray-500 mt-0.5">NIM: {{ $ajuan->mahasiswa->nim_nip }} • S1 {{ $ajuan->mahasiswa->program_studi }}</p>
                    </div>
                </div>
                <span class="bg-red-100 text-red-700 text-[10px] font-bold px-2.5 py-1 rounded-full border border-red-200">
                    {{ $ajuan->kategori_masalah }}
                </span>
            </div>
            <p class="text-sm text-gray-600 mb-4 pl-13">"{{ $ajuan->deskripsi_keluhan }}"</p>
            
            <div class="flex items-center gap-4 pl-13">
                <span class="text-xs font-medium text-gray-500"><i class="fa-regular fa-clock mr-1"></i> Dieskalasi: {{ \Carbon\Carbon::parse($ajuan->updated_at)->translatedFormat('d F Y') }}</span>
                <div class="ml-auto flex gap-2">
                    @if($ajuan->file_eskalasi)
                    <a href="{{ asset('storage/' . $ajuan->file_eskalasi) }}" target="_blank" class="text-xs font-semibold text-white bg-red-600 border border-red-600 px-3 py-1.5 rounded-lg hover:bg-red-700 transition-colors shadow-sm flex items-center gap-2">
                        <i class="fa-solid fa-file-pdf"></i> Lihat Surat
                    </a>
                    @endif
                    <a href="/dosen/pengajuan/{{ $ajuan->id }}" class="text-xs font-semibold text-gray-700 bg-white border border-gray-200 px-3 py-1.5 rounded-lg hover:bg-gray-50 transition-colors">Lihat Detail Kasus</a>
                </div>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-500 font-medium flex flex-col items-center">
            <i class="fa-solid fa-folder-open text-3xl mb-3 text-slate-300"></i>
            <p>Belum ada kasus yang dieskalasi ke pimpinan saat ini.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .pl-13 { padding-left: 3.25rem; }
</style>
@endsection
