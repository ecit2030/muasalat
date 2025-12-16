<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Client\Entities\Student;

class ClientDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Student::factory()->count(10)->create();
        // $this->call("OthersTableSeeder");
    }
}
