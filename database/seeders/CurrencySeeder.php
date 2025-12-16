<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Currency::truncate();
        Currency::insert([
            [
                'title'   => '{
                    "ar" :"ريال سعودي",
                    "en" : "Saudi Riyal"

                }',
                'code'    => 'SAR',
                'exchange_rate' => 1,
                'default' => true,
                'active'  => true,
                'symbol'  => '﷼',

            ],
            [
                'title'   => '{
                    "ar" :"دولار أمريكي",
                    "en" : "US Dollar"
                }',
                'code'    => 'USD',
                'exchange_rate' => 0.27,
                'default' => false,
                'active'  => true,
                'symbol'  => '$',
            ],
        ]);
    }
}
