<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Program extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $guarded = [];

    public function scopePencarian(Builder $query, string $cari = ''): Builder
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('kode', $cari)->search('nama', $cari);
            });
        });
    }

    public function kegiatans(): HasMany
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function objekRealisasis()
    {
        return $this->hasManyDeep(
            ObjekRealisasi::class,
            [Kegiatan::class, SubKegiatan::class],
            ['program_id', 'kegiatan_id', 'sub_kegiatan_id'],
            ['id', 'id', 'id']
        );
    }

    public function realisasis()
    {
        return $this->hasManyDeep(
            Realisasi::class,
            [Kegiatan::class, SubKegiatan::class, ObjekRealisasi::class],
            ['program_id', 'kegiatan_id', 'sub_kegiatan_id', 'objek_realisasi_id'],
            ['id', 'id', 'id', 'id']
        );
    }
}
