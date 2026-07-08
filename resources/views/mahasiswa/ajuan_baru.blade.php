@extends('layouts.mahasiswa')
@section('title', 'Buat Ajuan Baru')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Buat Ajuan Baru</h2>
    <div class="text-sm text-slate-500 font-medium mt-2 md:mt-0">
        Home <span class="mx-1">></span> <span class="text-slate-800">Buat Ajuan Baru</span>
    </div>
</div>

<form action="/mahasiswa/pengajuan/baru" method="POST">
    @csrf
    
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800">Formulir Konseling</h3>
            </div>
            
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Harapan Bimbingan <span class="text-red-500">*</span></label>
                    <input type="text" name="harapan_mahasiswa" value="{{ old('harapan_mahasiswa') }}" placeholder="Contoh: Mendapat solusi untuk mengatur waktu" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#004133] focus:border-[#004133] outline-none transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis Permasalahan <span class="text-red-500">*</span></label>
                    <select name="kategori_masalah" id="kategori_masalah" required class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all appearance-none cursor-pointer">
                        <option value="" disabled selected>Pilih Kategori Permasalahan</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Metode Konseling <span class="text-red-500">*</span></label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer border border-slate-200 p-3 rounded-lg flex-1 hover:border-[#004133] transition-colors">
                            <input type="radio" name="jenis_pertemuan" value="Offline" id="jenisOffline" onchange="toggleOnlineWarning()" {{ old('jenis_pertemuan') == 'Offline' ? 'checked' : '' }} class="accent-[#004133]" required>
                            <span class="text-sm text-slate-700 font-medium">Tatap Muka (Offline)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer border border-slate-200 p-3 rounded-lg flex-1 hover:border-[#004133] transition-colors">
                            <input type="radio" name="jenis_pertemuan" value="Online" id="jenisOnline" onchange="toggleOnlineWarning()" {{ old('jenis_pertemuan') == 'Online' ? 'checked' : '' }} class="accent-[#004133]" required>
                            <span class="text-sm text-slate-700 font-medium">Daring (Online)</span>
                        </label>
                    </div>
                    <div id="onlineWarning" class="hidden mt-3 bg-blue-50 text-blue-700 p-3 rounded-lg border border-blue-100 text-sm flex items-start gap-2">
                        <i class="fa-solid fa-circle-info mt-0.5"></i>
                        <p>Jika Anda memilih metode <strong>Online</strong>, maka bimbingan akan dilakukan melalui Zoom. Link akses akan diberikan oleh Dosen setelah jadwal Anda disetujui.</p>
                    </div>
                </div>
                
                <script>
                    function toggleOnlineWarning() {
                        const onlineRadio = document.getElementById('jenisOnline');
                        const warningDiv = document.getElementById('onlineWarning');
                        if (onlineRadio.checked) {
                            warningDiv.classList.remove('hidden');
                        } else {
                            warningDiv.classList.add('hidden');
                        }
                    }
                    // Run once on load just in case 'old' value is Online
                    document.addEventListener('DOMContentLoaded', toggleOnlineWarning);
                </script>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Rencana <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_bimbingan" value="{{ old('tanggal_bimbingan') }}" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#004133] focus:border-[#004133] outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Jam <span class="text-red-500">*</span></label>
                        <input type="time" name="jam_bimbingan" value="{{ old('jam_bimbingan') }}" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#004133] focus:border-[#004133] outline-none transition-all" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Skala Beban Pikiran (Kondisi Psikologis) <span class="text-red-500">*</span></label>
                    <p class="text-xs text-slate-500 mb-3">Seberapa berat masalah ini mengganggu keseharian Anda?</p>
                    <div class="flex items-center justify-between gap-2 border border-slate-200 rounded-xl p-4 bg-white">
                        <span class="text-xs font-medium text-slate-500 w-24">Sangat Ringan</span>
                        <div class="flex gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="skala_beban_pikiran" value="1" class="peer sr-only" required {{ old('skala_beban_pikiran') == '1' ? 'checked' : '' }}>
                                <div class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 font-bold peer-checked:bg-[#004133] peer-checked:text-white peer-checked:border-[#004133] hover:border-[#004133] transition-all">1</div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="skala_beban_pikiran" value="2" class="peer sr-only" required {{ old('skala_beban_pikiran') == '2' ? 'checked' : '' }}>
                                <div class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 font-bold peer-checked:bg-[#004133] peer-checked:text-white peer-checked:border-[#004133] hover:border-[#004133] transition-all">2</div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="skala_beban_pikiran" value="3" class="peer sr-only" required {{ old('skala_beban_pikiran') == '3' ? 'checked' : '' }}>
                                <div class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 font-bold peer-checked:bg-[#004133] peer-checked:text-white peer-checked:border-[#004133] hover:border-[#004133] transition-all">3</div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="skala_beban_pikiran" value="4" class="peer sr-only" required {{ old('skala_beban_pikiran') == '4' ? 'checked' : '' }}>
                                <div class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 font-bold peer-checked:bg-[#004133] peer-checked:text-white peer-checked:border-[#004133] hover:border-[#004133] transition-all">4</div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="skala_beban_pikiran" value="5" class="peer sr-only" required {{ old('skala_beban_pikiran') == '5' ? 'checked' : '' }}>
                                <div class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 font-bold peer-checked:bg-[#004133] peer-checked:text-white peer-checked:border-[#004133] hover:border-[#004133] transition-all">5</div>
                            </label>
                        </div>
                        <span class="text-xs font-medium text-slate-500 w-24 text-right">Sangat Berat</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Skala Urgensi Penanganan <span class="text-red-500">*</span></label>
                    <p class="text-xs text-slate-500 mb-3">Menentukan prioritas antrean bimbingan.</p>
                    <div class="flex items-center justify-between gap-2 border border-slate-200 rounded-xl p-4 bg-white">
                        <span class="text-xs font-medium text-slate-500 w-24">Santai</span>
                        <div class="flex gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="skala_urgensi" value="1" class="peer sr-only" required>
                                <div class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 font-bold peer-checked:bg-red-100 peer-checked:text-red-700 peer-checked:border-red-400 hover:border-red-400 transition-all">1</div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="skala_urgensi" value="2" class="peer sr-only" required>
                                <div class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 font-bold peer-checked:bg-red-100 peer-checked:text-red-700 peer-checked:border-red-400 hover:border-red-400 transition-all">2</div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="skala_urgensi" value="3" class="peer sr-only" required>
                                <div class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 font-bold peer-checked:bg-red-100 peer-checked:text-red-700 peer-checked:border-red-400 hover:border-red-400 transition-all">3</div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="skala_urgensi" value="4" class="peer sr-only" required>
                                <div class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 font-bold peer-checked:bg-red-100 peer-checked:text-red-700 peer-checked:border-red-400 hover:border-red-400 transition-all">4</div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="skala_urgensi" value="5" class="peer sr-only" required>
                                <div class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-300 bg-white text-slate-700 font-bold peer-checked:bg-red-100 peer-checked:text-red-700 peer-checked:border-red-400 hover:border-red-400 transition-all">5</div>
                            </label>
                        </div>
                        <span class="text-xs font-medium text-slate-500 w-24 text-right">Tinggi</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Masalah <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi_keluhan" rows="4" placeholder="Ceritakan sedikit tentang masalah yang ingin Anda konsultasikan..." class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#004133] focus:border-[#004133] outline-none transition-all" required>{{ old('deskripsi_keluhan') }}</textarea>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-[#004133] hover:bg-[#003328] text-white px-6 py-2 rounded-lg text-sm font-semibold transition-colors shadow-sm">
                    Kirim Ajuan Baru
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm h-fit">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-semibold text-slate-800">Informasi Pengajuan</h3>
            </div>
            <div class="p-6">
                <ul class="space-y-4 text-sm text-slate-600 list-disc pl-4 marker:text-slate-400">
                    <li class="pl-1">
                        <strong class="text-slate-700 font-semibold">Pilih Kategori:</strong> Sistem akan otomatis mengarahkan ajuan Anda ke Dosen PA atau Konselor yang sesuai.
                        <div class="mt-1.5 p-2.5 bg-slate-50 border border-slate-100 rounded-md text-xs space-y-1">
                            <p><span class="font-semibold text-slate-700">Akademik dan Karir:</span> Ditangani Dosen PA.</p>
                            <p><span class="font-semibold text-slate-700">Pribadi dan Sosial:</span> Ditangani Dosen Konselor.</p>
                        </div>
                    </li>
                    <li class="pl-1">
                        <strong class="text-slate-700 font-semibold">Jadwal:</strong> Jadwal yang Anda pilih bersifat <i>rencana</i>. Dosen dapat menyetujui atau mengajukan jadwal pengganti (Reschedule).
                    </li>
                    <li class="pl-1">
                        <strong class="text-slate-700 font-semibold">Kerahasiaan:</strong> Semua data dan cerita yang Anda sampaikan dijamin kerahasiaannya.
                    </li>
                </ul>
            </div>
        </div>

    </div>
</form>
@endsection