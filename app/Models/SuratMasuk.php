<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuks';

    protected $fillable = [
        'nomor_agenda',
        'nomor_surat',
        'tanggal_surat',
        'tanggal_diterima',
        'asal_surat',
        'perihal',
        'tujuan',
        'sifat',
        'file_surat',
        'status',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_diterima' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (SuratMasuk $surat): void {
            // Generate Nomor Agenda Otomatis (AGD-0001, AGD-0002, dst.)
            if (empty($surat->nomor_agenda)) {
                $lastRecord = self::query()
                    ->whereNotNull('nomor_agenda')
                    ->where('nomor_agenda', 'like', 'AGD-%')
                    ->orderByDesc('id')
                    ->first();

                if ($lastRecord && preg_match('/AGD-(\d+)/', $lastRecord->nomor_agenda, $matches)) {
                    $nextNumber = ((int) $matches[1]) + 1;
                } else {
                    $nextNumber = 1;
                }

                $surat->nomor_agenda = 'AGD-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }

            // Default status saat pertama kali diinput
            if (empty($surat->status)) {
                $surat->status = 'Baru';
            }
        });
    }

    /**
     * Relasi ke seluruh riwayat disposisi surat
     */
    public function disposisis(): HasMany
    {
        return $this->hasMany(
            Disposisi::class,
            'surat_masuk_id',
            'id'
        );
    }

    /**
     * Relasi ke disposisi terbaru / aktif
     */
    public function disposisiTerbaru(): HasOne
    {
        return $this->hasOne(
            Disposisi::class,
            'surat_masuk_id',
            'id'
        )->latestOfMany();
    }
}