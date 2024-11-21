<?php

namespace AngusDV\ParsNews\Database\Seeders;

use AngusDV\ParsNews\Database\Factories\ApiUserFactory;
use AngusDV\ParsNews\Database\Factories\ArticleFactory;
use AngusDV\ParsNews\Entity\ApiUser;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;


class ArticleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Faker::class);

            ArticleFactory::new()->count(10)->create()->each(function ($article) use ($faker) {
                // Set the file in the media library
                $article->setFile(UploadedFile::fake()->create('test5.png', 50), 'articles');
            });


    }
}
