<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Kegiatan extends Model
{
    use HasFactory;
    // use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $guarded = [];

    public function scopePencarian(Builder $query, string $cari = ''): Builder
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('kode', $cari)->search('nama', $cari);
            });
        });
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function subKegiatans(): HasMany
    {
        return $this->hasMany(SubKegiatan::class);
    }

    public function objekRealisasis()
    {
        return $this->hasManyThrough(
            ObjekRealisasi::class,
            SubKegiatan::class,
        );
    }

    // public function realisasis()
    // {
    //     return $this->hasManyDeep(
    //         Realisasi::class,
    //         [SubKegiatan::class, ObjekRealisasi::class],
    //         ['kegiatan_id', 'sub_kegiatan_id', 'objek_realisasi_id'],
    //         ['id', 'id', 'id']
    //     );
    // }
}
