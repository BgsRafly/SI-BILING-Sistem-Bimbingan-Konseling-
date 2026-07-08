<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bimbingan Akademik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            margin: 1cm;
        }
        h2, h3 {
            text-align: center;
            margin-bottom: 5px;
            margin-top: 5px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .info-dosen {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th {
            background-color: #f2f2f2;
            padding: 8px;
            font-size: 10pt;
        }
        td {
            padding: 8px;
            font-size: 10pt;
        }
        .stats-table th, .stats-table td {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN REKAPITULASI BIMBINGAN AKADEMIK</h2>
        <h3>SISTEM INFORMASI BIMBINGAN (SI-BILING)</h3>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    </div>

    <div class="info-dosen">
        <strong>Nama Dosen PA:</strong> {{ $dosen->name }}<br>
        <strong>NIP:</strong> {{ $dosen->nim_nip }}
    </div>

    <h4>Statistik Umum</h4>
    <table class="stats-table">
        <tr>
            <th>Total Ajuan</th>
            <th>Selesai</th>
            <th>Tertunda</th>
            <th>Reschedule</th>
            <th>Eskalasi WD3</th>
        </tr>
        <tr>
            <td>{{ $stats['total'] }}</td>
            <td>{{ $stats['selesai'] }}</td>
            <td>{{ $stats['pending'] }}</td>
            <td>{{ $stats['reschedule'] }}</td>
            <td>{{ $stats['eskalasi'] }}</td>
        </tr>
    </table>

    <h4>Daftar Riwayat Bimbingan</h4>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Mahasiswa</th>
                <th width="15%">NIM</th>
                <th width="20%">Kategori Masalah</th>
                <th width="20%">Tgl Bimbingan</th>
                <th width="20%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ajuans as $index => $ajuan)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $ajuan->mahasiswa->name }}</td>
                <td>{{ $ajuan->mahasiswa->nim_nip }}</td>
                <td>{{ $ajuan->kategori_masalah }}</td>
                <td style="text-align: center;">
                    @if($ajuan->tanggal_bimbingan)
                        {{ \Carbon\Carbon::parse($ajuan->tanggal_bimbingan)->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </td>
                <td style="text-align: center;">{{ $ajuan->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Belum ada riwayat pengajuan bimbingan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
