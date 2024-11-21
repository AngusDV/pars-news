<?php

namespace AngusDV\ParsNews\Database\Seeders;

use AngusDV\ParsNews\Database\Factories\ApiUserFactory;
use Illuminate\Database\Seeder;

class ApiUserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApiUserFactory::new()->count(10)->create();
    }
}
