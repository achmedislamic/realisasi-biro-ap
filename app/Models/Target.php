<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, MorphTo};

class Target extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function booted(): void
    {
        static::addGlobalScope('tahun', function (Builder $builder) {
            $builder->where('tahun', cache('tahapanApbd')->tahun);
        });
    }

    protected function jumlah(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (float) str($value)->replace('.', ',')->toString()
        );
    }

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class);
    }
}
