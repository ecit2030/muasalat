<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => [
                'ar' => $this->faker->name,
                'en' => $this->faker->name,
            ],
            'active' => $this->faker->boolean,
            'parent_id' => $this->faker->numberBetween(1, Area::count()),
            'level' => $this->faker->numberBetween(0, 2),
        ];
    }


    function configure()
    {
        return "asdas";
    }
}
