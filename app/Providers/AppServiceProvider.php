<?php

namespace App\Providers;
Use View;
Use DB;
Use App\Adminmenu;
use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::routes();
        Schema::defaultStringLength(191);
        View::composer('*', function($view)
        {
            $adminmenus=\App\Adminmenu::wherenull('parentid')->where('showinnav',1)->with('childrenformenu')->get();
            
            $view->with('navs',$adminmenus);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
