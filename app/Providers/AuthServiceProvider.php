<?php

namespace App\Providers;

use App\Models\CPB;
use App\Models\ExhaustDyeing;
use App\Models\FabricInformationBoard;
use App\Models\GreyDashboard;
use App\Models\QC;
use App\Models\TrimsAccessoriesStore;
use App\Models\User;
use App\Models\YarnDashboard;
use App\Policies\CPBPolicy;
use App\Policies\ExhaustDyeingPolicy;
use App\Policies\FabricInformationBoardPolicy;
use App\Policies\GreyDashboardPolicy;
use App\Policies\QCBPolicy;
use App\Policies\TrimsAccessoriesStorePolicy;
use App\Policies\YarnDashboardPolicy;
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
        QC::class => QCBPolicy::class,
        GreyDashboard::class => GreyDashboardPolicy::class,
        YarnDashboard::class => YarnDashboardPolicy::class,
        FabricInformationBoard::class => FabricInformationBoardPolicy::class,
        TrimsAccessoriesStore::class => TrimsAccessoriesStorePolicy::class,
        ExhaustDyeing::class => ExhaustDyeingPolicy::class,
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

        Gate::define('Creator_yarn', function (User $user) {

            if ($user->role_id == 6) {
                return true;
            }
            return false;
        });

        Gate::define('Creator_grey', function (User $user) {

            if ($user->role_id == 7) {
                return true;
            }
            return false;
        });

        Gate::define('Editor_fabrics', function (User $user) {

            if ($user->role_id == 8) {
                return true;
            }
            return false;
        });

        Gate::define('Creator_fabrics', function (User $user) {

            if ($user->role_id == 9) {
                return true;
            }
            return false;
        });

        Gate::define('Creator_trim', function (User $user) {

            if ($user->role_id == 10) {
                return true;
            }
            return false;
        });

        Gate::define('Editor_garments', function (User $user) {

            if ($user->role_id == 11) {
                return true;
            }
            return false;
        });

        Gate::define('Creator_eds', function (User $user) {

            if ($user->role->name == 'Creator_eds') {
                return true;
            }
            return false;
        });
    }
}
