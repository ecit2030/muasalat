<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;


class ClientSeeder extends Seeder
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
            'name' => "user",
            'email' => "user@gmail.com",
            'password' => Hash::make("Test@123"),
            'phone' => '01066135741',
            'is_active' => true,

        ]);
        $user->assignRole("user");
    }
}
