<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class SubKegiatan extends Model
{
    use HasFactory;
    // use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $guarded = [];

    protected $table = 'sub_kegiatans';

    public function scopePencarian(Builder $query, string $cari = ''): Builder
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('kode', $cari)->search('nama', $cari);
            });
        });
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function objekRealisasis(): HasMany
    {
        return $this->hasMany(ObjekRealisasi::class);
    }

    public function realisasis()
    {
        return $this->hasManyThrough(
            Realisasi::class,
            ObjekRealisasi::class,
        );
    }
}
