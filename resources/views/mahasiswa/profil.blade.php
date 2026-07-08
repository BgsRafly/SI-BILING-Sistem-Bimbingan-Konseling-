@extends('layouts.mahasiswa')
@section('title', 'Profil Saya')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Profil Saya</h2>
    <div class="text-sm text-slate-500 font-medium mt-2 md:mt-0">
        Home <span class="mx-1">></span> <span class="text-slate-800">Profil Saya</span>
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

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-1 bg-white rounded-xl border border-slate-200 shadow-sm p-6 flex flex-col items-center text-center h-fit">
        <div class="w-24 h-24 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold text-3xl mb-4 shadow-inner">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <h3 class="text-lg font-bold text-slate-800">{{ $user->name }}</h3>
        <p class="text-sm text-slate-500 mb-4">Mahasiswa Aktif</p>
        
        <div class="w-full border-t border-slate-100 pt-4 mt-2">
            <div class="flex justify-between text-sm mb-2">
                <span class="text-slate-500">NIM</span>
                <span class="font-semibold text-slate-800">{{ $user->nim_nip }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-500">Angkatan</span>
                <span class="font-semibold text-slate-800">{{ $user->angkatan ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="md:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-semibold text-slate-800">Data Akademik</h3>
            <button onclick="toggleEdit()" class="text-[#004133] text-sm font-medium hover:underline"><i class="fa-solid fa-pen text-xs mr-1"></i> Edit Kontak</button>
        </div>
        <div class="p-6 space-y-6">
            
            <div class="border border-slate-200 rounded-lg overflow-hidden">
                <div class="flex flex-col sm:flex-row sm:items-center p-4 bg-slate-50 border-b border-slate-200">
                    <span class="w-48 text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Fakultas</span>
                    <span class="text-sm font-medium text-slate-800">Fakultas Matematika dan Ilmu Pengetahuan Alam</span>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center p-4 bg-white border-b border-slate-200">
                    <span class="w-48 text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Program Studi</span>
                    <span class="text-sm font-medium text-slate-800">S1 {{ $user->program_studi ?? '-' }}</span>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center p-4 bg-slate-50 border-b border-slate-200">
                    <span class="w-48 text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Email Kampus</span>
                    <span class="text-sm font-medium text-slate-800">{{ $user->email }}</span>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center p-4 bg-white">
                    <span class="w-48 text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">No. WhatsApp</span>
                    
                    <!-- Display Mode -->
                    <div id="wa-display" class="text-sm font-medium text-slate-800 flex-1">
                        {{ $user->no_whatsapp ?? '-' }}
                    </div>

                    <!-- Edit Mode -->
                    <form id="wa-form" action="/mahasiswa/profil" method="POST" class="hidden flex-1 flex gap-2" onsubmit="return confirm('Apakah data yang Anda masukkan sudah valid?');">
                        @csrf
                        <input type="text" name="no_whatsapp" value="{{ $user->no_whatsapp }}" required placeholder="0812..." oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="15" class="flex-1 border border-slate-300 rounded-md px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#004133] focus:border-[#004133]">
                        <button type="submit" class="bg-[#004133] text-white px-4 py-1.5 rounded-md text-sm font-medium hover:bg-[#003328] transition-colors">Simpan</button>
                    </form>
                </div>
            </div>

            <div class="mt-6 border border-emerald-100 bg-emerald-50 rounded-lg p-4 flex items-start gap-4">
                <i class="fa-solid fa-chalkboard-user text-[#004133] text-xl mt-1"></i>
                <div>
                    <label class="block text-xs font-bold text-emerald-800 uppercase tracking-wider mb-0.5">Dosen Pembimbing Akademik (PA)</label>
                    <p class="text-sm font-bold text-slate-800">{{ $user->dosenPA->name ?? 'Belum Ditentukan' }}</p>
                    <p class="text-xs text-slate-600 mt-1">Dosen PA akan otomatis menerima ajuan bimbingan kategori Akademik dan Karir Anda.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function toggleEdit() {
        const display = document.getElementById('wa-display');
        const form = document.getElementById('wa-form');
        
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
            display.classList.add('hidden');
        } else {
            form.classList.add('hidden');
            display.classList.remove('hidden');
        }
    }
</script>
@endsection