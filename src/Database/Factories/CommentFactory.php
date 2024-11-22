<?php

namespace AngusDV\ParsNews\Database\Factories;


use AngusDV\ParsNews\Entity\ApiUser;
use AngusDV\ParsNews\Entity\Article;
use AngusDV\ParsNews\Entity\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Comment>
 */
class CommentFactory extends Factory
{
    protected $model=\AngusDV\ParsNews\Entity\Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId=ApiUser::query()->inRandomOrder()->first()->id;
        $articleId=Article::query()->inRandomOrder()->first()->id;
        return [
            "article_id"=>$articleId,
            "user_id"=>$userId,
            "comment"=>$this->faker->text,
        ];
    }
}
