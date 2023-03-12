<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ObjekBelanja extends Model
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

    public function scopeWhereJenisBelanjaId($query, int $id): Builder
    {
        return $query->whereHas('jenisBelanja', function ($query) use ($id) {
            $query->where('jenis_belanja_id', $id);
        });
    }

    public function jenisBelanja(): BelongsTo
    {
        return $this->belongsTo(JenisBelanja::class);
    }

    public function rincianObjekBelanja(): HasMany
    {
        return $this->hasMany(RincianObjekBelanja::class);
    }
}
