<?php

namespace Modules\Vehicle\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Vehicle\Models\VehicleModel;
use Modules\Vehicle\Models\VehicleYear;

class VehicleYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (VehicleModel::all() as $model) {

            for ($i = 18; $i < 23; $i++) {

                $model->years()->create(
                    [
                        "year" => 20 . $i
                    ]
                );
            };
        }
    }
}
