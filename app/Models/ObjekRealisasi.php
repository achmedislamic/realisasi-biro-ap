<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class ObjekRealisasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tahapanApbd(): BelongsTo
    {
        return $this->belongsTo(TahapanApbd::class);
    }

    public function subOpd(): BelongsTo
    {
        return $this->belongsTo(SubOpd::class);
    }

    public function subKegiatan(): BelongsTo
    {
        return $this->belongsTo(SubKegiatan::class);
    }

    public function subRincianObjekBelanja(): BelongsTo
    {
        return $this->belongsTo(SubRincianObjekBelanja::class, 'sub_rincian_objek_id');
    }

    public function realisasi(): HasMany
    {
        return $this->hasMany(Realisasi::class);
    }

     public function scopePencarian(Builder $query, string $cari = ''): Builder
     {
         return $query->when($cari, function ($query) use ($cari) {
             $query->where(function ($query) use ($cari) {
                 $query->search('anggaran', $cari);
             });
         });
     }
}
