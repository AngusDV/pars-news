<?php

namespace AngusDV\ParsNews\Database\Factories;


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
        return [
            "title"=>$this->faker->title,
            "description"=>$this->faker->text
        ];
    }
}
