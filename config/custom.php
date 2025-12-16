<?php

// custom.php file returd default configuration setting of layouts
return [
    'FORCE_HTTPS'            => env('APP_HTTPS', false),
    'dashboard'              => [
        'prefix' => 'admin',
    ],
    'merchant'               => [
        'prefix' => 'merchant',
    ],
    'APP_HZ_TRANSLATION'     => env('APP_HZ_TRANSLATION', false),
    'YANDEX_TRANSLATION_API' => env('YANDEX_TRANSLATION_API', false),
    // 'GOOGLE_MAP_API'         => env('GOOGLE_MAP_API','AIzaSyAFHGBEgxZgOlHbq_phtBHQUBBQqldoeQg'),
    'GOOGLE_MAP_API'         => env('GOOGLE_MAP_API','AIzaSyALBkU7wWi4T90Su1avgHWvpKE5K1ytWQM'),
    'verfication_by'         => env('VERFICATION_BY','sms'),
];
