<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disposisi extends Model
{
    protected $table = 'disposisis';

    protected $fillable = [
        'surat_masuk_id',
        'tujuan_bidang',
        'instruksi',
        'sifat',
        'tgl_disposisi',
    ];

    protected $casts = [
        'tgl_disposisi' => 'date',
    ];

    protected static function booted(): void
    {
        // Jika data disposisi dihapus, periksa dan kembalikan status surat ke 'Baru' bila tidak ada disposisi lain
        static::deleted(function (Disposisi $disposisi): void {
            if ($disposisi->suratMasuk) {
                $sisaDisposisi = self::where('surat_masuk_id', $disposisi->surat_masuk_id)->count();
                if ($sisaDisposisi === 0 && $disposisi->suratMasuk->status === 'Diproses') {
                    $disposisi->suratMasuk->update([
                        'status' => 'Baru',
                    ]);
                }
            }
        });
    }

    public function suratMasuk(): BelongsTo
    {
        return $this->belongsTo(
            SuratMasuk::class,
            'surat_masuk_id',
            'id'
        );
    }
}