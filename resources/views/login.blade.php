<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SI-BILING</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2 family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased h-screen overflow-hidden">

    <div class="grid grid-cols-1 md:grid-cols-2 h-full w-full">
        
        <div class="flex flex-col justify-center items-center px-8 sm:px-16 lg:px-24 bg-white h-full">
            <div class="w-full max-w-md">
                
                <h1 class="text-3xl font-extrabold text-[#004133] tracking-tight">SI-BILING</h1>
                <p class="text-sm text-gray-500 font-medium mt-2">Sistem Informasi Bimbingan dan Konseling</p>
                
                <form action="/login" method="POST" class="mt-10 space-y-6">
                    @csrf <div>
                        <label for="login_identity" class="block text-xs font-semibold text-gray-700 tracking-wide">
                            Nama Lengkap, NIM, atau NIP
                        </label>
                        <div class="mt-2 relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <input type="text" id="login_identity" name="login_identity" required
                                   placeholder="Masukkan Nama Lengkap, NIM, atau NIP" 
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl text-sm placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center">
                            <label for="password" class="block text-xs font-semibold text-gray-700 tracking-wide">
                                Password
                            </label>
                        </div>
                        <div class="mt-2 relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" required
                                   placeholder="••••••••" 
                                   class="block w-full pl-10 pr-10 py-3 border border-gray-200 rounded-xl text-sm placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#004133]/20 focus:border-[#004133] transition-all bg-[#FAFBFB]">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 cursor-pointer hover:text-gray-600">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 17.772 17.772m-11.544 0a10.45 10.45 0 0 1-2.24-1.555m8.336-4.49A3 3 0 0 0 12 9.11" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#004133] text-white py-3 px-4 rounded-xl text-sm font-semibold hover:bg-opacity-95 transition-all flex items-center justify-center gap-2 shadow-sm mt-4">
                        Masuk Sekarang
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </form>

                <p class="text-center text-xs text-gray-400 font-medium mt-8">
                    Belum punya akun? <a href="/register" class="text-gray-500 hover:underline font-semibold">Daftar (Khusus Mahasiswa)</a>
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