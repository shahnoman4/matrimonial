<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        if(request()->hasHeader('authorization')) {
            Broadcast::routes(["middleware" => "auth:api"]); //is for the api clients requests(React Native App in my case)
        } else {
            Broadcast::routes();//is for the web requests
        }

        require base_path('routes/channels.php');

        //Broadcast::routes();

        //require base_path('routes/channels.php');
    }
}
