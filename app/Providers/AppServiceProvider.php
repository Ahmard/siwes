<?php

namespace App\Providers;

use App\Helpers\Core\AlertFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('siwes.resp.handler', function (){
            return new AlertFactory();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require(app_path('Helpers/Functions.php'));
    }
}
