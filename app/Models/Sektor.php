<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany, MorphOne};

class Sektor extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function opds(): HasMany
    {
        return $this->hasMany(Opd::class);
    }

    public function userRole(): MorphOne
    {
        return $this->morphOne(UserRole::class, 'imageable');
    }
}
