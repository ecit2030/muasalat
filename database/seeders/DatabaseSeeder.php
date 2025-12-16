<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Modules\Vehicle\Database\Seeders\VehicleModelSeeder;
use Modules\Vehicle\Database\Seeders\VehicleSeeder;
use Modules\Vehicle\Database\Seeders\VehicleBrandSeeder;
use Modules\Vehicle\Database\Seeders\VehicleYearSeeder;

use Illuminate\Support\Facades\Schema;
use Modules\StaticPage\Database\Seeders\StaticPageDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call([
            DashboardRolesSeeder::class,
            UserSeeder::class,
            LanguageSeeder::class,
            VehicleBrandSeeder::class,
            VehicleModelSeeder::class,
            VehicleYearSeeder::class,
            VehicleSeeder::class,
            CaptainSeeder::class,
            OrgSeeder::class,
            ClientSeeder::class,
            AreasTableSeeder::class,
            StaticPageDatabaseSeeder::class,
            CardPaymentMethodSeeder::class,
        ]);
        Faq::factory(50)->create();
        Schema::enableForeignKeyConstraints();
    }
}
