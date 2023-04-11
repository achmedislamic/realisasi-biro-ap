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

    public function selisihRealisasi($realisasiId = null): int
    {
        $totalRealisasi = Realisasi::query()
            ->where('objek_realisasi_id', $this->id)
            ->when(filled($realisasiId), function ($query) use ($realisasiId) {
                $query->where('id', '!=', $realisasiId);
            })->sum('jumlah');

        return $this->anggaran - $totalRealisasi;
    }

    public function bidangUrusanSubOpd(): BelongsTo
    {
        return $this->belongsTo(BidangUrusanSubOpd::class);
    }

    public function tahapanApbd(): BelongsTo
    {
        return $this->belongsTo(TahapanApbd::class);
    }

    public function subKegiatan(): BelongsTo
    {
        return $this->belongsTo(SubKegiatan::class);
    }

    public function subRincianObjekBelanja(): BelongsTo
    {
        return $this->belongsTo(SubRincianObjekBelanja::class, 'sub_rincian_objek_id');
    }

    public function realisasis(): HasMany
    {
        return $this->hasMany(Realisasi::class);
    }

     public function scopePencarian(Builder $query, string $cari = ''): Builder
     {
         return $query->when($cari, function ($query) use ($cari) {
             $query->where(function ($query) use ($cari) {
                 $query->search('anggaran', $cari)
                    ->search('objek_realisasis.anggaran', $cari)
                    ->search('opds.kode', $cari)
                    ->search('sub_opds.kode', $cari)
                    ->search('sub_opds.nama', $cari)
                    ->search('sub_rincian_objek_belanjas.kode', $cari)
                    ->search('sub_rincian_objek_belanjas.nama', $cari);
             });
         });
     }
}
