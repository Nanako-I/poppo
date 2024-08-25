<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "ably", "redis", "log", "null"
    |
    */

    //'default' => env('BROADCAST_DRIVER', 'null'),
    'default' => env('BROADCAST_DRIVER', 'pusher'),


    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            //'key' => "e5f439b12032cb8f7894",
            'secret' => env('PUSHER_APP_SECRET'),
            //'secret' => "67e5919f5f17937bf3b6",
            'app_id' => env('PUSHER_APP_ID'),
            //'app_id' => 1837219,
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                //'cluster' => "mt1",
                'useTLS' => true,
                'host' =>env('PUSHER_HOST') ?: 'api-'.env('PUSHER_APP_CLUSTER', 'mt1').'.pusher.com',
                'port' => env('PUSHER_PORT'),
                'scheme' => env('PUSHER_SCHEME'),
                'encrypted' => true
            ],
        ],



        'ably' => [
            'driver' => 'ably',
            'key' => env('ABLY_KEY'),
        ],

        // 'redis' => [
        //     'driver' => 'redis',
        //     'connection' => 'default',
        // ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
