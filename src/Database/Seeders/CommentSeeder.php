<?php

namespace AngusDV\ParsNews\Database\Seeders;

use AngusDV\ParsNews\Database\Factories\CommentFactory;
use Illuminate\Database\Seeder;


class CommentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommentFactory::new()->count(10)->create();
    }
}
