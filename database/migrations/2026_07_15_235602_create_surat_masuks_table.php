<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_masuks', function (Blueprint $table) {

            $table->id();

            // Nomor surat dibuat unik agar tidak ada data ganda
            $table->string('nomor_surat')->unique();

            $table->date('tanggal_surat');

            $table->date('tanggal_diterima');

            $table->string('asal_surat');

            $table->string('perihal');

            $table->string('tujuan');

            $table->enum('sifat', [
                'Biasa',
                'Penting',
                'Rahasia',
            ]);

            // Menyimpan lokasi file PDF
            $table->string('file_surat')->nullable();

            $table->enum('status', [
                'Baru',
                'Diproses',
                'Selesai',
            ])
            ->default('Baru')
            ->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};