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
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('surat_masuk_id')
                  ->constrained('surat_masuks')
                  ->cascadeOnDelete();

            $table->string('tujuan_bidang');

            $table->text('instruksi');

            $table->enum('sifat', [
                'Biasa',
                'Penting',
                'Rahasia'
            ]);

            $table->date('tgl_disposisi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};