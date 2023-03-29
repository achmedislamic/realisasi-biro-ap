<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;
use Znck\Eloquent\Relations\BelongsToThrough;

class Realisasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopePencarian(Builder $query, string $cari = ''): Builder
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('tanggal', $cari)->search('realisasi', $cari);
            });
        });
    }

    public function objekRealisasi(): BelongsTo
    {
        return $this->belongsTo(ObjekRealisasi::class);
    }
}
