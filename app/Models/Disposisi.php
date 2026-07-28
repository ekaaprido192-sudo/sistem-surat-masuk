<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disposisi extends Model
{
    protected $fillable = [
        'surat_masuk_id',
        'tujuan_bidang',
        'instruksi',
        'sifat',
        'tgl_disposisi',
    ];

    public function suratMasuk(): BelongsTo
    {
        return $this->belongsTo(SuratMasuk::class);
    }
}