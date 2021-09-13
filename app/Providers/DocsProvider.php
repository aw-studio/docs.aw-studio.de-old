<?php

namespace App\Providers;

use App\Docs\Documentor;
use App\Docs\Parser\Parser;
use Illuminate\Support\ServiceProvider;

class DocsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('docs', function ($app) {
            return new Documentor($app['docs.parser']);
        });

        $this->app->singleton('docs.parser', function () {
            return new Parser();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
