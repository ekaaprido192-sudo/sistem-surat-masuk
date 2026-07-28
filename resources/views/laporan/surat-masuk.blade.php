<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Surat Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            line-height: 1.3;
        }
        .header h2 {
            margin: 0;
            font-size: 16px;
            text-transform: uppercase;
        }
        .header h3 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 11px;
        }
        .line {
            border-bottom: 2px solid #000;
            margin: 10px 0 20px;
        }
        .title {
            text-align: center;
            margin-bottom: 20px;
        }
        .title h4 {
            margin: 0;
            font-size: 14px;
            text-transform: uppercase;
        }
        .title p {
            margin: 5px 0 0;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .ttd-container {
            width: 100%;
            float: right;
        }
        .ttd-box {
            float: right;
            width: 250px;
            text-align: center;
        }
        .ttd-space {
            height: 60px;
        }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="header">
        <h2>Pemerintah Kabupaten / Kota</h2>
        <h3>Badan Pengelolaan Keuangan dan Aset Daerah</h3>
        <p>Jl. Jendral Sudirman No. 123, Telp. (021) 1234567, Fax. (021) 7654321</p>
    </div>
    <div class="line"></div>

    <!-- Judul & Periode -->
    <div class="title">
        <h4>Laporan Surat Masuk</h4>
        <p>Periode: {{ $tglMulai ? \Carbon\Carbon::parse($tglMulai)->locale('id')->translatedFormat('d F Y') : '-' }} s/d {{ $tglSelesai ? \Carbon\Carbon::parse($tglSelesai)->locale('id')->translatedFormat('d F Y') : '-' }}</p>
    </div>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">No. Surat</th>
                <th style="width: 15%;">Tgl. Surat</th>
                <th style="width: 25%;">Pengirim</th>
                <th style="width: 35%;">Perihal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suratMasuk as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->no_surat }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d/m/Y') }}</td>
                    <td>{{ $item->pengirim ?? '-' }}</td>
                    <td>{{ $item->perihal }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data surat masuk pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Area Tanda Tangan -->
    <div class="ttd-container">
        <div class="ttd-box">
            <p>{{ now()->locale('id')->translatedFormat('d F Y') }}<br>Kepala BKAD,</p>
            <div class="ttd-space"></div>
            <p><strong><u>( NAMA KEPALA DINAS )</u></strong><br>NIP. 19800101 200501 1 001</p>
        </div>
    </div>

</body>
</html>