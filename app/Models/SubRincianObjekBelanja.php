<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubRincianObjekBelanja extends Model
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

    public function scopeWhereRincianObjekBelanjaId($query, int $id): Builder
    {
        return $query->whereHas('rincianObjekBelanja', function ($query) use ($id) {
            $query->where('rincian_objek_belanja_id', $id);
        });
    }

    public function rincianObjekBelanja(): BelongsTo
    {
        return $this->belongsTo(RincianObjekBelanja::class);
    }

    public function rincianBelanjas(): HasMany
    {
        return $this->hasMany(RincianBelanja::class);
    }
}
