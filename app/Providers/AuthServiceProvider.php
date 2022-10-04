<?php

namespace App\Providers;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerDashboardPolicies();
        $this->registerAdminsPolicies();
        $this->registerAdminmenuPolicies();
        $this->customers();
        $this->country();
        $this->page();
        Passport::routes();

        //
    }


    //country
    public function page(){
        
        Gate::define('page-index', function($user){
            return $user->hasAccess(['page-index']);
        });

        Gate::define('page-fetch', function($user){
            return $user->hasAccess(['page-fetch']);
        });

        Gate::define('page-create', function($user){
            return $user->hasAccess(['page-create']);
        });

        Gate::define('page-store', function($user){
            return $user->hasAccess(['page-store']);
        });

        Gate::define('page-edit', function($user){
            return $user->hasAccess(['page-edit']);
        });
        Gate::define('page-show', function($user){
            return $user->hasAccess(['page-show']);
        });

        Gate::define('page-active', function($user){
            return $user->hasAccess(['page-active']);
        });
        Gate::define('page-disable', function($user){
            return $user->hasAccess(['page-disable']);
        });
    }


    //country
    public function country(){
        
        Gate::define('country-index', function($user){
            return $user->hasAccess(['country-index']);
        });

        Gate::define('country-fetch', function($user){
            return $user->hasAccess(['country-fetch']);
        });

        Gate::define('country-store', function($user){
            return $user->hasAccess(['country-store']);
        });

        Gate::define('country-edit', function($user){
            return $user->hasAccess(['country-edit']);
        });
        Gate::define('country-show', function($user){
            return $user->hasAccess(['country-show']);
        });

        Gate::define('country-active', function($user){
            return $user->hasAccess(['country-active']);
        });
        Gate::define('country-disable', function($user){
            return $user->hasAccess(['country-disable']);
        });
    }

    
    //customers
    public function customers(){
        
        Gate::define('customers-index', function($user){
            return $user->hasAccess(['customers-index']);
        });

        Gate::define('customers-create', function($user){
            return $user->hasAccess(['customers-create']);
        });
        Gate::define('customers-fetch', function($user){
            return $user->hasAccess(['customers-fetch']);
        });

        Gate::define('customers-store', function($user){
            return $user->hasAccess(['customers-store']);
        });

        Gate::define('customers-edit', function($user){
            return $user->hasAccess(['customers-edit']);
        });
        Gate::define('customers-show', function($user){
            return $user->hasAccess(['customers-show']);
        });

        Gate::define('customers-active', function($user){
            return $user->hasAccess(['customers-active']);
        });
        Gate::define('customers-disable', function($user){
            return $user->hasAccess(['customers-disable']);
        });
    }

    

    public function registerAdminmenuPolicies(){
    
        Gate::define('menu-index', function($user){
            return $user->hasAccess(['menu-index']);
        });

    }


    
    //Dashboard
    public function registerDashboardPolicies(){
    
       /* Gate::define('stats-number', function($user){
            return $user->hasAccess(['stats-number']);
        });

       */

    }
    

    //Sub Admins
    public function registerAdminsPolicies(){
        Gate::define('admins-index', function($user){
            return $user->hasAccess(['admins-index']);
        });

        Gate::define('create-staff', function($user){
            return $user->hasAccess(['create-staff']);
        });

        Gate::define('edit-staff', function($user){
            return $user->hasAccess(['edit-staff']);
        });

        Gate::define('status-staff', function($user){
            return $user->hasAccess(['status-staff']);
        });

        Gate::define('show-staff', function($user){
            return $user->hasAccess(['show-staff']);
        });
        
        Gate::define('delete-staff', function($user){
            return $user->hasAccess(['delete-staff']);
        });


        Gate::define('staff-reset-password', function($user){
            return $user->hasAccess(['staff-reset-password']);
        });
    }

}
