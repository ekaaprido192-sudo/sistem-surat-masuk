<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Surat Masuk - BKAD Kota Bogor</title>

    <style>
        @page {
            margin: 20px 25px;
        }

        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 9px;
            color: #000;
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }

        /* KOP SURAT */
        .kop-wrapper {
            width: 100%;
            margin-bottom: 2px;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .logo-col {
            width: 80px;
            text-align: left;
        }

        .logo-bkad {
            width: 70px;
            height: auto;
            display: block;
        }

        .instansi-col {
            text-align: center;
        }

        .instansi-col h2 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .instansi-col h1 {
            margin: 2px 0;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .instansi-col p {
            margin: 1px 0;
            font-size: 9px;
            color: #222;
        }

        /* GARIS PEMBATAS KOP */
        .garis-kop {
            border-top: 2.5px solid #000;
            border-bottom: 0.8px solid #000;
            height: 2px;
            margin-top: 5px;
            margin-bottom: 12px;
        }

        /* JUDUL LAPORAN */
        .judul-laporan {
            text-align: center;
            margin-bottom: 12px;
        }

        .judul-laporan h3 {
            margin: 0;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .judul-laporan p {
            margin: 4px 0 0 0;
            font-size: 9px;
        }

        /* INFO METADATA */
        .info-table {
            width: 280px;
            margin-bottom: 8px;
            border-collapse: collapse;
            font-size: 9px;
        }

        .info-table td {
            border: none;
            padding: 1.5px 0;
        }

        /* TABEL DATA */
        .laporan-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5px;
        }

        .laporan-table th {
            border: 1px solid #000;
            background-color: #f2f2f2;
            padding: 5px 4px;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
            text-transform: uppercase;
        }

        .laporan-table td {
            border: 1px solid #000;
            padding: 4px 5px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .font-semibold {
            font-weight: bold;
        }

        /* TANDA TANGAN (FOOTER) */
        .ttd-wrapper {
            margin-top: 20px;
            width: 100%;
            page-break-inside: avoid;
        }

        .ttd-box {
            width: 230px;
            float: right;
            text-align: center;
        }

        .space-ttd {
            height: 60px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

    {{-- KOP SURAT --}}
    <div class="kop-wrapper">
        <table class="kop-table">
            <tr>
                <td class="logo-col">
                    @php
                        $logoPath = public_path('images/logo-bkad.png');
                    @endphp
                    @if (file_exists($logoPath))
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents($logoPath)) }}" class="logo-bkad" alt="Logo">
                    @endif
                </td>
                <td class="instansi-col">
                    <h2>PEMERINTAH KOTA BOGOR</h2>
                    <h1>BADAN KEUANGAN DAN ASET DAERAH</h1>
                    <p>Jl. Pemuda No.31, RT.01/RW.06, Tanah Sareal, Kota Bogor, Jawa Barat 16162</p>
                    <p>Telepon: (0251) 8323099 | Pos-el: bkad@kotabogor.go.id</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="garis-kop"></div>

    {{-- JUDUL DOKUMEN --}}
    <div class="judul-laporan">
        <h3>LAPORAN DATA SURAT MASUK</h3>
        <p>
            Periode: 
            <strong>
                @if ($tglMulai)
                    {{ \Carbon\Carbon::parse($tglMulai)->locale('id')->translatedFormat('d F Y') }}
                @else
                    Semua Data
                @endif
                s/d
                @if ($tglSelesai)
                    {{ \Carbon\Carbon::parse($tglSelesai)->locale('id')->translatedFormat('d F Y') }}
                @else
                    Semua Data
                @endif
            </strong>
        </p>
    </div>

    {{-- INFO CETAK --}}
    <table class="info-table">
        <tr>
            <td width="90">Tanggal Cetak</td>
            <td width="10">:</td>
            <td>{{ now()->locale('id')->translatedFormat('d F Y H:i') }} WIB</td>
        </tr>
        <tr>
            <td>Total Surat</td>
            <td>:</td>
            <td><strong>{{ $suratMasuk->count() }} Data</strong></td>
        </tr>
    </table>

    {{-- TABEL DATA SURAT --}}
    <table class="laporan-table">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="11%">No. Agenda</th>
                <th width="18%">Nomor Surat</th>
                <th width="10%">Tgl Surat</th>
                <th width="10%">Tgl Terima</th>
                <th width="20%">Asal Surat</th>
                <th width="17%">Perihal</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suratMasuk as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center font-semibold">{{ $item->nomor_agenda ?? '-' }}</td>
                    <td>{{ $item->nomor_surat ?? '-' }}</td>
                    <td class="text-center">
                        {{ $item->tanggal_surat ? \Carbon\Carbon::parse($item->tanggal_surat)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $item->tanggal_diterima ? \Carbon\Carbon::parse($item->tanggal_diterima)->format('d/m/Y') : '-' }}
                    </td>
                    <td>{{ $item->asal_surat ?? '-' }}</td>
                    <td>{{ $item->perihal ?? '-' }}</td>
                    <td class="text-center font-semibold">{{ $item->status ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 15px;">
                        <em>Tidak ada data surat masuk pada periode yang dipilih.</em>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TANDA TANGAN PEJABAT --}}
    <div class="ttd-wrapper">
        <div class="ttd-box">
            <p style="margin: 0;">Bogor, {{ now()->locale('id')->translatedFormat('d F Y') }}</p>
            <p style="margin: 3px 0 0 0;">Kepala BKAD Kota Bogor,</p>
            <div class="space-ttd"></div>
            <p style="margin: 0; font-weight: bold; text-decoration: underline;">
                {{ $pejabatTtd ?? 'Lia Kania Dewi, S.Si., M.M.' }}
            </p>
            <p style="margin: 2px 0 0 0;">
                NIP. {{ $nipPejabat ?? '__________________________' }}
            </p>
        </div>
        <div class="clear"></div>
    </div>

</body>
</html>