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
        ApiUserFactory::new()->count(1)->create()->each(function ($apiUser){
            $apiUser->email="superadmin@test.com";
            $apiUser->type="api";
            $apiUser->password=bcrypt("123");
            $apiUser->save();
        });
        ApiUserFactory::new()->count(10)->create();
    }
}
