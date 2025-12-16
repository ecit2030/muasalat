<?php

namespace Modules\Vehicle\Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Modules\Vehicle\Models\VehicleBrand;

class VehicleBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $vehicles = [
            ["ar" => 'تويوتا', "en" => 'Toyota'],
            ["ar" => 'شيفروليه', "en" => 'Chevrolet'],
            ["ar" => 'نيسان', "en" => 'Nissan'],
            ["ar" => 'هيونداي', "en" => 'Hyundai'],
            ["ar" => 'مرسيدس ', "en" => 'Mercedes'],
            ["ar" => 'هوندا', "en" => 'Honda'],
            ["ar" => 'كيا', "en" => 'Kia'],
            ["ar" => 'دوج', "en" => 'Dodge'],
            ["ar" => 'مازدا', "en" => 'Mazda'],
            ["ar" => 'فورد', "en" => 'Ford'],
            ["ar" => 'بي إم دبليو', "en" => 'BMW']
        ];

        foreach ($vehicles as $vehicle) {
            VehicleBrand::create([
                'name' => [
                    "ar" => $vehicle["ar"],
                    "en" => $vehicle["en"],
                ]
            ]);
        }
    }
}
