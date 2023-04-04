<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Opd extends Model
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

    public function scopeWhereBidangUrusanId($query, int $id): Builder
    {
        return $query->whereHas('bidangUrusans', function ($query) use ($id) {
            $query->where('bidang_urusan_id', $id);
        });
    }

    public function bidangUrusans(): BelongsToMany
    {
        return $this->belongsToMany(BidangUrusan::class, 'bidang_urusan_opds', 'opd_id', 'bidang_urusan_id')
        ->withTimestamps()
        ->withPivot('bidang_urusan_id')
        ->using(BidangUrusanOpd::class);
    }

    public function subOpds(): HasMany
    {
        return $this->hasMany(SubOpd::class);
    }
}
