<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => rtrim($this->faker->sentence(rand(2,3)), '.'),
            'body' => $this->faker->paragraphs(rand(1, 3), true),
            'views' => rand(2, 20),
            'vote' => rand(-5, 11)
            //'answers_count' => rand(0, 4) we set it dynamically in answer model by calling boot method
        ];
    }
}
