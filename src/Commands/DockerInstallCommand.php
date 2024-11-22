<?php

namespace AngusDV\ParsNews\Commands;

use Illuminate\Console\Command;

class DockerInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pars-news:install-docker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command make docker-compose.yml and Dockerfile.yml to root of project.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->copyFilesIfNotExists();
    }
    protected function copyFilesIfNotExists()
    {
        $filesToCopy = [
            __DIR__ . '/../../resources/docker/docker-compose.yml' => base_path('docker-compose.yml'),
            __DIR__ . '/../../resources/docker/Dockerfile' => base_path('Dockerfile'),
            __DIR__ . '/../../resources/docker/nginx' => base_path('docker/nginx'),
            __DIR__ . '/../../resources/docker/php' => base_path('docker/php'),
            __DIR__ . '/../../resources/docker/entrypoint.sh' => base_path('docker/entrypoint.sh'),
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
