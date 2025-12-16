<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            "question" => [
                "en" => fake()->text(),
                "ar" => fake()->text(),
            ],
            "answer" => [
                "en" => fake()->text(),
                "ar" => fake()->text(),
            ],
        ];
    }
}
