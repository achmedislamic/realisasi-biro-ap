<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopePencarian(Builder $query, string $cari = ''): Builder
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('kode', $cari)->search('nama', $cari);
            });
        });
    }

     public function scopeWhereProgramId($query, int $id): Builder
     {
         return $query->whereHas('program', function ($query) use ($id) {
             $query->where('program_id', $id);
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
}
