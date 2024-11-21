<?php

namespace AngusDV\ParsNews\Database\Seeders;

use AngusDV\ParsNews\Database\Factories\ApiUserFactory;
use AngusDV\ParsNews\Database\Factories\ArticleFactory;
use AngusDV\ParsNews\Entity\ApiUser;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ApiUser::get() as $user) {
            ArticleFactory::new()->count(10)->create()->each(function($article)use($user){
                    $article->creator_id=$user->id;
                    $article->user_id=$user->id;
                    $article->save();
            });
        }

    }
}
