<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('users')->insert([
            [
                'name'       => 'user',
                'email'      => 'user@user.com',
                'password'   => bcrypt('A12345678'),
                'phone'      => '+966057855187',
                'created_at' => Carbon::now(),
            ],
            [
                'name'       => 'user2',
                'email'      => 'user2@test.com',
                'password'   => bcrypt('A12345678'),
                'phone'      => '+9660544459139',
                'created_at' => Carbon::now(),
            ],
            [
                'name'       => 'user3',
                'email'      => 'user3@test.com',
                'password'   => bcrypt('A12345678'),
                'phone'      => '+9660551159139',
                'created_at' => Carbon::now(),
            ],
            [
                'name'       => 'user4',
                'email'      => 'user4@test.com',
                'password'   => bcrypt('A12345678'),
                'phone'      => '+9660558499139',
                'created_at' => Carbon::now(),
            ],
        ]);

        // $countUsers = (int) $this->command->ask('How Many users ? ', 10);
        $faker = \Faker\Factory::create();
        foreach (range(1, 2) as $index) {
            DB::table('users')->insert([
                'name'       => $faker->name,
                'email'      => "$index.{$faker->safeEmail}",
                'password'   => bcrypt('A12345678'),
                'phone'      => '+96605'.$index * 11111111,
                'created_at' => Carbon::now(),
            ]);
        }

        $faker = \Faker\Factory::create();
        $users = User::all();
        foreach ($users as $index) {
            DB::table('user_infos')->insert([
                'user_id' => $index->id,
                'gender'  => $faker->randomElement(['male', 'female']),
                'balance' => 100,
            ]);

        }
    }
}
