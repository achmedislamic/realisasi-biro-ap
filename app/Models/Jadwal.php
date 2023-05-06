<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model};

class Jadwal extends Model
{
    use HasFactory;

    protected $casts = [
        'tanggal_waktu' => 'datetime',
        'bulan' => 'datetime',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function booted(): void
    {
        static::addGlobalScope('tahapan-apbd', function (Builder $builder) {
            $builder->whereYear('bulan', cache('tahapanApbd')->tahun);
        });
    }
}
