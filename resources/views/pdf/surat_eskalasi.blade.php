<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Rujukan Eskalasi</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 2cm 2.54cm;
        }
        .kop-table {
            width: 100%;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .kop-logo {
            width: 80px;
            vertical-align: middle;
        }
        .kop-logo img {
            width: 80px;
            height: auto;
            display: block;
        }
        .kop-text {
            text-align: center;
            vertical-align: middle;
            padding-right: 80px;
        }
        .kop-text h1 {
            font-size: 14pt;
            margin: 0;
            font-weight: normal;
            line-height: 1.2;
        }
        .kop-text h2 {
            font-size: 14pt;
            margin: 2px 0 0 0;
            font-weight: bold;
            line-height: 1.2;
        }
        .kop-text p {
            font-size: 10pt;
            margin: 4px 0 0 0;
            line-height: 1.3;
        }
        .info-surat {
            width: 100%;
            margin-bottom: 30px;
        }
        .info-surat td {
            vertical-align: top;
        }
        .content {
            text-align: justify;
        }
        .tanda-tangan {
            width: 300px;
            float: right;
            margin-top: 50px;
        }
        .tanda-tangan p {
            margin: 0;
        }
        .tanda-tangan img {
            width: 80px;
            margin: 10px 0;
        }
        .tembusan {
            margin-top: 150px;
            font-size: 10pt;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <table class="kop-table" style="border: none;">
        <tr style="border: none;">
            <td class="kop-logo" style="border: none;">
                <img src="{{ public_path('images/logounud.jpeg') }}" alt="Logo UNUD">
            </td>
            <td class="kop-text" style="border: none;">
                <h1>KEMENTERIAN PENDIDIKAN TINGGI, SAINS,<br>DAN TEKNOLOGI</h1>
                <h2>UNIVERSITAS UDAYANA</h2>
                <p>Alamat : Jln. Raya Kampus Unud, Jimbaran, Badung, Bali 80361<br>
                Telepon : (0361) 701954, 701797, Fax. (0361) 701907<br>
                Laman : <u>www.unud.ac.id</u></p>
            </td>
        </tr>
    </table>

    <table class="info-surat" style="border: none;">
        <tr style="border: none;">
            <td width="70" style="border: none;">Nomor</td>
            <td width="10" style="border: none;">:</td>
            <td style="border: none;">{{ $nomor_surat }}</td>
            <td align="right" style="border: none;">{{ \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td colspan="2">-</td>
        </tr>
        <tr>
            <td>Hal</td>
            <td>:</td>
            <td colspan="2">Eskalasi Penanganan Kasus Mahasiswa</td>
        </tr>
    </table>

    <div class="content">
        <p>Yth. Wakil Dekan 3<br>
        Fakultas Matematika dan Ilmu Pengetahuan Alam<br>
        Denpasar/Jimbaran.</p>

        <p>Berkenaan dengan pelaksanaan Bimbingan Konseling Akademik pada Universitas Udayana, bersama surat ini kami bermaksud mengeskalasikan penanganan permasalahan mahasiswa bimbingan kami, dikarenakan perlunya penanganan lebih lanjut pada tingkat pimpinan/fakultas.</p>

        <p>Adapun data mahasiswa tersebut adalah:</p>
        <table style="margin-left: 20px; margin-bottom: 15px;">
            <tr>
                <td width="120">Nama Mahasiswa</td>
                <td width="10">:</td>
                <td>{{ $mahasiswa->name }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td>{{ $mahasiswa->nim_nip }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>S1 {{ $mahasiswa->program_studi }}</td>
            </tr>
            <tr>
                <td>Kategori Masalah</td>
                <td>:</td>
                <td>{{ $ajuan->kategori_masalah }}</td>
            </tr>
        </table>

        <p>Demikian surat rujukan ini kami sampaikan. Atas perhatian dan kerjasamanya, diucapkan terima kasih.</p>
    </div>

    <div class="tanda-tangan">
        <p>Dosen Pembimbing Akademik,</p>
        <br><br><br>
        <p>{{ $dosen->name }}<br>
        NIP {{ $dosen->nim_nip }}</p>
    </div>

    <div class="clear"></div>

</body>
</html>
