@extends('layouts.dosen')
@section('title', 'Tinjau Ajuan - SI-BILING')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div class="flex items-center gap-4">
        <a href="/dosen/pengajuan" class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-500 hover:text-[#004133] hover:bg-slate-50 transition-colors shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Tinjau Pengajuan Konseling</h1>
            <p class="text-slate-500 mt-1 text-sm font-medium">Detail informasi dari mahasiswa.</p>
        </div>
    </div>
    <div>
        <a href="/dosen/laporan/{{ $ajuan->id }}/pdf" class="bg-red-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-red-700 transition-colors shadow-sm flex items-center gap-2 w-fit">
            <i class="fa-solid fa-file-pdf"></i> Ekspor PDF Detail
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Kolom Kiri: Detail Ajuan & Mahasiswa -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Kartu Identitas -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                <h3 class="font-semibold text-slate-800">Informasi Mahasiswa</h3>
                <span class="text-xs font-bold px-2 py-1 bg-[#EEF2FF] text-[#004133] rounded-md">{{ $ajuan->mahasiswa->nim_nip }}</span>
            </div>
            <div class="p-6 flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-[#004133] text-white flex items-center justify-center font-bold text-2xl shadow-inner shrink-0">
                    {{ strtoupper(substr($ajuan->mahasiswa->name, 0, 2)) }}
                </div>
                <div>
                    <h4 class="text-lg font-bold text-slate-800">{{ $ajuan->mahasiswa->name }}</h4>
                    <p class="text-sm text-slate-500">Program Studi S1 {{ $ajuan->mahasiswa->program_studi }} (Angkatan {{ $ajuan->mahasiswa->angkatan }})</p>
                    @if($ajuan->mahasiswa->no_whatsapp)
                        @php
                            $wa = $ajuan->mahasiswa->no_whatsapp;
                            if(str_starts_with($wa, '0')) $wa = '62' . substr($wa, 1);
                        @endphp
                        <p class="text-sm text-slate-500 mt-1"><a href="https://wa.me/{{ $wa }}" target="_blank" class="hover:underline text-green-600"><i class="fa-brands fa-whatsapp text-green-500 mr-1"></i> {{ $ajuan->mahasiswa->no_whatsapp }}</a></p>
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
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold border border-yellow-200">Tertunda</span>
                @elseif($ajuan->status === 'Disetujui')
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold border border-blue-200">Disetujui</span>
                @elseif($ajuan->status === 'Reschedule')
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold border border-purple-200">Reschedule</span>
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

    <!-- Kolom Kanan: Waktu & Form Respons -->
    <div class="space-y-6">
        
        <!-- Waktu Rencana -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="font-semibold text-slate-800 mb-4 pb-3 border-b border-slate-100">Rencana Pertemuan</h3>
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-calendar"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium mb-0.5">Tanggal Bimbingan</p>
                        <p class="font-semibold text-slate-800 text-sm">{{ \Carbon\Carbon::parse($ajuan->tanggal_bimbingan)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium mb-0.5">Jam Bimbingan</p>
                        <p class="font-semibold text-slate-800 text-sm">{{ $ajuan->jam_bimbingan }} WITA</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-medium mb-0.5">Sifat & Lokasi</p>
                        <p class="font-semibold text-slate-800 text-sm">{{ $ajuan->jenis_pertemuan }}</p>
                        <p class="text-xs text-slate-600 mt-1 truncate" title="{{ $ajuan->lokasi_atau_link }}">{{ $ajuan->lokasi_atau_link ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Aksi Respons -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h3 class="font-semibold text-slate-800 text-center">Berikan Respons</h3>
            </div>
            
            <form method="POST" action="/dosen/pengajuan/{{ $ajuan->id }}/status" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tindakan <span class="text-red-500">*</span></label>
                        <select name="status" id="actionStatus" required onchange="toggleRescheduleFields()" class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 text-slate-700 bg-white shadow-sm">
                            <option value="">-- Pilih --</option>
                            <option value="Disetujui" {{ $ajuan->status === 'Disetujui' ? 'selected' : '' }}>Setujui Pengajuan</option>
                            <option value="Reschedule" {{ $ajuan->status === 'Reschedule' ? 'selected' : '' }}>Jadwalkan Ulang (Reschedule)</option>
                            <option value="Selesai" {{ $ajuan->status === 'Selesai' ? 'selected' : '' }}>Tandai Selesai (Sesi telah dilakukan)</option>
                            <option value="Ditolak" {{ $ajuan->status === 'Ditolak' ? 'selected' : '' }}>Tolak Pengajuan</option>
                        </select>
                    </div>

                    <div id="rescheduleFields" class="{{ $ajuan->status === 'Reschedule' ? '' : 'hidden' }} p-3 bg-purple-50 rounded-lg border border-purple-100 space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-purple-800 mb-1">Tanggal Baru</label>
                            <input type="date" name="tanggal_bimbingan" id="tglBaru" value="{{ $ajuan->tanggal_bimbingan }}" class="w-full border border-purple-200 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-purple-800 mb-1">Jam Baru</label>
                            <input type="time" name="jam_bimbingan" id="jamBaru" value="{{ $ajuan->jam_bimbingan }}" class="w-full border border-purple-200 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 bg-white">
                        </div>
                    </div>

                    <div id="meetingOptionsFields" class="{{ in_array($ajuan->status, ['Disetujui', 'Reschedule']) ? '' : 'hidden' }} p-3 bg-blue-50 rounded-lg border border-blue-100 space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-blue-800 mb-1">Sifat Pertemuan</label>
                            <select name="jenis_pertemuan" id="jenisPertemuan" onchange="toggleLocationField()" class="w-full border border-blue-200 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                                <option value="Offline" {{ $ajuan->jenis_pertemuan === 'Offline' ? 'selected' : '' }}>Tatap Muka (Offline)</option>
                                <option value="Online" {{ $ajuan->jenis_pertemuan === 'Online' ? 'selected' : '' }}>Daring (Online - Zoom)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-blue-800 mb-1" id="labelLokasi">{{ $ajuan->jenis_pertemuan === 'Online' ? 'Link Zoom' : 'Lokasi Fisik (Ruangan)' }} <span class="text-red-500">*</span></label>
                            <input type="text" name="lokasi_atau_link" id="inputLokasi" value="{{ $ajuan->lokasi_atau_link }}" placeholder="{{ $ajuan->jenis_pertemuan === 'Online' ? 'Masukkan link Zoom...' : 'Contoh: Ruang Dosen 2' }}" class="w-full border border-blue-200 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white" {{ in_array($ajuan->status, ['Disetujui', 'Reschedule']) ? 'required' : '' }}>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Catatan / Feedback (Opsional)</label>
                        <textarea name="catatan_dosen" rows="4" placeholder="Tulis catatan untuk mahasiswa..." class="w-full border border-slate-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 resize-none shadow-sm">{{ $ajuan->catatan_dosen }}</textarea>
                    </div>

                    <button type="submit" class="w-full mt-2 bg-[#004133] text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-[#003328] transition-colors shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        @if($ajuan->status !== 'Eskalasi WD3')
        <!-- Kartu Eskalasi -->
        <div class="bg-red-50 rounded-xl border border-red-200 shadow-sm overflow-hidden mt-6">
            <div class="p-6 text-center">
                <i class="fa-solid fa-triangle-exclamation text-red-500 text-3xl mb-3"></i>
                <h3 class="font-bold text-red-800 mb-2">Eskalasi Kasus</h3>
                <p class="text-xs text-red-600 mb-4">Jika kasus ini dirasa berat dan memerlukan penanganan pimpinan, Anda dapat meneruskannya ke Wakil Dekan 3.</p>
                <button onclick="document.getElementById('modalEskalasi').classList.remove('hidden')" class="bg-white border border-red-300 text-red-700 w-full py-2.5 rounded-lg text-sm font-bold shadow-sm hover:bg-red-100 transition-colors">
                    Eskalasi ke WD3
                </button>
            </div>
        </div>
        @endif

    </div>
</div>

<!-- Modal Eskalasi -->
<div id="modalEskalasi" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-red-50">
            <h3 class="font-bold text-red-800 flex items-center gap-2">
                <i class="fa-solid fa-file-pdf"></i> Konfirmasi Eskalasi ke WD3
            </h3>
            <button onclick="document.getElementById('modalEskalasi').classList.add('hidden')" class="text-red-400 hover:text-red-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <form action="/dosen/pengajuan/{{ $ajuan->id }}/eskalasi" method="POST" class="p-6">
            @csrf
            <p class="text-sm text-slate-600 mb-4">Tindakan ini akan menggenerate surat rujukan resmi (PDF) secara otomatis dan memindahkan penanganan kasus mahasiswa <strong>{{ $ajuan->mahasiswa->name }}</strong> ke dashboard Wakil Dekan 3.</p>
            
            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Catatan Eskalasi / Alasan Rujukan <span class="text-red-500">*</span></label>
                <textarea name="catatan_eskalasi" rows="3" required placeholder="Jelaskan secara singkat mengapa kasus ini perlu diserahkan ke pimpinan..." class="w-full border border-slate-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 resize-none shadow-sm"></textarea>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="document.getElementById('modalEskalasi').classList.add('hidden')" class="px-4 py-2 border border-slate-200 text-slate-600 rounded-lg text-sm font-semibold hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-bold hover:bg-red-700 shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane text-xs"></i> Buat Surat & Eskalasi
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function toggleRescheduleFields() {
        const action = document.getElementById('actionStatus').value;
        const reschFields = document.getElementById('rescheduleFields');
        const tgl = document.getElementById('tglBaru');
        const jam = document.getElementById('jamBaru');
        const meetingFields = document.getElementById('meetingOptionsFields');
        const inputLokasi = document.getElementById('inputLokasi');
        
        if(action === 'Reschedule') {
            reschFields.classList.remove('hidden');
            tgl.required = true;
            jam.required = true;
        } else {
            reschFields.classList.add('hidden');
            tgl.required = false;
            jam.required = false;
        }

        if(action === 'Disetujui' || action === 'Reschedule') {
            meetingFields.classList.remove('hidden');
            inputLokasi.required = true;
        } else {
            meetingFields.classList.add('hidden');
            inputLokasi.required = false;
        }
    }

    function toggleLocationField() {
        const type = document.getElementById('jenisPertemuan').value;
        const label = document.getElementById('labelLokasi');
        const input = document.getElementById('inputLokasi');

        if(type === 'Online') {
            label.innerHTML = 'Link Zoom <span class="text-red-500">*</span>';
            input.placeholder = 'Masukkan link Zoom...';
        } else {
            label.innerHTML = 'Lokasi Fisik (Ruangan) <span class="text-red-500">*</span>';
            input.placeholder = 'Contoh: Ruang Dosen 2';
        }
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        // Run on load in case the action is already selected (e.g. going back or validation error)
        if(document.getElementById('actionStatus').value) {
            toggleRescheduleFields();
        }
    });
</script>
@endsection
