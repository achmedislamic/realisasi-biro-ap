<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('realisasi-menu', function (User $user, int|string $opdId = null, int|string $subOpdId = null) {
            return $user->isAdmin() || ($user->role->imageable_id == $opdId && $user->role->imageable_type == 'bidang') || ($user->role->imageable_id == $subOpdId && $user->role->imageable_type == 'sub_opd');
        });

        Gate::define('pengguna-menu', fn (User $user) => $user->isAdmin());

        Gate::define('is-admin', fn (User $user) => $user->isAdmin());

        Gate::define('crud-program', fn (User $user) => $user->isAdmin());
    }
}
