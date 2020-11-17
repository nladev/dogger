<?php

namespace Cracki\Dogger;

use Illuminate\Support\ServiceProvider;
use Cracki\Dogger\DlogInterface;
use Cracki\Dogger\Http\Middleware\Dogger as DoggerMiddleware;
use Cracki\Dogger\Dogger;

class DoggerServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/dogger.php' => config_path('dogger.php')
        ], 'config');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {
        $instance = Dogger::class;

        $this->mergeConfigFrom(
            __DIR__.'/../config/dogger.php', 'dogger'
        );
        $this->app->singleton(DlogInterface::class,$instance);

        $this->app->singleton('dogger', function ($app) use ($instance){
            return new DoggerMiddleware($app->make($instance));
        });
    }
}