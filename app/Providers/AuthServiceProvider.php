<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::define('it', function($user) {

            return in_array("Domain Admins", session('memberOf'));
        });

        Gate::define('credentials', function($user) {
            if (Gate::allows('it'))
            {
                return true;
            }
            if(in_array("Credentials-App", session('memberOf')))
            {
                return true;
            }
         });

        Gate::define('onBoarding', function($user) {
            if (Gate::allows('it'))
            {
                return true;
            }
            if(in_array("Onboarding-App", session('memberOf')))
            {
                return true;
            }
         });

         Gate::define('callMonitor', function($user) {
            if (Gate::allows('it'))
            {
                return true;
            }
            return in_array("Call-Monitor-App", session('memberOf'));
         });

         Gate::define('trainingMaintenance', function($user) {
            if (Gate::allows('it'))
            {
                return true;
            }
            return in_array("Training-App", session('memberOf'));

         });

         Gate::define('offBoarding', function($user) {

            if (Gate::allows('it'))
            {
                return true;
            }

            return in_array("Offboarding-App", session('memberOf'));

         });

        Gate::define('team-planner', function($user) {
            if (Gate::allows('it'))
            {
                return true;
            }
            return in_array("Team-Planner", session('memberOf'));
        });

        Gate::define('recruitment', function($user) {
            if (Gate::allows('it'))
            {
                return true;
            }
            return in_array("Recruitment-App", session('memberOf'));
        });

        Gate::define('hr', function($user) {
            if (Gate::allows('it'))
            {
                return true;
            }
            if (Gate::allows('onBoarding'))
            {
                return true;
            }

        });

        Gate::define('featureOff', function($user) {
            return in_array("", session('memberOf'));
        });

    }
}
