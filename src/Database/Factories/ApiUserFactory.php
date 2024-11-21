<?php

namespace AngusDV\ParsNews\Database\Factories;

use AngusDV\ParsNews\Entity\ApiUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<ApiUser>
 */
class ApiUserFactory extends Factory
{
    protected $model=\AngusDV\ParsNews\Entity\ApiUser::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>$this->faker->name,
            "email"=>$this->faker->email,
            "password"=>bcrypt(1),
        ];
    }
}
