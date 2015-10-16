<?php

return [
    'table' => 'oauth_identities',
    'providers' => [
        'google' => [
            'client_id' => '784593028948-ltt1ahqbhgomd1elcen5jf6t1uav25li.apps.googleusercontent.com',
            'client_secret' => 'BwYppln3nwm0mZ8qyvcHh2Pp',
            'redirect_uri' => env('URL') . '/auth/google/login',
            'scope' => [],
        ],
        'facebook' => [
            'client_id' => '741200692670094',
            'client_secret' => '0d8acfd4186916f0288dfa9b5b403625',
            'redirect_uri' => env('URL') . '/auth/facebook/login',
            'scope' => [],
        ],
        'github' => [
            'client_id' => '31f379e30e12a04ff8d9',
            'client_secret' => '03bf5096d90cf1048dabed9934be698683e4e42f',
            'redirect_uri' => env('URL') . '/auth/github/login',
            'scope' => [],
        ],
//        'linkedin' => [
//            'client_id' => '12345678',
//            'client_secret' => 'y0ur53cr374ppk3y',
//            'redirect_uri' => 'https://example.com/your/linkedin/redirect',
//            'scope' => [],
//        ],
//        'instagram' => [
//            'client_id' => '12345678',
//            'client_secret' => 'y0ur53cr374ppk3y',
//            'redirect_uri' => 'https://example.com/your/instagram/redirect',
//            'scope' => [],
//        ],
//        'soundcloud' => [
//            'client_id' => '12345678',
//            'client_secret' => 'y0ur53cr374ppk3y',
//            'redirect_uri' => 'https://example.com/your/soundcloud/redirect',
//            'scope' => [],
//        ],
    ],
];
