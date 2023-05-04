<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Satuan extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function objekRealisasi(): HasOne
    {
        return $this->hasOne(ObjekRealisasi::class);
    }

    public function scopePencarian(Builder $query, string $cari = ''): Builder
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('nama', $cari);
            });
        });
    }
}
