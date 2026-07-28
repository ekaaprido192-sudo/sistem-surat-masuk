<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Form Surat Masuk -->
        <form wire:submit.prevent="cetakSuratMasuk" class="space-y-4 bg-white p-6 rounded-xl shadow-sm dark:bg-gray-800">
            {{ $this->suratMasukForm }}
            
            <div class="flex gap-3">
                <x-filament::button type="submit" icon="heroicon-o-printer">
                    Cetak PDF Surat Masuk
                </x-filament::button>

                <x-filament::button type="button" wire:click="exportExcelSuratMasuk" color="success" icon="heroicon-o-document-arrow-down">
                    Export Excel Surat Masuk
                </x-filament::button>
            </div>
        </form>

        <!-- Form Disposisi -->
        <form wire:submit.prevent="cetakDisposisi" class="space-y-4 bg-white p-6 rounded-xl shadow-sm dark:bg-gray-800">
            {{ $this->disposisiForm }}
            
            <div class="flex gap-3">
                <x-filament::button type="submit" icon="heroicon-o-printer">
                    Cetak PDF Disposisi
                </x-filament::button>

                <x-filament::button type="button" wire:click="exportExcelDisposisi" color="success" icon="heroicon-o-document-arrow-down">
                    Export Excel Disposisi
                </x-filament::button>
            </div>
        </form>
    </div>
</x-filament-panels::page>