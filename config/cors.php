<?php

return [
    'paths' => [
        'api/*',
        'login',
        'logout',
        'api/login',
        'api/register',
        'sanctum/csrf-cookie'
    ],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:3000',
        'https://mi-frontend.loca.lt',
        'https://huarochiri-frontend-production.vercel.app'
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];

