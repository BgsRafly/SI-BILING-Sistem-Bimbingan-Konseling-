<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Konseling - {{ $mahasiswa->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333333;
            line-height: 1.5;
            font-size: 10pt;
            margin: 0.5cm;
        }
        .header {
            margin-bottom: 25px;
            border-bottom: 3px solid #004133;
            padding-bottom: 10px;
        }
        .header-title {
            font-size: 18pt;
            font-weight: bold;
            color: #004133;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .header-subtitle {
            font-size: 11pt;
            color: #666666;
            margin: 5px 0 0 0;
        }
        .meta-info {
            float: right;
            text-align: right;
            font-size: 9pt;
            color: #888888;
            margin-top: 10px;
        }
        .clear {
            clear: both;
        }
        .section-title {
            font-size: 12pt;
            font-weight: bold;
            color: #004133;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
            margin-top: 20px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }
        table.info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.info-table td {
            padding: 6px 10px;
            vertical-align: top;
        }
        table.info-table td.label {
            width: 30%;
            font-weight: bold;
            color: #4a5568;
        }
        table.info-table td.value {
            width: 70%;
            color: #2d3748;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 9pt;
            font-weight: bold;
            border-radius: 4px;
            text-transform: uppercase;
        }
        .badge-pending { background-color: #fffaf0; color: #dd6b20; border: 1px solid #fbd38d; }
        .badge-disetujui { background-color: #ebf8ff; color: #2b6cb0; border: 1px solid #bee3f8; }
        .badge-selesai { background-color: #f0fff4; color: #2f855a; border: 1px solid #c6f6d5; }
        .badge-ditolak { background-color: #fff5f5; color: #c53030; border: 1px solid #fed7d7; }
        .badge-eskalasi { background-color: #fff5f5; color: #c53030; border: 1px solid #fed7d7; }
        
        .content-box {
            background-color: #f7fafc;
            border: 1px solid #edf2f7;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 15px;
            font-style: normal;
        }
        .content-box-title {
            font-weight: bold;
            font-size: 9.5pt;
            color: #4a5568;
            margin-bottom: 6px;
            text-transform: uppercase;
        }
        .content-box-body {
            color: #2d3748;
            white-space: pre-wrap;
            font-size: 10pt;
        }
        .catatan-box {
            background-color: #f0fff4;
            border-left: 4px solid #38a169;
            border-top: 1px solid #c6f6d5;
            border-right: 1px solid #c6f6d5;
            border-bottom: 1px solid #c6f6d5;
            border-radius: 0 6px 6px 0;
            padding: 12px;
            margin-bottom: 15px;
        }
        .catatan-title {
            font-weight: bold;
            font-size: 9.5pt;
            color: #276749;
            margin-bottom: 6px;
            text-transform: uppercase;
        }
        .catatan-body {
            color: #2f855a;
            font-style: italic;
            white-space: pre-wrap;
        }
        .urgensi-tinggi { color: #e53e3e; font-weight: bold; }
        .urgensi-sedang { color: #3182ce; font-weight: bold; }
        .urgensi-rendah { color: #38a169; font-weight: bold; }
        
        .footer-section {
            margin-top: 40px;
            page-break-inside: avoid;
        }
        .signature-container {
            float: right;
            width: 250px;
            text-align: center;
        }
        .signature-date {
            margin-bottom: 50px;
            font-size: 9.5pt;
        }
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }
        .signature-nip {
            font-size: 9pt;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="meta-info">
        ID Konseling: #{{ $ajuan->id }}<br>
        Tanggal Unduh: {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}
    </div>

    <div class="header">
        <h1 class="header-title">Laporan Hasil Konseling</h1>
        <div class="header-subtitle">SI-BILING — Sistem Informasi Bimbingan Konseling Universitas Udayana</div>
    </div>
    
    <div class="clear"></div>

    <!-- SECTION 1: PROFIL MAHASISWA & DOSEN -->
    <div class="section-title">Profil Mahasiswa & Dosen PA</div>
    <table class="info-table">
        <tr>
            <td class="label">Nama Mahasiswa</td>
            <td class="value">: {{ $mahasiswa->name }}</td>
        </tr>
        <tr>
            <td class="label">NIM</td>
            <td class="value">: {{ $mahasiswa->nim_nip }}</td>
        </tr>
        <tr>
            <td class="label">Program Studi / Angkatan</td>
            <td class="value">: S1 {{ $mahasiswa->program_studi }} / {{ $mahasiswa->angkatan }}</td>
        </tr>
        <tr>
            <td class="label">Nomor WhatsApp</td>
            <td class="value">: {{ $mahasiswa->no_whatsapp ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">Dosen Pembimbing PA</td>
            <td class="value">: {{ $dosen->name }} (NIP. {{ $dosen->nim_nip }})</td>
        </tr>
    </table>

    <!-- SECTION 2: DETAIL PENGAJUAN -->
    <div class="section-title">Detail Pengajuan & Masalah</div>
    <table class="info-table">
        <tr>
            <td class="label">Kategori Masalah</td>
            <td class="value">: <strong>{{ $ajuan->kategori_masalah }}</strong></td>
        </tr>
        <tr>
            <td class="label">Skala Beban Pikiran</td>
            <td class="value">: {{ $ajuan->skala_beban_pikiran }} / 10</td>
        </tr>
        <tr>
            <td class="label">Skala Urgensi</td>
            <td class="value">: 
                @if($ajuan->skala_urgensi >= 4)
                    <span class="urgensi-tinggi">Urgensi Tinggi ({{ $ajuan->skala_urgensi }}/5)</span>
                @elseif($ajuan->skala_urgensi == 3)
                    <span class="urgensi-sedang">Urgensi Sedang ({{ $ajuan->skala_urgensi }}/5)</span>
                @else
                    <span class="urgensi-rendah">Urgensi Rendah ({{ $ajuan->skala_urgensi }}/5)</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="label">Status Konseling</td>
            <td class="value">: 
                @if($ajuan->status === 'Pending')
                    <span class="badge badge-pending">Tertunda (Pending)</span>
                @elseif($ajuan->status === 'Disetujui' || $ajuan->status === 'Reschedule')
                    <span class="badge badge-disetujui">{{ $ajuan->status }}</span>
                @elseif($ajuan->status === 'Selesai')
                    <span class="badge badge-selesai">Selesai</span>
                @elseif($ajuan->status === 'Eskalasi WD3')
                    <span class="badge badge-eskalasi">Eskalasi WD3</span>
                @else
                    <span class="badge badge-ditolak">{{ $ajuan->status }}</span>
                @endif
            </td>
        </tr>
    </table>

    <div class="content-box">
        <div class="content-box-title">Deskripsi Keluhan Mahasiswa</div>
        <div class="content-box-body">{{ $ajuan->deskripsi_keluhan }}</div>
    </div>

    <div class="content-box">
        <div class="content-box-title">Harapan Mahasiswa</div>
        <div class="content-box-body">{{ $ajuan->harapan_mahasiswa }}</div>
    </div>

    <!-- SECTION 3: PELAKSANAAN BIMBINGAN -->
    <div class="section-title">Pelaksanaan Pertemuan</div>
    <table class="info-table">
        <tr>
            <td class="label">Tanggal Pertemuan</td>
            <td class="value">: 
                @if($ajuan->tanggal_bimbingan)
                    {{ \Carbon\Carbon::parse($ajuan->tanggal_bimbingan)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                @else
                    <span style="color: #a0aec0; font-style: italic;">Belum dijadwalkan</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="label">Jam / Waktu</td>
            <td class="value">: 
                @if($ajuan->jam_bimbingan)
                    {{ \Carbon\Carbon::parse($ajuan->jam_bimbingan)->format('H:i') }} WITA
                @else
                    <span style="color: #a0aec0; font-style: italic;">Belum dijadwalkan</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="label">Sifat Pertemuan</td>
            <td class="value">: {{ $ajuan->jenis_pertemuan ?: '-' }}</td>
        </tr>
        <tr>
            <td class="label">Lokasi / Link Ruangan</td>
            <td class="value">: {{ $ajuan->lokasi_atau_link ?: '-' }}</td>
        </tr>
    </table>

    <!-- SECTION 4: CATATAN & HASIL BIMBINGAN -->
    <div class="section-title">Hasil Bimbingan & Catatan Dosen PA</div>
    @if($ajuan->catatan_dosen)
        <div class="catatan-box">
            <div class="catatan-title">Catatan / Rekomendasi Dosen</div>
            <div class="catatan-body">"{{ $ajuan->catatan_dosen }}"</div>
        </div>
    @else
        <div class="content-box" style="background-color: #f7fafc; border: 1px dashed #cbd5e0; text-align: center; color: #718096; padding: 15px;">
            Belum ada catatan atau rekomendasi dari Dosen Pembimbing Akademik untuk sesi bimbingan ini.
        </div>
    @endif

    <!-- SIGNATURE -->
    <div class="footer-section">
        <div class="signature-container">
            <div class="signature-date">
                Badung, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}
            </div>
            <p style="margin-bottom: 60px; font-size: 9.5pt;">Dosen Pembimbing Akademik,</p>
            <div class="signature-name">{{ $dosen->name }}</div>
            <div class="signature-nip">NIP. {{ $dosen->nim_nip }}</div>
        </div>
        <div class="clear"></div>
    </div>

</body>
</html>
