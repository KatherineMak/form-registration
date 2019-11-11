<?php

return [
    'database' => [
        'name' => 'conference',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    'share' => [
        'tw-link' => 'https://twitter.com/share?ref_src=twsrc%5Etfw',
        'tw-text' => 'Check out this Meetup with SoCal AngularJS!'
    ]
];