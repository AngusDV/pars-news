<?php

namespace AngusDV\ParsNews;

use AngusDV\ParsNews\Entity\ApiUser;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\ServiceProvider;

class ParsNewsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'ParsNews');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ParsNews');
        $this->publishes([
            __DIR__.'/../resources/docker/Dockerfile' => base_path(),
            __DIR__.'/../resources/docker/nginx' => base_path('docker/'),
            __DIR__.'/../resources/docker/php' => base_path('docker/'),
            __DIR__.'/../resources/docker/entrypoint.sh' => base_path('docker/'),
        ], 'pars-news');
        $this->loadRoutesFrom(__DIR__ . '/pars-news-routes.php');
        $this->loadSeeders();

    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (!file_exists(config_path('pars-news.php'))) {
            $this->mergeConfigFrom(__DIR__ . '/../config/pars-news.php', 'pars-news');
        }else{
            $this->mergeConfigFrom(config_path('pars-news.php'), 'pars-news');
        }
        $this->publishes([
            __DIR__ . '/../config/pars-news.php' => config_path('pars-news.php'),
        ]);
    }

    protected function loadSeeders(){
        $this->callAfterResolving(DatabaseSeeder::class, function ($seeder)  {
           $seeder->call(\AngusDV\ParsNews\Database\Seeders\ApiUser::class);
        });
    }
}
