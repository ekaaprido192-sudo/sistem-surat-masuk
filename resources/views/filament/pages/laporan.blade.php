<x-filament-panels::page>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Form Laporan Surat Masuk -->
        <div class="space-y-4">
            {{ $this->suratMasukForm }}
            <x-filament::button 
                wire:click="cetakSuratMasuk" 
                color="warning" 
                icon="heroicon-o-printer" 
                class="w-full justify-center">
                Cetak PDF Surat Masuk
            </x-filament::button>
        </div>

        <!-- Form Laporan Disposisi -->
        <div class="space-y-4">
            {{ $this->disposisiForm }}
            <x-filament::button 
                wire:click="cetakDisposisi" 
                color="warning" 
                icon="heroicon-o-printer" 
                class="w-full justify-center">
                Cetak PDF Disposisi
            </x-filament::button>
        </div>

    </div>
</x-filament-panels::page>