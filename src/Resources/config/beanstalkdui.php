<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Beanstalkd UI Configuration
    |--------------------------------------------------------------------------
    |
    | This file stores the configuration parameters to connect to our
    | Beanstalkd Server. By default the default Beanstalkd server
    | parameters are used. But feel free to override then below.
    |
    */

    'host' => '127.0.0.1',

    'port' => '11300',

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | Here you can specify the route middleware that should be applied the
    | Admin UI routes. By default we simply require the user to be
    | logged in. If you have any additional authorization to
    | perform, this would be the place to specify it.
    |
    */

    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | Here you can specify the route prefix that should be applied the
    | Admin UI routes.
    |
    */
    'prefix' => '',

    /*
    |--------------------------------------------------------------------------
    | Failed Jobs
    |--------------------------------------------------------------------------
    |
    | If you do not want to be able to manage your failed jobs through
    | the UI as well, simply change this setting to `false`.
    |
    */

    'failed_jobs' => true,

    'failed_jobs_table' => 'failed_jobs',
];
