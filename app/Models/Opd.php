<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany, MorphOne};

class Opd extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function teksLengkap(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['kode'] . ' ' . $attributes['nama']
        );
    }

    public function userRole(): MorphOne
    {
        return $this->morphOne(UserRole::class, 'imageable');
    }

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

    public function subOpds(): HasMany
    {
        return $this->hasMany(SubOpd::class);
    }
}
