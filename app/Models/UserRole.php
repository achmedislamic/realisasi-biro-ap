<?php

namespace App\Models;

use App\Enums\RoleName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, MorphTo};

class UserRole extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'role_name' => RoleName::class,
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subOpd(): BelongsTo
    {
        return $this->belongsTo(SubOpd::class);
    }
}
