<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mahasiswa - SI-BILING</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased h-screen overflow-hidden">

    <div class="grid grid-cols-1 md:grid-cols-2 h-full w-full">
        
        <div class="flex flex-col items-center px-8 sm:px-12 lg:px-16 bg-white h-full overflow-y-auto py-10">
            <div class="w-full max-w-lg my-auto">
                
                <h1 class="text-3xl font-extrabold text-[#004133] tracking-tight">Daftar Akun Mahasiswa</h1>
                <p class="text-sm text-gray-500 font-medium mt-2">Sistem Informasi Bimbingan dan Konseling</p>
                
                @if($errors->any())
                <div class="mt-6 bg-red-50 text-red-700 p-4 rounded-xl border border-red-200">
                    <ul class="list-disc pl-5 text-sm font-medium">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="/register" method="POST" class="mt-8 space-y-5">
                    @csrf 

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-xs font-semibold text-gray-700 tracking-wide">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                   placeholder="Masukkan Nama Lengkap" 
                                   class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-sm placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                        </div>
                    </div>

                    <!-- NIM dan Email (Grid) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="nim_nip" class="block text-xs font-semibold text-gray-700 tracking-wide">
                                NIM <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="text" id="nim_nip" name="nim_nip" required value="{{ old('nim_nip') }}"
                                       placeholder="Contoh: 2408561001" 
                                       class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-sm placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-semibold text-gray-700 tracking-wide">
                                Email Kampus <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                       placeholder="nama@student.unud.ac.id" 
                                       class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-sm placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                            </div>
                        </div>
                    </div>

                    <!-- No WhatsApp -->
                    <div>
                        <label for="no_whatsapp" class="block text-xs font-semibold text-gray-700 tracking-wide">
                            No. WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" id="no_whatsapp" name="no_whatsapp" required value="{{ old('no_whatsapp') }}"
                                   placeholder="Contoh: 081234567890" 
                                   class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-sm placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                        </div>
                    </div>

                    <!-- Program Studi dan Angkatan (Grid) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="program_studi" class="block text-xs font-semibold text-gray-700 tracking-wide">
                                Program Studi <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <select id="program_studi" name="program_studi" required
                                        class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                                    <option value="" disabled {{ old('program_studi') ? '' : 'selected' }}>Pilih Program Studi</option>
                                    <option value="kimia" {{ old('program_studi') == 'kimia' ? 'selected' : '' }}>Kimia</option>
                                    <option value="fisika" {{ old('program_studi') == 'fisika' ? 'selected' : '' }}>Fisika</option>
                                    <option value="biologi" {{ old('program_studi') == 'biologi' ? 'selected' : '' }}>Biologi</option>
                                    <option value="matematika" {{ old('program_studi') == 'matematika' ? 'selected' : '' }}>Matematika</option>
                                    <option value="farmasi" {{ old('program_studi') == 'farmasi' ? 'selected' : '' }}>Farmasi</option>
                                    <option value="informatika" {{ old('program_studi') == 'informatika' ? 'selected' : '' }}>Informatika</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="angkatan" class="block text-xs font-semibold text-gray-700 tracking-wide">
                                Angkatan <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2">
                                <input type="number" id="angkatan" name="angkatan" required value="{{ old('angkatan') }}" min="2000" max="{{ date('Y') + 1 }}"
                                       placeholder="Contoh: 2024" 
                                       class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-sm placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                            </div>
                        </div>
                    </div>

                    <!-- Dosen PA -->
                    <div>
                        <label for="dosen_pa_id" class="block text-xs font-semibold text-gray-700 tracking-wide">
                            Dosen Pembimbing Akademik (PA) <span class="text-red-500">*</span>
                        </label>
                        <p class="text-[10px] text-gray-500 mt-1 mb-2">Tolong pilih dosen PA yang sesuai dengan IMISSU.</p>
                        <div class="mt-1">
                            <select id="dosen_pa_id" name="dosen_pa_id" required
                                    class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                                <option value="" disabled {{ old('dosen_pa_id') ? '' : 'selected' }}>Pilih Dosen Pembimbing Akademik</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('dosen_pa_id') == $dosen->id ? 'selected' : '' }}>{{ $dosen->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Password dan Konfirmasi (Grid) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-xs font-semibold text-gray-700 tracking-wide">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2 relative rounded-lg shadow-sm">
                                <input type="password" id="password" name="password" required
                                       placeholder="••••••••" 
                                       class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-sm placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 tracking-wide">
                                Konfirmasi Password <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2 relative rounded-lg shadow-sm">
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                       placeholder="••••••••" 
                                       class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-sm placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#004133] text-white py-3 px-4 rounded-xl text-sm font-semibold hover:bg-opacity-95 transition-all flex items-center justify-center gap-2 shadow-sm mt-8">
                        Daftar Akun
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </form>

                <p class="text-center text-xs text-gray-400 font-medium mt-8 pb-10">
                    Sudah punya akun? <a href="/login" class="text-gray-500 hover:underline font-semibold">Masuk ke SI-BILING</a>
                </p>

            </div>
        </div>

        <div class="hidden md:flex bg-[#ECEFEF] items-center justify-center h-full w-full border-l border-gray-100">
            <div class="w-2/3 max-w-sm flex flex-col items-center">
                <img src="{{ asset('images/logofmipa.png') }}" alt="Logo Institusi FMIPA Udayana" class="w-full h-auto object-contain drop-shadow-sm">
            </div>
        </div>

    </div>

</body>
</html>
