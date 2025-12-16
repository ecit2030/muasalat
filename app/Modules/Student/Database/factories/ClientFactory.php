<?php

namespace Modules\Student\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\City\Entities\City;
use Modules\Nationality\Entities\Nationality;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Client\Entities\Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birth_date' => $this->faker->date(),
            'nationality_id' => Nationality::factory()->create()->id,
            'gender' => 1,
            'city_id' =>  City::factory()->create()->id,
            'email'  => $this->faker->email(),
            'phone'  => $this->faker->phoneNumber(),
            'password' => bcrypt('123456'),
        ];
    }
}
