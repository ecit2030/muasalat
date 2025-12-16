<?php

namespace Modules\Vehicle\Database\Seeders;

use App\Models\User;
use Modules\Vehicle\Models\VehicleYear;
use Modules\Vehicle\Models\VehicleModel;
use Illuminate\Database\Seeder;
use Modules\Vehicle\Models\VehicleRequest;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            VehicleRequest::create([
                "user_id" => fake()->numberBetween(1 , User::count()),
                "content" => fake()->title(),
            ]);
    }
}
