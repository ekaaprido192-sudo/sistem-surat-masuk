<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuks';

    protected $fillable = [
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

    public function disposisis(): HasMany
    {
        return $this->hasMany(Disposisi::class);
    }
}