<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleName;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['role'];

    public function role(): HasOne
    {
        return $this->hasOne(UserRole::class);
    }

    public function isAdmin(): bool
    {
        return $this->role->role_name === RoleName::ADMIN;
    }

    public function isAdminOrSektor(): bool
    {
        return $this->isAdmin() || $this->isSektor();
    }

    public function isNotAdmin(): bool
    {
        return ! $this->isAdmin();
    }

    public function isOpd(): bool
    {
        return $this->role->role_name === RoleName::OPD;
    }

    public function isSubOpd(): bool
    {
        return $this->role->role_name === RoleName::SUB_OPD;
    }

    public function isSektor(): bool
    {
        return $this->role->role_name === RoleName::SEKTOR;
    }

    public function scopePencarian(Builder $query, string $cari = ''): Builder
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('name', $cari)
                    ->search('email', $cari);
            });
        });
    }
}
