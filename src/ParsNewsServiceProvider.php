<?php

namespace AngusDV\ParsNews;

use AngusDV\ParsNews\Commands\DockerInstallCommand;
use AngusDV\ParsNews\Commands\RobotCommand;
use AngusDV\ParsNews\Entity\ApiUser;
use AngusDV\ParsNews\Entity\Article;
use AngusDV\ParsNews\Observers\ArticleObserver;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\ServiceProvider;

class ParsNewsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->commands([
            RobotCommand::class,
            DockerInstallCommand::class
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'ParsNews');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ParsNews');
        $this->loadRoutesFrom(__DIR__ . '/pars-news-routes.php');
        $this->loadSeeders();
        Article::observe(ArticleObserver::class);
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
           $seeder->call(\AngusDV\ParsNews\Database\Seeders\ApiUserSeeder::class);
           $seeder->call(\AngusDV\ParsNews\Database\Seeders\ArticleSeeder::class);
           $seeder->call(\AngusDV\ParsNews\Database\Seeders\CommentSeeder::class);
        });
    }

}
