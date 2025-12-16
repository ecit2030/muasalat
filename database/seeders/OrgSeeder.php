<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;


class OrgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $faker = \Faker\Factory::create();

        $organization =   User::create([
            "name" => "org",
            "email" => "org@gmail.com",
            "talebat_price" => 5,
            "other_price" => 10,
            "password" => Hash::make(124578963),
        ]);

        $organization->assignRole("organization");


            $vehicle =  $organization->vehicle()->create([
                "vehicle_year_id" => 1,
                'vehicle_number' => '143',
                'vehicle_letter' => 'awd',
                "color" => "green",
                "license_end_date" => '2030-05-21',
                "ensurance_end_date" => '2030-05-21',
                "periodic_end_date" => '2030-05-21',

            ]);

            $driver = User::create([
                'name' => "Driver",
                'email' => "Driver@gmail.com",
                'password' => Hash::make("Test@123"),
                "driver_license_end_date" => "2030-04-23",
                'phone' => '05066135740',
                'is_active' => true,
                'organization_id' => $organization->id,
                "date_of_birth" => "1997-04-23",
                "ussid_number" => "29704231200330",
            ]);

            $driver->assignRole("driver");

        $req = [
            "name" => "mansoura -- cairo",
            "origin" => [
                "location" => "mansoura",
                "lat" => "31.0409",
                "lng" => "31.3785",
                "start_time" =>   "12:23",
                "duration" => "00:00",
                "distance" => "0",
            ],
            "destination" => [
                "location" => "cairo",
                "lat" => "30.0444",
                "lng" => "31.2357",
                "duration" => "03:12",
                "distance" => "30",
            ],

            "repeat" => [
                "Monday", "Tuesday", "Wednesday"
            ],
            "driver_id" => $driver->id,
            "map_route_data" => []

        ];

        $waypoints = [
            [
                "location" => "tanta",
                "lat" => "30.7865",
                "lng" => "31.0004",
                "duration" => "01:12",
                "distance" => "20"
            ],
            [
                "location" => "zagazig",
                "lat" => "30.5765",
                "lng" => "31.5041",
                "duration" => "01:12",
                "distance" => "20"
            ]
        ];


        $req["owner_id"] = $organization->id;
        $req["user_vehicle_id"] = $vehicle->id;

        $track = $organization->tracks()->create($req);

        foreach ($waypoints as $value) {
            $track->waypoints()->create([
                "waypoint" => $value
            ]);
        }
    }
}
