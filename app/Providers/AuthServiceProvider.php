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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('pilih-opd', function (User $user, int $opdId) {
            if($user->isOpd()){
                return $user->role->imageable_id === $opdId;
            }

            return true;
        });

        Gate::define('pilih-sub-opd', function (User $user, int $subOpdId) {
            if($user->isSubOpd()){
                return $user->role->imageable_id === $subOpdId;
            }

            return true;
        });
    }
}
