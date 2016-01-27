<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Vimeo Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'client_id' => '40d3482cda29f22a0a1e569f95ec69c2c2d4a997',
            'client_secret' => 'RhHRrQQBgCoFggXljSrOqcmxPFniZ28i2CGT6VbE26Zh4I6a1xM+HXWjttREx7HVEah9rb7G722yfbcEGNv9Fcz/YAebx5HmZ401JnNxdVjJ+5a/cDcsKp7LT6NwcnEC',
            'access_token' => '82e3b817f264c73f4aa75ef0b3e54ecd',
        ],

        'alternative' => [
            'client_id' => 'your-client-id',
            'client_secret' => 'your-client-secret',
            'access_token' => null,
        ],

    ],

];
