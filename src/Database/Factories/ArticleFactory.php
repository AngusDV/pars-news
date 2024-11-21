<?php

namespace AngusDV\ParsNews\Database\Factories;


use AngusDV\ParsNews\Entity\ApiUser;
use AngusDV\ParsNews\Entity\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Article>
 */
class ArticleFactory extends Factory
{
    protected $model=\AngusDV\ParsNews\Entity\Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId=ApiUser::query()->inRandomOrder()->first()->id;
        return [
            "user_id"=>$userId,
            "creator_id"=>$userId,
            "title"=>$this->faker->title,
            "description"=>$this->faker->text
        ];
    }
}
