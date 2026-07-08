<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-BILING - Layanan Konseling FMIPA UNUD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fdfdfc; }
        .hero-img { border-radius: 24px; }
        .custom-card {
            border-top-left-radius: 40px;
            border-bottom-right-radius: 40px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
        }
    </style>
</head>
<body class="text-gray-900 antialiased">

    <!-- Header -->
    <header class="w-full bg-[#fdfdfc] py-6 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-[#e6f0ed] rounded-full flex items-center justify-center text-[#0a5240] text-xl shadow-sm">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-[17px] font-extrabold text-[#0a5240] leading-none tracking-tight">SI-BILING</h1>
                    <p class="text-[10px] text-gray-500 font-semibold tracking-wide mt-1">Sistem Informasi Bimbingan dan Konseling</p>
                </div>
            </div>
            <div>
                <a href="/login" class="bg-[#0a5240] text-white px-7 py-2.5 rounded-md text-sm font-semibold hover:bg-[#073f31] hover:shadow-lg transition-all">
                    Masuk / Login
                </a>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="max-w-5xl mx-auto px-6 pt-20 pb-20 flex flex-col items-center text-center">
            <div class="inline-flex items-center bg-[#e8f3ef] text-[#0a5240] px-5 py-1.5 rounded-full text-[10px] font-bold tracking-widest uppercase mb-8 border border-[#c4e3d9]">
                LAYANAN KONSELING FMIPA
            </div>

            <h2 class="text-[44px] sm:text-[54px] font-black text-[#1a202c] leading-[1.1] tracking-tight max-w-4xl">
                Ruang Aman Berbagi Cerita,<br/>Temukan Solusi Terbaik
            </h2>

            <p class="mt-6 text-[#5b6b79] text-base md:text-[17px] max-w-3xl leading-relaxed font-medium">
                Platform bimbingan terintegrasi. Ajukan jadwal konsultasi dengan Dosen PA
                atau Konselor secara privat, aman, dan terstruktur untuk mendukung
                perkuliahanmu.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="/login" class="bg-[#0a5240] text-white px-8 py-3 rounded-md text-[15px] font-semibold hover:bg-[#073f31] hover:shadow-lg transition-all">
                    Mulai Konseling
                </a>
                <a href="#alur" class="border-[1.5px] border-[#0a5240] text-[#0a5240] px-8 py-3 rounded-md text-[15px] font-semibold hover:bg-[#f2f9f6] transition-all">
                    Pelajari Alurnya
                </a>
            </div>

            <div class="mt-16 flex gap-20 justify-center items-center">
                <div class="text-center flex flex-col gap-1 items-center">
                    <h3 class="text-[32px] font-black text-[#0a5240] leading-none">100%</h3>
                    <p class="text-[10px] font-bold text-gray-500 tracking-widest uppercase">PRIVASI TERJAGA</p>
                </div>
                <div class="text-center flex flex-col gap-1 items-center">
                    <h3 class="text-[32px] font-black text-[#0a5240] leading-none">24/7</h3>
                    <p class="text-[10px] font-bold text-gray-500 tracking-widest uppercase">AKSES PENGAJUAN</p>
                </div>
            </div>

            <div class="mt-20 w-full relative shadow-2xl shadow-gray-200/60 rounded-[32px] p-2 bg-white">
                <img src="{{ asset('images/gambarlp.png') }}" alt="Konseling" class="w-full h-auto object-cover rounded-[24px]">
                <div class="absolute inset-0 rounded-[32px] ring-1 ring-inset ring-gray-900/5 pointer-events-none"></div>
            </div>
        </section>

        <!-- Bagaimana SI-BILING Membantu Anda -->
        <section id="alur" class="py-24 bg-white border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h3 class="text-[36px] font-black text-[#1a202c] tracking-tight">Bagaimana SI-BILING Membantu Anda?</h3>
                    <p class="text-[#5b6b79] mt-4 text-[17px] font-medium">Proses bimbingan dan konseling yang mudah dalam 4 langkah.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Card 1 -->
                    <div class="custom-card border border-gray-100 bg-[#fbfdfc] p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group">
                        <div class="text-3xl mb-6 grayscale group-hover:grayscale-0 transition-all duration-300">📝</div>
                        <h4 class="font-black text-[#1a202c] text-xl mb-3 tracking-tight group-hover:text-[#0a5240] transition-colors">Buat Pengajuan</h4>
                        <p class="text-[14px] text-[#5b6b79] leading-relaxed">
                            Login ke dashboard mahasiswa, isi keluhan atau permasalahan akademik, pribadi, maupun karir secara privat.
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="custom-card border border-gray-100 bg-[#fbfdfc] p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group">
                        <div class="text-3xl mb-6 grayscale group-hover:grayscale-0 transition-all duration-300">🗓️</div>
                        <h4 class="font-black text-[#1a202c] text-xl mb-3 tracking-tight group-hover:text-[#0a5240] transition-colors">Pilih Jadwal</h4>
                        <p class="text-[14px] text-[#5b6b79] leading-relaxed">
                            Tentukan usulan waktu luang serta opsi metode bimbingan yang diinginkan (secara tatap muka langsung atau daring).
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="custom-card border border-gray-100 bg-[#fbfdfc] p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group">
                        <div class="text-3xl mb-6 grayscale group-hover:grayscale-0 transition-all duration-300">⏳</div>
                        <h4 class="font-black text-[#1a202c] text-xl mb-3 tracking-tight group-hover:text-[#0a5240] transition-colors">Konfirmasi Dosen</h4>
                        <p class="text-[14px] text-[#5b6b79] leading-relaxed">
                            Dosen PA atau konselor akan memeriksa tingkat urgensi dan menyetujui jadwal atau menawarkan waktu alternatif baru.
                        </p>
                    </div>

                    <!-- Card 4 -->
                    <div class="custom-card border border-gray-100 bg-[#fbfdfc] p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group">
                        <div class="text-3xl mb-6 grayscale group-hover:grayscale-0 transition-all duration-300">🌱</div>
                        <h4 class="font-black text-[#1a202c] text-xl mb-3 tracking-tight group-hover:text-[#0a5240] transition-colors">Sesi Konseling</h4>
                        <p class="text-[14px] text-[#5b6b79] leading-relaxed">
                            Laksanakan bimbingan dengan aman. Temukan arahan terbaik bersama untuk menyelesaikan segala kendala perkuliahan Anda.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer FMIPA -->
    <footer class="bg-[#0f172a] text-slate-300 py-16 border-t-[6px] border-[#004133]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                
                <!-- Brand & Address -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-white rounded-full p-1.5 flex items-center justify-center">
                            <img src="{{ asset('images\logo.png') }}" alt="Logo FMIPA" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h4 class="text-white font-black text-xl tracking-wide">FMIPA UNUD</h4>
                            <p class="text-emerald-500 text-xs font-bold uppercase tracking-widest">Universitas Udayana</p>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed mb-6 max-w-sm">
                        Fakultas Matematika dan Ilmu Pengetahuan Alam (FMIPA) Universitas Udayana berkomitmen menyediakan lingkungan akademik yang sehat, aman, dan berprestasi tinggi bagi seluruh sivitas akademika.
                    </p>
                    <div class="flex flex-col gap-3 text-sm">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-emerald-500 mt-1"></i>
                            <p>Jl. Raya Kampus Unud No.9, Jimbaran, Kec. Kuta Sel., Kabupaten Badung, Bali 80361</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-emerald-500"></i>
                            <p>(+62) 361 703137</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-emerald-500"></i>
                            <p>fmipa@unud.ac.id</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold mb-6 text-lg">Pintasan Akses</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs"></i> Portal Akademik (IMISSU)</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs"></i> Website Resmi FMIPA</a></li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-slate-700/50 mt-16 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} SI-BILING - Fakultas Matematika dan Ilmu Pengetahuan Alam Universitas Udayana. All rights reserved.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-emerald-600 text-slate-400 hover:text-white flex items-center justify-center transition-all">
                        <i class="fa-brands fa-instagram text-sm"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-blue-600 text-slate-400 hover:text-white flex items-center justify-center transition-all">
                        <i class="fa-brands fa-youtube text-sm"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-blue-400 text-slate-400 hover:text-white flex items-center justify-center transition-all">
                        <i class="fa-brands fa-twitter text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
