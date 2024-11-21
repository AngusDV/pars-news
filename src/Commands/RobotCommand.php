<?php

namespace AngusDV\ParsNews\Commands;

use Illuminate\Console\Command;

class RobotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robot:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command runs all system and sub-system migrations';

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
        $this->call('optimize:clear');

        // Run the installation:api command
        $this->info('Installing API...');
        if ($this->call('install:api') !== 0) {
            $this->error('API installation failed.');
            return 1;
        }

        // Run the migrate command
        $this->info('Running migrations...');
        if ($this->call('migrate',[
                '--force' => 'force',
            ]) !== 0) {
            $this->error('Migration failed.');
            return 1;
        }

        // Run the db:seed command
        $this->info('Seeding the database...');
        if ($this->call('db:seed',[
                '--force' => 'force',
            ]) !== 0) {
            $this->error('Database seeding failed.');
            return 1;
        }

        // Run storage:link command
        if ($this->call('storage:link') !== 0) {
            $this->error('Failed to create storage link.');
            return 1;
        }

        $this->info('Storage link created successfully.');



        $this->info('API installation completed successfully!');
        return 0;


    }

}
