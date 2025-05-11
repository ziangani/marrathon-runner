<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Marathon Information
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the marathon event.
    |
    */

    'organizer' => env('MARATHON_ORGANIZER', 'LuWSI'),
    'name' => env('MARATHON_NAME', 'LuWSI Run for Water'),
    'tagline' => env('MARATHON_TAGLINE', 'Run for Water, Walk for life: Securing Zambia\'s future'),
    'description' => env('MARATHON_DESCRIPTION', 'Zambia is severely water insecure and extremely vulnerable to the impacts of climate change. Join us for the annual marathon to raise awareness and support initiatives addressing water security challenges in Zambia.'),
    'home' => env('MARATHON_HOME', 'https://www.luwsi.org/'),
    /*
    |--------------------------------------------------------------------------
    | Event Details
    |--------------------------------------------------------------------------
    */
    'date' => env('MARATHON_DATE', '2025-06-28'),
    'time' => env('MARATHON_TIME', '05:00 AM - 10:00 AM'),
    'location' => env('MARATHON_LOCATION', 'East Park Mall, Lusaka, Zambia'),

    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    */
    'contact' => [
        'email' => env('MARATHON_EMAIL', 'luwsisecretariat@gmail.com'),
        'phone' => env('MARATHON_PHONE', '+260 975 007122'),
        'address' => env('MARATHON_ADDRESS', '164 Mulombwa Close, Fairview, Lusaka, Zambia'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Media
    |--------------------------------------------------------------------------
    */
    'social' => [
        'facebook' => env('MARATHON_FACEBOOK', 'https://www.facebook.com/p/Lusaka-Water-Security-Initiative-100069392127110/'),
//        'twitter' => env('MARATHON_TWITTER', 'https://twitter.com/luwsirun'),
//        'instagram' => env('MARATHON_INSTAGRAM', 'https://instagram.com/luwsirun'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Race Categories
    |--------------------------------------------------------------------------
    */
    'categories' => [
        '21km' => [
            'name' => '21 KM Run',
            'description' => 'Half Marathon',
            'start_time' => '06:00 AM',
        ],
        '10km' => [
            'name' => '10 KM Run',
            'description' => '10 Kilometer Run',
            'start_time' => '06:30 AM',
        ],
        '5km_run' => [
            'name' => '5 KM Run',
            'description' => '5 Kilometer Run',
            'start_time' => '07:00 AM',
        ],
        '5km_walk' => [
            'name' => '5 KM Walk',
            'description' => '5 Kilometer Walk',
            'start_time' => '07:30 AM',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Registration Packages
    |--------------------------------------------------------------------------
    */
    'packages' => [
//        'test' => [
//            'name' => 'Test',
//            'price' => 1,
//            'description' => 'For students with valid ID',
//        ],
//        'student' => [
//            'name' => 'Student',
//            'price' => 150,
//            'description' => 'For students with valid ID',
//        ],
        'individual' => [
            'name' => 'Individual',
            'price' => 400,
            'description' => 'Standard individual entry',
        ],
        'group_five' => [
            'name' => 'Group of Five',
            'price' => 1700,
            'description' => 'Group entry for 5 participants',
        ],
        'group_seven' => [
            'name' => 'Group of Seven',
            'price' => 2500,
            'description' => 'Group entry for 7 participants',
        ],
        'group_ten' => [
            'name' => 'Group of Ten',
            'price' => 3500,
            'description' => 'Group entry for 10 participants',
        ],
        'executive' => [
            'name' => 'Executive',
            'price' => 1000,
            'description' => 'Executive participant entry',
        ],
        'champion' => [
            'name' => 'Water & Climate Champion',
            'price' => 1200,
            'description' => 'Support as a Water & Climate Champion',
        ],
        'sponsor' => [
            'name' => 'Individual Sponsor',
            'price' => 5000,
            'description' => 'Individual sponsorship (K5,000 - K10,000)',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Meta Data
    |--------------------------------------------------------------------------
    */
    'meta' => [
        'title' => env('MARATHON_META_TITLE', 'LuWSI Run - Marathon Registration'),
        'description' => env('MARATHON_META_DESCRIPTION', 'Register for the LuWSI Run marathon supporting water security initiatives in Zambia.'),
        'keywords' => env('MARATHON_META_KEYWORDS', 'marathon, run, LuWSI, water security, Zambia, charity run'),
        'author' => env('MARATHON_META_AUTHOR', 'LuWSI'),
        'image' => env('MARATHON_META_IMAGE', '/img/logo.png'),
    ],
];
