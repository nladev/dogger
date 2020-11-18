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
        // Publish config
        $this->publishes([
            __DIR__.'/../config/dogger.php' => config_path('dogger.php')
        ], 'config');

        //Load database migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dogger');

        //Load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        
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