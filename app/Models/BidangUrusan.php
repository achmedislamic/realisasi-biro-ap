<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BidangUrusan extends Model
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

    public function scopeWhereUrusanId($query, int $id): Builder
    {
        return $query->whereHas('urusan', function ($query) use ($id) {
            $query->where('urusan_id', $id);
        });
    }

    public function urusan(): BelongsTo
    {
        return $this->belongsTo(Urusan::class);
    }

    public function opds(): BelongsToMany
    {
        return $this->belongsToMany(Opd::class, 'bidang_urusan_opds', 'bidang_urusan_id')
        ->withTimestamps();
    }
}