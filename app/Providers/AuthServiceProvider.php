<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\{Jadwal, User};
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
        Gate::define('ubah-realisasi', function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }

            $jadwal = Jadwal::firstWhere('is_aktif', true);

            return $jadwal->tanggal_waktu > now();
        });

        Gate::define('realisasi-menu', function (User $user, int|string $opdId = null, int|string $subOpdId = null) {
            if ($user->isAdmin()) {
                return true;
            }

            return $user->role->imageable_id == $opdId || $user->role->imageable_id == $subOpdId;
        });

        Gate::define('pengguna-menu', function (User $user) {
            return $user->isAdmin() || $user->isOpd();
        });

        Gate::define('is-admin', function (User $user) {
            return $user->isAdmin();
        });
    }
}
