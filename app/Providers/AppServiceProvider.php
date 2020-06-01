<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Console\Commands\ModelMakeCommand;
use Illuminate\Contracts\View\View;
use App\Models\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend('command.model.make', function ($command, $app) {
            return new ModelMakeCommand($app['files']);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Brazil
        // date_default_timezone_set('America/Bahia');
        // date_default_timezone_set('America/Sao_Paulo');
        // Canada
        date_default_timezone_set('America/Montreal');

        // Fetch the Site Configs object
        view()->composer('*', function(View $view) {
            $configs = Config::find(1);;
            $view->with('configs', $configs);
        });

    }
}
