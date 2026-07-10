<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Global Bimbingan Akademik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            margin: 0.5cm;
        }
        h2, h3 {
            text-align: center;
            margin-bottom: 5px;
            margin-top: 5px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 12px;
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
            padding: 6px;
            font-size: 9pt;
            font-weight: bold;
        }
        td {
            padding: 6px;
            font-size: 9pt;
        }
        .stats-table th, .stats-table td {
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN GLOBAL REKAPITULASI BIMBINGAN AKADEMIK</h2>
        <h3>SISTEM INFORMASI BIMBINGAN (SI-BILING)</h3>
        <p>Filter: {{ $filterText ?? 'Semua Waktu' }} | Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    </div>

    <h4>Statistik Status Pengajuan</h4>
    <table class="stats-table">
        <tr>
            <th>Total Ajuan</th>
            <th>Selesai</th>
            <th>Diproses Dosen/Fakultas</th>
            <th>Tertunda (Pending)</th>
            <th>Reschedule</th>
            <th>Eskalasi WD3</th>
            <th>Ditolak</th>
        </tr>
        <tr>
            <td>{{ $stats['total'] }}</td>
            <td>{{ $stats['selesai'] }}</td>
            <td>{{ $stats['disetujui'] }}</td>
            <td>{{ $stats['pending'] }}</td>
            <td>{{ $stats['reschedule'] }}</td>
            <td>{{ $stats['eskalasi'] }}</td>
            <td>{{ $stats['ditolak'] }}</td>
        </tr>
    </table>

    <h4>Daftar Riwayat Bimbingan Global</h4>
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="15%">Tanggal Ajuan</th>
                <th width="18%">Mahasiswa (NIM)</th>
                <th width="18%">Dosen PA</th>
                <th width="18%">Topik / Kategori</th>
                <th width="15%">Tgl Bimbingan</th>
                <th width="12%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ajuans as $index => $ajuan)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($ajuan->created_at)->format('d/m/Y') }}</td>
                <td>{{ $ajuan->mahasiswa->name ?? 'Terhapus' }}<br><span style="font-size: 8pt; color: #555;">NIM: {{ $ajuan->mahasiswa->nim_nip ?? '-' }}</span></td>
                <td>{{ $ajuan->dosen->name ?? 'Terhapus' }}</td>
                <td>{{ $ajuan->kategori_masalah }}</td>
                <td class="text-center">
                    @if($ajuan->tanggal_bimbingan)
                        {{ \Carbon\Carbon::parse($ajuan->tanggal_bimbingan)->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center">
                    @if($ajuan->status == 'Pending')
                        Menunggu
                    @elseif($ajuan->status == 'Disetujui' || $ajuan->status == 'Reschedule')
                        Diproses
                    @elseif($ajuan->status == 'Selesai')
                        Selesai
                    @elseif($ajuan->status == 'Ditolak')
                        Ditolak
                    @elseif($ajuan->status == 'Eskalasi WD3')
                        Eskalasi WD3
                    @elseif($ajuan->status == 'Diproses Fakultas')
                        Fakultas
                    @else
                        {{ $ajuan->status }}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada riwayat pengajuan bimbingan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
