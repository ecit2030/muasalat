<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardPaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('card_payment_methods')->truncate();
        \DB::table('card_payment_methods')->insert([
           [
               'id' => 1,
               'payment' => 'Visa',
               'logo' => 'img/visa.png',
               'device_type' => 'all'
           ],
            [
                'id' => 2,
                'payment' => 'MASTER',
                'logo' => 'img/master.png',
                'device_type' => 'all'
            ],
            [
                'id' => 3,
                'payment' => '	MADA',
                'logo' => 'img/mada.png',
                'device_type' => 'all'
            ],
            [
                'id' => 4,
                'payment' => '	APPLEPAY',
                'logo' => 'img/apple_pay.png',
                'device_type' => 'ios'
            ]
        ]);
    }
}
