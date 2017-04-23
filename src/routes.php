<?php

Route::get('beanstalkd/tubes', [
    'as' => 'beanstalkd.tubes.index',
    'uses' => 'Dionera\BeanstalkdUI\Controllers\TubesController@index',
]);

Route::get('beanstalkd/tubes/{tube}', [
    'as' => 'beanstalkd.tubes.show',
    'uses' => 'Dionera\BeanstalkdUI\Controllers\TubesController@showTube',
]);

/*
 * Api Routes
 */

Route::group(['prefix' => 'beanstalkd/api'], function () {
    Route::post('jobs/{job}', [
        'as' => 'beanstalkd.jobs.kick',
        'uses' => 'Dionera\BeanstalkdUI\Controllers\Api\JobsController@kick',
    ]);

    Route::delete('jobs/{job}', [
        'as' => 'beanstalkd.jobs.delete',
        'uses' => 'Dionera\BeanstalkdUI\Controllers\Api\JobsController@delete',
    ]);

    Route::get('tubes/{tube}', [
        'as' => 'beanstalkd.stats',
        'uses' => 'Dionera\BeanstalkdUI\Controllers\Api\StatsController@statsForTube',
    ]);

    Route::delete('tubes/{tube}/failed', [
        'as' => 'beanstalkd.flush',
        'uses' => 'Dionera\BeanstalkdUI\Controllers\Api\FailedJobsController@flush',
    ]);

    Route::get('tubes/{tube}/failed', [
        'as' => 'beanstalkd.failed',
        'uses' => 'Dionera\BeanstalkdUI\Controllers\Api\FailedJobsController@index',
    ]);

    Route::post('tubes/{tube}/failed/{failed}', [
        'as' => 'beanstalkd.retry',
        'uses' => 'Dionera\BeanstalkdUI\Controllers\Api\FailedJobsController@retry',
    ]);

    Route::delete('tubes/{tube}/failed/{failed}', [
        'as' => 'beanstalkd.forget',
        'uses' => 'Dionera\BeanstalkdUI\Controllers\Api\FailedJobsController@forget',
    ]);
});
