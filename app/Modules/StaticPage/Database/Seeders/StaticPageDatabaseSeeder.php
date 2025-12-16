<?php

namespace Modules\StaticPage\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\StaticPage\Entities\StaticPage;

class StaticPageDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        StaticPage::create([
            'title' => [
                "ar" => 'سياسة الخصوصية',
                "en" => 'policy',
            ],
            'content' =>  [
                "ar" => 'سياسة الخصوصيةسياسة الخصوصيةسياسة الخصوصيةسياسة الخصوصية',
                "en" => 'policy policy policy policy policy policy ',
            ]

        ]);
        StaticPage::create([
            'title' => [
                "ar" => 'الشروط والاحكام',
                "en" => 'policy',
            ],
            'content' => [
                "ar" => "الشروط والاحكام  الشروط والاحكام  الشروط والاحكام ",
                "en" => "poll poll poll poll poll poll poll "
            ]

        ]);

        StaticPage::create([
            'title' => [
                "ar" => 'من نحن',
                "en" => 'who is us ',
            ],
            'content' => [
                "ar" => 'من نحن  من نحن  من نحن ',
                "en" => 'who is uswho is us who is us',
            ]

        ]);
    }
}
