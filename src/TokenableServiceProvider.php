<?php

namespace Stokoe;

use Illuminate\Support\ServiceProvider;

class TokenableServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tokenable.php' => config_path('tokenable.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }
}