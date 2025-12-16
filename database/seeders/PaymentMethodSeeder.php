<?php


namespace Database\Seeders;


use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Modules\Language\Models\Language;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PaymentMethod::truncate();
        PaymentMethod::insert([
            [
                'code' => 'cash',
                'active'      => 1,
                'title' => json_encode([
                    'ar' => 'كاش',
                    'en' => 'cash',
                ]),
            ],
            [
                'code' => 'credit_card',
                'active'      => 1,
                'title' => json_encode([
                    'ar' => 'بطاقة الائتمان',
                    'en' => 'credit_card',
                ]),
            ],

        ]);
    }
}
