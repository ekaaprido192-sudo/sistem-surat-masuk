<x-filament-panels::page>

    <div class="space-y-8">

        {{-- ================= LAPORAN SURAT MASUK ================= --}}
        <div class="rounded-xl border bg-white p-6 shadow-sm dark:bg-gray-900">

            <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                Laporan Surat Masuk
            </h2>

            <p class="mb-6 text-sm text-gray-500">
                Cetak atau export laporan surat masuk berdasarkan periode tanggal.
            </p>

            <form wire:submit.prevent="cetakSuratMasuk" class="space-y-5">

                {{ $this->suratMasukForm }}

                <div class="flex flex-wrap gap-3">

                    <x-filament::button
                        type="submit"
                        icon="heroicon-o-printer">

                        Cetak PDF
                    </x-filament::button>

                    <x-filament::button
                        type="button"
                        color="success"
                        wire:click="exportExcelSuratMasuk"
                        icon="heroicon-o-document-arrow-down">

                        Export Excel
                    </x-filament::button>

                </div>

            </form>

        </div>

        {{-- ================= LAPORAN DISPOSISI ================= --}}
        <div class="rounded-xl border bg-white p-6 shadow-sm dark:bg-gray-900">

            <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                Laporan Disposisi
            </h2>

            <p class="mb-6 text-sm text-gray-500">
                Cetak atau export laporan disposisi berdasarkan periode tanggal.
            </p>

            <form wire:submit.prevent="cetakDisposisi" class="space-y-5">

                {{ $this->disposisiForm }}

                <div class="flex flex-wrap gap-3">

                    <x-filament::button
                        type="submit"
                        icon="heroicon-o-printer">

                        Cetak PDF
                    </x-filament::button>

                    <x-filament::button
                        type="button"
                        color="success"
                        wire:click="exportExcelDisposisi"
                        icon="heroicon-o-document-arrow-down">

                        Export Excel
                    </x-filament::button>

                </div>

            </form>

        </div>

    </div>

</x-filament-panels::page>