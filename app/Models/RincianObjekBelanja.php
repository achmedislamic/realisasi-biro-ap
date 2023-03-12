<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RincianObjekBelanja extends Model
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

    public function scopeWhereObjekBelanjaId($query, int $id): Builder
    {
        return $query->whereHas('objekBelanja', function ($query) use ($id) {
            $query->where('objek_belanja_id', $id);
        });
    }

    public function objekBelanja(): BelongsTo
    {
        return $this->belongsTo(ObjekBelanja::class);
    }

    public function subRincianObjekBelanja(): HasMany
    {
        return $this->hasMany(SubRincianObjekBelanja::class);
    }
}
