<x-filament-widgets::widget>
    <x-filament::section>

        <div class="flex items-center gap-6">

            <img
                src="{{ asset('images/logo-bkad.png') }}"
                alt="Logo BKAD"
                style="width:90px; height:90px; object-fit:contain;"
            >

            <div>

                <h2 style="font-size:28px;font-weight:bold;color:#1d4ed8;">
                    Selamat Datang 👋
                </h2>

                <p style="font-size:18px;margin-top:8px;">
                    Sistem Pengolahan Data Surat Masuk
                </p>

                <p style="color:#666;">
                    Badan Keuangan dan Aset Daerah (BKAD)<br>
                    Kota Bogor
                </p>

                <hr style="margin:15px 0;">

                <p><strong>👤 Admin :</strong> {{ auth()->user()->name }}</p>
                <p><strong>📧 Email :</strong> {{ auth()->user()->email }}</p>
                <p><strong>📅 Tanggal :</strong> {{ now()->translatedFormat('l, d F Y') }}</p>

            </div>

        </div>

    </x-filament::section>
</x-filament-widgets::widget>