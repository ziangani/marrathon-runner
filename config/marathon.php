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

    'name' => env('MARATHON_NAME', 'LuWSI Run'),
    'tagline' => env('MARATHON_TAGLINE', 'Supporting water security initiatives in Zambia'),
    'description' => env('MARATHON_DESCRIPTION', 'Join us for the annual marathon supporting water security initiatives in Zambia.'),
    
    /*
    |--------------------------------------------------------------------------
    | Event Details
    |--------------------------------------------------------------------------
    */
    'date' => env('MARATHON_DATE', '2025-06-15'),
    'time' => env('MARATHON_TIME', '06:00 AM'),
    'location' => env('MARATHON_LOCATION', 'Lusaka, Zambia'),
    
    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    */
    'contact' => [
        'email' => env('MARATHON_EMAIL', 'info@luwsirun.org'),
        'phone' => env('MARATHON_PHONE', '+260 97 1234567'),
        'address' => env('MARATHON_ADDRESS', 'Lusaka, Zambia'),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Social Media
    |--------------------------------------------------------------------------
    */
    'social' => [
        'facebook' => env('MARATHON_FACEBOOK', 'https://facebook.com/luwsirun'),
        'twitter' => env('MARATHON_TWITTER', 'https://twitter.com/luwsirun'),
        'instagram' => env('MARATHON_INSTAGRAM', 'https://instagram.com/luwsirun'),
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
        'student' => [
            'name' => 'Student',
            'price' => 150,
            'description' => 'For students with valid ID',
        ],
        'individual' => [
            'name' => 'Individual',
            'price' => 320,
            'description' => 'Standard individual entry',
        ],
        'group_five' => [
            'name' => 'Group of Five',
            'price' => 1500,
            'description' => 'Group entry for 5 participants',
        ],
        'group_seven' => [
            'name' => 'Group of Seven',
            'price' => 2000,
            'description' => 'Group entry for 7 participants',
        ],
        'group_ten' => [
            'name' => 'Group of Ten',
            'price' => 2800,
            'description' => 'Group entry for 10 participants',
        ],
        'corporate' => [
            'name' => 'Corporate individual',
            'price' => 3000,
            'description' => 'Corporate entry',
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
        'image' => env('MARATHON_META_IMAGE', '/images/luwsi-run-banner.jpg'),
    ],
];
