<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KelompokBelanja extends Model
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

    public function scopeWhereAkunBelanjaId($query, int $id): Builder
    {
        return $query->whereHas('akunBelanja', function ($query) use ($id) {
            $query->where('akun_belanja_id', $id);
        });
    }

    public function akunBelanja(): BelongsTo
    {
        return $this->belongsTo(AkunBelanja::class);
    }

    public function jenisBelanja(): HasMany
    {
        return $this->hasMany(JenisBelanja::class);
    }
}
