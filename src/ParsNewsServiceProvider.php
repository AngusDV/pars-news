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
        $this->copyFilesIfNotExists();
    }

    protected function loadSeeders(){
        $this->callAfterResolving(DatabaseSeeder::class, function ($seeder)  {
           $seeder->call(\AngusDV\ParsNews\Database\Seeders\ApiUser::class);
        });
    }
    protected function copyFilesIfNotExists()
    {
        $filesToCopy = [
            __DIR__ . '/../resources/docker/Dockerfile' => base_path('Dockerfile'),
            __DIR__ . '/../resources/docker/nginx' => base_path('docker/nginx'),
            __DIR__ . '/../resources/docker/php' => base_path('docker/php'),
            __DIR__ . '/../resources/docker/entrypoint.sh' => base_path('docker/entrypoint.sh'),
        ];

        foreach ($filesToCopy as $source => $destination) {
            // Check if the destination file or directory already exists
            if (!file_exists($destination)) {
                // Determine if the source is a directory or file
                if (is_dir($source)) {
                    // Create the destination directory
                    mkdir($destination, 0755, true);
                    // Copy contents of the directory
                    $this->copyDirectory($source, $destination);
                } else {
                    // Copy the file
                    copy($source, $destination);
                }
            }
        }
    }

    protected function copyDirectory($source, $destination)
    {
        // Create the directory if it doesn't exist
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }
        // Iterate through the files and directories
        $items = scandir($source);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue; // Skip current and parent directory entries
            }
            $sourcePath = $source . '/' . $item;
            $destinationPath = $destination . '/' . $item;

            if (is_dir($sourcePath)) {
                // Recursively copy the directory
                $this->copyDirectory($sourcePath, $destinationPath);
            } else {
                // Copy the file
                if (!file_exists($destinationPath)) {
                    copy($sourcePath, $destinationPath);
                }
            }
        }
    }
}
