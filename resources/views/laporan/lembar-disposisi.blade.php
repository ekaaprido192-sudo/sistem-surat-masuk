<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lembar Disposisi - {{ $disposisi->suratMasuk->nomor_agenda ?? '-' }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 20mm;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: #000;
            line-height: 1.4;
        }
        .header-table {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }
        .header-table td {
            vertical-align: middle;
        }
        .logo {
            width: 75px;
            height: auto;
        }
        .instansi-title {
            text-align: center;
        }
        .instansi-title h3 {
            margin: 0;
            font-size: 13pt;
            font-weight: normal;
            text-transform: uppercase;
        }
        .instansi-title h2 {
            margin: 2px 0;
            font-size: 15pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .instansi-title p {
            margin: 0;
            font-size: 8.5pt;
        }
        .judul-lembar {
            text-align: center;
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 14px;
            text-transform: uppercase;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .content-table td, .content-table th {
            border: 1px solid #000;
            padding: 8px 10px;
            vertical-align: top;
        }
        .bg-light {
            background-color: #f2f2f2;
            font-weight: bold;
            width: 25%;
        }
        .instruksi-box {
            min-height: 90px;
            font-style: italic;
        }
        .ttd-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .ttd-table td {
            vertical-align: top;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td style="width: 15%; text-align: center;">
                <img src="{{ public_path('images/logo-bkad.png') }}" class="logo" alt="Logo BKAD">
            </td>
            <td style="width: 85%;" class="instansi-title">
                <h3>Pemerintah Kota Bogor</h3>
                <h2>Badan Keuangan dan Aset Daerah</h2>
                <p>Jl. Pemuda No.31, RT.01/RW.06, Tanah Sareal, Kota Bogor, Jawa Barat 16162</p>
                <p>Telepon: (0251) 8323099 | Pos-el: bkad@kotabogor.go.id | Laman: bkad.kotabogor.go.id</p>
            </td>
        </tr>
    </table>

    <div class="judul-lembar">LEMBAR DISPOSISI</div>

    <table class="content-table">
        <tr>
            <td class="bg-light">Nomor Agenda</td>
            <td style="width: 30%; font-weight: bold;">{{ $disposisi->suratMasuk->nomor_agenda ?? '-' }}</td>
            <td class="bg-light">Tingkat Keamanan</td>
            <td style="width: 25%; font-weight: bold;">{{ $disposisi->sifat ?? 'Biasa' }}</td>
        </tr>
        <tr>
            <td class="bg-light">Tanggal Penerimaan</td>
            <td>{{ \Carbon\Carbon::parse($disposisi->suratMasuk->tanggal_diterima)->translatedFormat('d F Y') }}</td>
            <td class="bg-light">Tanggal Disposisi</td>
            <td>{{ \Carbon\Carbon::parse($disposisi->tgl_disposisi)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="bg-light">Nomor Surat</td>
            <td colspan="3">{{ $disposisi->suratMasuk->nomor_surat ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-light">Tanggal Surat</td>
            <td colspan="3">{{ \Carbon\Carbon::parse($disposisi->suratMasuk->tanggal_surat)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="bg-light">Asal Surat</td>
            <td colspan="3">{{ $disposisi->suratMasuk->asal_surat ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-light">Perihal / Isi Ringkas</td>
            <td colspan="3">{{ $disposisi->suratMasuk->perihal ?? '-' }}</td>
        </tr>
        <tr>
            <td class="bg-light">Diteruskan Kepada</td>
            <td colspan="3" style="font-weight: bold; color: #1e3a8a;">
                {{ $disposisi->tujuan_bidang ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="bg-light">Instruksi / Catatan Pimpinan</td>
            <td colspan="3" class="instruksi-box">
                "{{ $disposisi->instruksi ?? '-' }}"
            </td>
        </tr>
    </table>

    <table class="ttd-table">
        <tr>
            <td style="width: 55%;"></td>
            <td style="width: 45%; text-align: center;">
                <p style="margin-bottom: 5px;">Bogor, {{ \Carbon\Carbon::parse($disposisi->tgl_disposisi)->translatedFormat('d F Y') }}</p>
                <p style="font-weight: bold; margin-top: 0;">Kepala BKAD Kota Bogor,</p>
                <div style="height: 60px;"></div>
                <p style="font-weight: bold; text-decoration: underline; margin-bottom: 2px;">Lia Kania Dewi, S.Si., M.M.</p>
                <p style="margin-top: 0;">NIP. ___________________</p>
            </td>
        </tr>
    </table>

</body>
</html>