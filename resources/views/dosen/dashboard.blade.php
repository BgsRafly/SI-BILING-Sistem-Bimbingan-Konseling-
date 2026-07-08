@extends('layouts.dosen')
@section('title', 'Dashboard Dosen PA - SI-BILING')

@section('content')
<div class="flex justify-between items-start mb-8">
    <div>
        <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Halo, {{ $dosen->name }}</h2>
        <p class="text-slate-500 mt-1 text-sm font-medium">Anda mempunyai {{ $totalTertunda }} permintaan konseling tertunda hari ini.</p>
    </div>
    <button class="bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-slate-50 transition-colors flex items-center gap-2">
        <i class="fa-solid fa-download"></i> Ekspor Laporan
    </button>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    
    <!-- Kolom Kiri -->
    <div class="xl:col-span-2 space-y-6">
        
        <!-- Permintaan Tertunda -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-clipboard-list text-[#004133]"></i> Permintaan Tertunda 
                    <span class="bg-red-100 text-red-600 text-xs px-2 py-0.5 rounded-full">{{ $totalTertunda }}</span>
                </h3>
                <a href="/dosen/pengajuan" class="text-sm font-semibold text-[#004133] hover:underline transition-colors">View All</a>
            </div>

            <div class="space-y-4">
                @forelse($ajuanTertunda as $ajuan)
                <div class="p-5 border border-slate-200 rounded-xl bg-white relative">
                    <div class="flex justify-between items-start gap-4">
                        <div class="flex gap-4 w-full">
                            <div class="w-12 h-12 bg-[#D1E0FF] text-[#004133] rounded-full flex items-center justify-center font-bold text-sm shrink-0">
                                {{ strtoupper(substr($ajuan->mahasiswa->name, 0, 2)) }}
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-800 text-base">{{ $ajuan->mahasiswa->name }}</h4>
                                <p class="text-xs text-slate-500 font-medium mb-3">NIM: {{ $ajuan->mahasiswa->nim_nip }} &bull; {{ $ajuan->mahasiswa->program_studi }}</p>
                                
                                <!-- Tags -->
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <span class="bg-red-50 text-red-700 px-2.5 py-1 rounded-full text-[10px] font-bold border border-red-100">
                                        {{ $ajuan->kategori_masalah }}
                                    </span>
                                    <span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded-full text-[10px] font-bold border border-slate-200">
                                        Diajukan: {{ \Carbon\Carbon::parse($ajuan->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    @if($ajuan->skala_urgensi >= 4)
                                        <span class="text-red-600 px-2.5 py-1 rounded-full text-[10px] font-bold border border-red-200 bg-red-50">
                                            ! Urgensi Tinggi
                                        </span>
                                    @elseif($ajuan->skala_urgensi == 3)
                                        <span class="text-blue-600 px-2.5 py-1 rounded-full text-[10px] font-bold border border-blue-200 bg-blue-50">
                                            Urgensi Sedang
                                        </span>
                                    @else
                                        <span class="text-green-600 px-2.5 py-1 rounded-full text-[10px] font-bold border border-green-200 bg-green-50">
                                            Urgensi Rendah
                                        </span>
                                    @endif

                                    @if($ajuan->skala_beban_pikiran >= 7)
                                        <span class="text-slate-600 px-2.5 py-1 rounded-full text-[10px] font-bold border border-slate-200">
                                            Kondisi: Stres
                                        </span>
                                    @else
                                        <span class="text-slate-600 px-2.5 py-1 rounded-full text-[10px] font-bold border border-slate-200">
                                            Kondisi: Normal
                                        </span>
                                    @endif
                                </div>

                                <p class="text-sm text-slate-700 font-medium mt-2 pr-4 text-justify">"{{ Str::limit($ajuan->deskripsi_keluhan, 120) }}"</p>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex flex-col gap-2 shrink-0 min-w-[140px] items-end">
                            <form action="/dosen/pengajuan/{{ $ajuan->id }}/status" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="w-full bg-[#004133] text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-[#003328] transition-colors flex items-center justify-center gap-1.5">
                                    <i class="fa-solid fa-check text-xs"></i> Setujui
                                </button>
                            </form>
                            <div class="flex gap-2 w-full">
                                <a href="/dosen/pengajuan/{{ $ajuan->id }}" class="flex-1 text-center bg-white border border-slate-200 text-slate-700 px-2 py-1.5 rounded-lg text-xs font-bold hover:bg-slate-50 transition-colors">
                                    Jadwalkan Ulang
                                </a>
                                <form action="/dosen/pengajuan/{{ $ajuan->id }}/status" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="status" value="Ditolak">
                                    <button type="submit" class="w-full bg-white border border-slate-200 text-red-600 px-2 py-1.5 rounded-lg text-xs font-bold hover:bg-red-50 transition-colors">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-slate-500 font-medium border border-dashed border-slate-300 rounded-xl">
                    Tidak ada permintaan konseling tertunda.
                </div>
                @endforelse
            </div>
        </div>

        <!-- Catatan Sesi Terkini -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="font-bold text-lg text-slate-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-slate-400"></i> Catatan Sesi Terkini
            </h3>
            
            <div class="relative border-l-2 border-slate-100 ml-4 space-y-8 pb-4">
                @forelse($catatanTerkini as $catatan)
                <div class="relative pl-6">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full {{ $loop->first ? 'bg-[#004133]' : 'bg-slate-200' }} border-4 border-white flex items-center justify-center">
                        @if($loop->first)
                            <i class="fa-solid fa-check text-white" style="font-size: 6px;"></i>
                        @endif
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm hover:shadow transition-shadow">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-bold text-slate-800 text-sm">{{ $catatan->mahasiswa->name }}</h4>
                            <span class="text-xs text-slate-400 font-medium">{{ \Carbon\Carbon::parse($catatan->updated_at)->translatedFormat('d M') }}</span>
                        </div>
                        <p class="text-sm text-slate-600">{{ $catatan->catatan_dosen }}</p>
                    </div>
                </div>
                @empty
                <div class="pl-6 text-sm text-slate-500">
                    Belum ada catatan sesi.
                </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Kolom Kanan -->
    <div class="space-y-6">
        
        <!-- Top Stats -->
        <div class="flex gap-4">
            <div class="flex-1 bg-[#004133] rounded-xl p-4 text-white shadow-sm flex flex-col justify-between h-28">
                <div class="flex items-start gap-2">
                    <i class="fa-solid fa-users text-white/50 text-lg"></i>
                    <div class="text-3xl font-black">{{ $totalMahasiswa }}</div>
                </div>
                <div class="text-[10px] text-white/70 font-medium leading-tight mt-1">Total Mahasiswa<br>Bimbingan</div>
            </div>
            
            <div class="flex-1 bg-[#D1E0FF] rounded-xl p-4 text-[#004133] shadow-sm flex flex-col justify-between h-28 border border-blue-100">
                <div class="flex items-start gap-2">
                    <i class="fa-regular fa-circle-check text-[#004133]/50 text-lg"></i>
                    <div class="text-3xl font-black">{{ $sesiMingguIni }}</div>
                </div>
                <div class="text-[10px] text-[#004133]/70 font-medium leading-tight mt-1">Sesi minggu ini</div>
            </div>
        </div>

        <!-- Jadwal Mendatang -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-slate-800">Jadwal Mendatang</h3>
                <div class="flex gap-2 text-slate-400">
                    <button class="hover:text-slate-600"><i class="fa-solid fa-chevron-left text-xs"></i></button>
                    <button class="hover:text-slate-600"><i class="fa-solid fa-chevron-right text-xs"></i></button>
                </div>
            </div>

            <!-- Static Mini Calendar Header -->
            <div class="text-center text-sm font-bold text-slate-700 mb-4">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</div>
            <div class="grid grid-cols-7 text-center text-xs font-semibold text-slate-400 mb-2">
                <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
            </div>
            <!-- Full Month Calendar -->
            <div class="grid grid-cols-7 gap-y-2 text-center text-sm text-slate-700 font-medium mb-6">
                @php
                    $today = \Carbon\Carbon::today();
                    $startOfMonth = $today->copy()->startOfMonth();
                    $endOfMonth = $today->copy()->endOfMonth();
                    
                    // Hari pertama di minggu (0 = Minggu, 1 = Senin)
                    $startDayOfWeek = $startOfMonth->dayOfWeek;
                    
                    // Mundur ke hari Minggu sebelum tanggal 1
                    $startDate = $startOfMonth->copy()->subDays($startDayOfWeek);
                    
                    // Jumlah kotak kalender (biasanya 5 minggu = 35 hari, atau 6 minggu = 42 hari)
                    $totalDays = 35;
                    if ($startDate->copy()->addDays(35)->lessThanOrEqualTo($endOfMonth)) {
                        $totalDays = 42;
                    }
                @endphp
                
                @for($i=0; $i < $totalDays; $i++)
                    @php 
                        $day = $startDate->copy()->addDays($i); 
                        $isCurrentMonth = $day->month === $today->month;
                    @endphp
                    
                    @if($day->isSameDay($today))
                        <div class="mx-auto w-7 h-7 bg-[#004133] text-white rounded-full flex items-center justify-center font-bold">
                            {{ $day->format('j') }}
                        </div>
                    @else
                        <div class="mx-auto w-7 h-7 flex items-center justify-center {{ !$isCurrentMonth ? 'text-slate-300' : 'text-slate-700 hover:bg-slate-100 rounded-full cursor-pointer' }}">
                            {{ $day->format('j') }}
                        </div>
                    @endif
                @endfor
            </div>

            <!-- Upcoming List -->
            <div class="space-y-4 border-t border-slate-100 pt-4">
                @forelse($jadwalMendatang as $jadwal)
                <div class="flex gap-4">
                    <div class="w-14 h-14 bg-[#004133] text-white rounded-xl flex flex-col items-center justify-center shrink-0 shadow-sm">
                        <span class="text-sm font-bold leading-none">{{ \Carbon\Carbon::parse($jadwal->jam_bimbingan)->format('H:i') }}</span>
                        <span class="text-[9px] uppercase tracking-wider mt-1 opacity-80">{{ \Carbon\Carbon::parse($jadwal->jam_bimbingan)->format('A') }}</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm">Konseling {{ $jadwal->kategori_masalah }}</h4>
                        <p class="text-xs text-slate-500 mt-1">{{ $jadwal->jenis_pertemuan }} &bull; {{ $jadwal->mahasiswa->name }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-xs text-slate-500">
                    Tidak ada jadwal mendatang.
                </div>
                @endforelse
            </div>

            <a href="/dosen/pengajuan" class="block w-full text-center border border-slate-200 text-slate-600 py-2.5 rounded-lg text-sm font-semibold hover:bg-slate-50 mt-6 transition-colors">
                Lihat Semua Jadwal
            </a>
        </div>

    </div>
</div>
@endsection