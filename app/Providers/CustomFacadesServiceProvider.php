<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CustomFacadesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        App::bind('bitrix',function() {
            return new \App\Repositories\BitrixFacades;
         });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
