<?php

namespace Database\Factories;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 2),
            'article_id' => rand(1, 20),
            'comment' => $this->faker->text,
        ];
    }
}
