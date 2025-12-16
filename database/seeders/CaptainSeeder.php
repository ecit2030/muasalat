<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;


class CaptainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();


        $user =   User::create([
            'name' => "Captain",
            'email' => "captain@gmail.com",
            'password' => Hash::make("Test@123"),
            'phone' => '01066135740',
            'is_active' => true,
            "date_of_birth" => "1997-04-23",
            "driver_license_end_date" => "2030-04-23",
            "ussid_number" => "29704231200337",
            "bank_name" => "alahly",
            "talebat_price" => 5,
            "other_price" => 10,
            "bank_personal_id" => "2615487913222535655",
            "iban" => '2615487913222535655'

        ]);
        $user->assignRole("captain");

        $vehicle =  $user->vehicle()->create([
            "vehicle_year_id" => 1,
            'vehicle_number' => '123',
            'vehicle_letter' => 'asd',
            "color" => "green",
            "license_end_date" => '2030-05-21',
            "ensurance_end_date" => '2030-05-21',
            "periodic_end_date" => '2030-05-21',

        ]);

        $req = [
            "name" => "mansoura -- cairo",
            "origin" => [
                "location" => "mansoura",
                "lat" => "31.0409",
                "lng" => "31.3785",
                "start_time" =>   "12:23",
                "duration" => "00:00",
                "distance" => "0"
            ],
            "destination" => [
                "location" => "cairo",
                "lat" => "30.0444",
                "lng" => "31.2357",
                "duration" => "03:12",
                "distance" => "30",
            ],

            "repeat" => [
                "Monday", "Tuesday"
            ],
            "map_route_data" => [
                ["lat" => "31.041000000000004", "lng" => "31.378320000000002"],
                ["lat" => "31.040990000000004", "lng" => "31.378310000000003"],
                ["lat" => "31.04097", "lng" => "31.378300000000003"],
                ["lat" => "31.040960000000002", "lng" => "31.378290000000003"],
                ["lat" => "31.040940000000003", "lng" => "31.378290000000003"],
                ["lat" => "31.040920000000003", "lng" => "31.378280000000004"],
                ["lat" => "31.040900000000004", "lng" => "31.378280000000004"],
                ["lat" => "31.04089", "lng" => "31.378280000000004"],
                ["lat" => "31.04087", "lng" => "31.378280000000004"],
                ["lat" => "31.040850000000002", "lng" => "31.378280000000004"],
                ["lat" => "31.040840000000003", "lng" => "31.378280000000004"],
                ["lat" => "31.040820000000004", "lng" => "31.378290000000003"],
                ["lat" => "31.0408", "lng" => "31.378300000000003"],
                ["lat" => "31.040770000000002", "lng" => "31.378330000000002"],
                ["lat" => "31.040770000000002", "lng" => "31.378330000000002"],
                ["lat" => "31.040740000000003", "lng" => "31.378190000000004"],
                ["lat" => "31.040740000000003", "lng" => "31.378140000000002"],
                ["lat" => "31.040740000000003", "lng" => "31.378030000000003"],
                ["lat" => "31.04078", "lng" => "31.377930000000003"]
            ]
        ];

        $req["owner_id"] = auth()->id();
        $req["user_vehicle_id"] = $vehicle->id;

        $waypoints = [
            [
                "location" => "tanta",
                "lat" => "30.7865",
                "lng" => "31.0004",
                "duration" => "01:12",
                "distance" => "20"
            ], [
                "location" => "zagazig",
                "lat" => "30.5765",
                "lng" => "31.5041",
                "duration" => "01:12",
                "distance" => "20"
            ]
        ];

        $track = $user->tracks()->create($req);

        foreach ($waypoints as $value) {
            $track->waypoints()->create([
                "waypoint" => $value
            ]);
        }
    }
}
