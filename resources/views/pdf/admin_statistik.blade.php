<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Statistik SI-BILING</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #004133; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #004133; font-size: 24px; }
        .header p { margin: 5px 0 0; color: #555; }
        .section-title { font-size: 16px; font-weight: bold; margin-top: 20px; margin-bottom: 10px; color: #004133; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        .grid { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .grid td { width: 25%; padding: 15px; text-align: center; border: 1px solid #ddd; background: #f9f9f9; }
        .grid .val { font-size: 24px; font-weight: bold; color: #004133; display: block; margin-bottom: 5px; }
        .grid .lbl { font-size: 11px; text-transform: uppercase; color: #666; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .table th { background: #004133; color: white; }
        .footer { text-align: center; font-size: 10px; color: #999; margin-top: 40px; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>SI-BILING</h1>
        <p>Laporan Statistik Sistem Informasi Bimbingan Konseling Mahasiswa</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }} WITA</p>
    </div>

    <div class="section-title">Ringkasan Sistem</div>
    <table class="grid">
        <tr>
            <td>
                <span class="val">{{ $totalMahasiswa }}</span>
                <span class="lbl">Mahasiswa Terdaftar</span>
            </td>
            <td>
                <span class="val">{{ $totalDosen }}</span>
                <span class="lbl">Dosen Terdaftar</span>
            </td>
            <td>
                <span class="val">{{ $totalLaporan }}</span>
                <span class="lbl">Total Pengajuan</span>
            </td>
            <td>
                <span class="val">{{ $totalKategori }}</span>
                <span class="lbl">Kategori Masalah</span>
            </td>
        </tr>
    </table>

    <div class="section-title">Statistik Berdasarkan Status Laporan</div>
    <table class="table">
        <thead>
            <tr>
                <th>Status</th>
                <th style="text-align: center; width: 30%;">Jumlah Laporan</th>
                <th style="text-align: center; width: 30%;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach(['Pending', 'Disetujui', 'Reschedule', 'Eskalasi WD3', 'Diproses Fakultas', 'Selesai', 'Ditolak'] as $status)
                @php 
                    $count = $statusStats[$status] ?? 0; 
                    $percent = $totalLaporan > 0 ? round(($count / $totalLaporan) * 100, 1) : 0;
                @endphp
                <tr>
                    <td>{{ $status }}</td>
                    <td style="text-align: center;">{{ $count }}</td>
                    <td style="text-align: center;">{{ $percent }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">Statistik Berdasarkan Topik Permasalahan</div>
    <table class="table">
        <thead>
            <tr>
                <th>Kategori Permasalahan</th>
                <th style="text-align: center; width: 30%;">Jumlah Laporan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoriStats as $kategori => $count)
                <tr>
                    <td>{{ $kategori }}</td>
                    <td style="text-align: center;">{{ $count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align: center; color: #888;">Belum ada data permasalahan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dokumen ini dihasilkan secara otomatis oleh Sistem Informasi Bimbingan Konseling (SI-BILING) Universitas Udayana.
    </div>

</body>
</html>
