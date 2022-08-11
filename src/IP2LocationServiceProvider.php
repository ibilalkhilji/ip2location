<?php


use Illuminate\Support\ServiceProvider;

class IP2LocationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/ip2location.php' => config_path('ip2location.php')
        ]);
    }

    public function register()
    {
        parent::register();
        $this->app->singleton(IP2Location::class, function () {
            return new IP2Location();
        });
    }
}
