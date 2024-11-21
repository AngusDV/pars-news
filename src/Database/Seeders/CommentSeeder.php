<?php

namespace AngusDV\ParsNews\Database\Seeders;

use AngusDV\ParsNews\Database\Factories\ApiUserFactory;
use AngusDV\ParsNews\Database\Factories\ArticleFactory;
use AngusDV\ParsNews\Database\Factories\CommentFactory;
use AngusDV\ParsNews\Entity\ApiUser;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;


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
