<?php

namespace App\Providers;

use App\Models\CPB;
use App\Models\QC;
use App\Models\User;
use App\Policies\CPBPolicy;
use App\Policies\QCPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        CPB::class => CPBPolicy::class,
        QC::class => QCPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::define('Admin', function (User $user) {

            if ($user->role_id == 1) {
                return true;
            }

            return false;
        });

        Gate::define('General', function (User $user) {

            if ($user->role_id == 2) {
                return true;
            }
            return false;
        });

        Gate::define('Creator_cpbs', function (User $user) {

            if ($user->role_id == 3) {
                return true;
            }
            return false;
        });

        Gate::define('Editor', function (User $user) {

            if ($user->role_id == 4) {
                return true;
            }
            return false;
        });

        Gate::define('Creator_qcs', function (User $user) {

            if ($user->role_id == 5) {
                return true;
            }
            return false;
        });
    }
}
