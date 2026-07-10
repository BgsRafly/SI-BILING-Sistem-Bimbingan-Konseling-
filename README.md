# SI-BILING (Sistem Informasi Bimbingan Konseling)

SI-BILING adalah sebuah platform berbasis web yang dirancang untuk memfasilitasi dan mendigitalisasi proses bimbingan konseling di lingkungan kampus. Sistem ini menjembatani komunikasi dan penanganan masalah antara Mahasiswa, Dosen, Pembimbing Akademik (PA), dan Wakil Dekan 3 (WD3) secara terstruktur, aman, dan efisien.

## 🚀 Fitur Utama

Sistem ini memiliki manajemen hak akses (Role-Based Access Control) dengan fitur spesifik untuk setiap pengguna:

### 1. Mahasiswa
* **Pengajuan Konseling:** Membuat laporan/ajuan konseling baru dengan memilih kategori masalah dan dosen yang dituju.
* **Manajemen Ajuan:** Membatalkan (cancel) ajuan selama status masih "Menunggu".
* **Real-time Tracking:** Memantau status ajuan secara langsung (termasuk sinkronisasi otomatis jika jadwal di-reschedule oleh dosen).
* **Profil Dinamis:** Menampilkan data profil dan tahun angkatan secara dinamis berdasarkan sesi login.

### 2. Dosen
* **Manajemen Laporan:** Menerima, meninjau, dan merespons ajuan konseling dari mahasiswa.
* **Eskalasi Kasus:** Melakukan eskalasi laporan ke tingkat fakultas (WD3) untuk kasus yang membutuhkan penanganan lanjutan.
* **Auto-Generate Dokumen:** Sistem secara otomatis membuat Surat Eskalasi Resmi dalam format PDF saat aksi eskalasi dilakukan.
* **Visualisasi Data:** Dashboard dilengkapi dengan chart/diagram untuk merangkum statistik laporan bimbingan.

### 3. Pembimbing Akademik (PA)
* **Monitoring:** Memantau riwayat, aktivitas, dan status laporan konseling mahasiswa bimbingannya, terutama untuk kasus-kasus yang telah mengalami eskalasi.

### 4. Wakil Dekan 3 (WD3)
* **Tinjauan Eskalasi:** Menerima dan mengelola laporan konseling yang diekskalasi oleh Dosen.
* **Unduh Berkas:** Mengunduh surat pengantar eskalasi (PDF) secara langsung dari sistem.
* **Penjadwalan Tetap:** Menetapkan jadwal dan waktu tindak lanjut (fixed schedule yang tidak dapat diubah/di-reschedule lagi).
* **Tindak Lanjut & Penyelesaian:** Memberikan catatan akhir dan mengubah status laporan menjadi "Selesai".

### 5. Admin (Superadmin)
* **Master Data:** CRUD (Create, Read, Update, Delete) akun Dosen, Mahasiswa, dan Kategori Masalah secara global.
* **Global Monitoring:** Memantau seluruh alur laporan konseling dari awal hingga akhir.
* **Reporting:** Menghasilkan (generate) laporan rekapitulasi data konseling.
* **Dashboard Statistik:** Visualisasi data sistem secara menyeluruh melalui grafik dan diagram interaktif.

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel (PHP)
* **Frontend:** Vue.js, HTML/CSS, JavaScript
* **Database:** MySQL
* **PDF Generator:** DomPDF (atau library sejenis untuk pembuatan surat eskalasi)
* **Integrasi Lainnya:** Direct Link API WhatsApp (wa.me)

