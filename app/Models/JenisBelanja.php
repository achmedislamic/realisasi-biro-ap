<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JenisBelanja extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopePencarian(Builder $query, string $cari = ''): Builder
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('nama', $cari);
            });
        });
    }

    public function scopeWhereKelompokBelanjaId($query, int $id): Builder
    {
        return $query->whereHas('kelompokBelanja', function ($query) use ($id) {
            $query->where('kelompok_belanja_id', $id);
        });
    }

    public function kelompokBelanja(): BelongsTo
    {
        return $this->belongsTo(KelompokBelanja::class);
    }
}
