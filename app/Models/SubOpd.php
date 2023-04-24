<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, MorphOne};

class SubOpd extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function teksLengkap(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['kode'] . ' ' . $attributes['nama']
        );
    }

    public function isInduk(): bool
    {
        return $this->kode == '0000';
    }

    public function userRole(): MorphOne
    {
        return $this->morphOne(UserRole::class, 'imageable');
    }

    public function bidangUrusans(): BelongsToMany
    {
        return $this->belongsToMany(BidangUrusan::class, 'bidang_urusan_sub_opds')
            ->withTimestamps()
            ->withPivot('bidang_urusan_id');
    }

    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class);
    }

    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class);
    }

    public function scopePencarian(Builder $query, string $cari = ''): Builder
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('nama', $cari);
            });
        });
    }

    public function scopeWhereOpdId($query, int $id): Builder
    {
        return $query->whereHas('opd', function ($query) use ($id) {
            $query->where('opd_id', $id);
        });
    }
}
