@extends('layouts.mahasiswa')
@section('title', 'Detail Ajuan - SI-BILING')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="/mahasiswa/riwayat" class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-500 hover:text-[#004133] hover:bg-slate-50 transition-colors shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Detail Pengajuan Konseling</h1>
        <p class="text-slate-500 mt-1 text-sm font-medium">Informasi lengkap pengajuan Anda.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Kolom Kiri: Detail Ajuan & Dosen -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Kartu Identitas -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                <h3 class="font-semibold text-slate-800">Informasi Dosen Pembimbing</h3>
                <span class="text-xs font-bold px-2 py-1 bg-[#EEF2FF] text-[#004133] rounded-md">{{ $ajuan->dosen->nim_nip }}</span>
            </div>
            <div class="p-6 flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-[#004133] text-white flex items-center justify-center font-bold text-2xl shadow-inner shrink-0">
                    {{ strtoupper(substr($ajuan->dosen->name, 0, 2)) }}
                </div>
                <div>
                    <h4 class="text-lg font-bold text-slate-800">{{ $ajuan->dosen->name }}</h4>
                    <p class="text-sm text-slate-500">Dosen Pendamping Akademik (PA)</p>
                    @if($ajuan->dosen->no_whatsapp)
                        @php
                            $wa = $ajuan->dosen->no_whatsapp;
                            if(str_starts_with($wa, '0')) $wa = '62' . substr($wa, 1);
                        @endphp
                        <p class="text-sm text-slate-500 mt-1"><a href="https://wa.me/{{ $wa }}" target="_blank" class="hover:underline text-green-600"><i class="fa-brands fa-whatsapp text-green-500 mr-1"></i> {{ $ajuan->dosen->no_whatsapp }}</a></p>
                    @else
                        <p class="text-sm text-slate-500 mt-1"><i class="fa-brands fa-whatsapp text-green-500 mr-1"></i> Belum diatur</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kartu Detail Laporan -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                <h3 class="font-semibold text-slate-800">Detail Keluhan & Topik</h3>
                
                @if($ajuan->status === 'Pending')
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold border border-yellow-200">Menunggu</span>
                @elseif($ajuan->status === 'Disetujui')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">Disetujui</span>
                @elseif($ajuan->status === 'Reschedule')
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold border border-blue-200">Reschedule</span>
                @elseif($ajuan->status === 'Selesai')
                    <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-xs font-bold border border-slate-200">Selesai</span>
                @elseif($ajuan->status === 'Eskalasi WD3' || $ajuan->status === 'Diproses Fakultas')
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold border border-purple-200">Diproses di WD3</span>
                @else
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold border border-red-200">{{ $ajuan->status }}</span>
                @endif
            </div>
            
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-2 gap-4 border-b border-slate-100 pb-5">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kategori Masalah</p>
                        <p class="font-semibold text-slate-800">{{ $ajuan->kategori_masalah }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tingkat Urgensi</p>
                        <div class="mt-1">
                            @if($ajuan->skala_urgensi >= 4)
                                <span class="text-red-600 font-bold">Urgensi Tinggi ({{ $ajuan->skala_urgensi }}/5)</span>
                            @elseif($ajuan->skala_urgensi == 3)
                                <span class="text-blue-600 font-bold">Urgensi Sedang ({{ $ajuan->skala_urgensi }}/5)</span>
                            @else
                                <span class="text-green-600 font-bold">Urgensi Rendah ({{ $ajuan->skala_urgensi }}/5)</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Skala Beban Pikiran (1-10)</p>
                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full {{ $ajuan->skala_beban_pikiran > 7 ? 'bg-red-500' : ($ajuan->skala_beban_pikiran > 4 ? 'bg-orange-500' : 'bg-green-500') }}" style="width: {{ $ajuan->skala_beban_pikiran * 10 }}%"></div>
                        </div>
                        <span class="font-bold text-slate-700 text-sm">{{ $ajuan->skala_beban_pikiran }} / 10</span>
                    </div>
                </div>

                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Deskripsi Keluhan</p>
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $ajuan->deskripsi_keluhan }}</p>
                </div>

                <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100/50">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Harapan Mahasiswa</p>
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $ajuan->harapan_mahasiswa }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Waktu & Status -->
    <div class="space-y-6">
        
        <!-- Waktu Rencana -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="font-semibold text-slate-800 mb-4 pb-3 border-b border-slate-100">Jadwal Pertemuan</h3>
            
            @if(($ajuan->status === 'Eskalasi WD3' || $ajuan->status === 'Diproses Fakultas') && $ajuan->tanggal_wd3)
            <div class="mb-5 bg-purple-50 border border-purple-100 rounded-lg p-3 flex gap-3 items-start">
                <i class="fa-solid fa-circle-info text-purple-500 mt-0.5"></i>
                <p class="text-[11px] text-purple-700 leading-relaxed font-medium">Jadwal pertemuan berikut telah ditetapkan secara langsung oleh Wakil Dekan 3. Harap hadir sesuai dengan waktu yang ditentukan.</p>
            </div>
            @endif

            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-calendar"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium mb-0.5">Tanggal Bimbingan</p>
                        @if(($ajuan->status === 'Eskalasi WD3' || $ajuan->status === 'Diproses Fakultas') && $ajuan->tanggal_wd3)
                            <p class="font-semibold text-slate-800 text-sm">{{ \Carbon\Carbon::parse($ajuan->tanggal_wd3)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                        @else
                            <p class="font-semibold text-slate-800 text-sm">{{ $ajuan->tanggal_bimbingan ? \Carbon\Carbon::parse($ajuan->tanggal_bimbingan)->locale('id')->isoFormat('dddd, D MMMM YYYY') : '-' }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium mb-0.5">Jam Bimbingan</p>
                        @if(($ajuan->status === 'Eskalasi WD3' || $ajuan->status === 'Diproses Fakultas') && $ajuan->waktu_wd3)
                            <p class="font-semibold text-slate-800 text-sm">{{ date('H:i', strtotime($ajuan->waktu_wd3)) }} WITA</p>
                        @else
                            <p class="font-semibold text-slate-800 text-sm">{{ $ajuan->jam_bimbingan ? date('H:i', strtotime($ajuan->jam_bimbingan)) . ' WITA' : '-' }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium mb-0.5">Sifat & Lokasi</p>
                        <p class="font-semibold text-slate-800 text-sm">{{ $ajuan->jenis_pertemuan }}</p>
                        <p class="text-xs text-blue-600 mt-1 font-medium truncate" title="{{ $ajuan->lokasi_atau_link }}">
                            @if($ajuan->jenis_pertemuan == 'Online' && filter_var($ajuan->lokasi_atau_link, FILTER_VALIDATE_URL))
                                <a href="{{ $ajuan->lokasi_atau_link }}" target="_blank" class="hover:underline flex items-center gap-1"><i class="fa-solid fa-link text-[10px]"></i> Buka Tautan</a>
                            @else
                                {{ $ajuan->lokasi_atau_link ?? 'Belum ditentukan' }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Card -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="font-semibold text-slate-800 text-center">Status Pengajuan</h3>
            </div>
            <div class="p-6 text-center">
                @if($ajuan->status === 'Pending')
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-yellow-100 text-yellow-600 mb-4">
                        <i class="fa-solid fa-hourglass-half text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-2">Menunggu Persetujuan</h4>
                    <p class="text-sm text-slate-500">Ajuan Anda sedang menunggu untuk ditinjau oleh Dosen pembimbing.</p>
                @elseif($ajuan->status === 'Disetujui' || $ajuan->status === 'Reschedule')
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-600 mb-4">
                        <i class="fa-regular fa-circle-check text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-2">Jadwal Disetujui</h4>
                    <p class="text-sm text-slate-500">Persiapkan diri Anda untuk bimbingan sesuai jadwal dan lokasi yang tertera.</p>
                @elseif($ajuan->status === 'Ditolak')
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 text-red-600 mb-4">
                        <i class="fa-solid fa-ban text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-2">Pengajuan Ditolak</h4>
                    <p class="text-sm text-slate-500">Pengajuan ini tidak dapat dilanjutkan.</p>
                @elseif($ajuan->status === 'Selesai')
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-600 mb-4">
                        <i class="fa-solid fa-flag-checkered text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-2">Sesi Selesai</h4>
                    <p class="text-sm text-slate-500">Sesi konseling ini telah selesai dilaksanakan.</p>
                @elseif($ajuan->status === 'Eskalasi WD3' || $ajuan->status === 'Diproses Fakultas')
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-purple-100 text-purple-600 mb-4">
                        <i class="fa-solid fa-arrow-up-right-dots text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-2">Diproses di WD3</h4>
                    @if($ajuan->tanggal_wd3 && $ajuan->waktu_wd3)
                        <p class="text-sm text-slate-500">Jadwal pertemuan dengan Wakil Dekan 3 telah ditetapkan. Harap hadir tepat waktu sesuai dengan tanggal dan jam yang tertera pada bagian jadwal.</p>
                    @else
                        <p class="text-sm text-slate-500">Masalah Anda telah dilanjutkan ke Wakil Dekan 3 untuk penanganan lebih lanjut.</p>
                    @endif
                @endif
                
                @if($ajuan->catatan_dosen)
                <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-100 text-left">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Catatan Dosen</p>
                    <p class="text-sm text-slate-700 italic">"{{ $ajuan->catatan_dosen }}"</p>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
