<?php

Route::group(['middleware' => 'web'], function () {
    Route::get('beanstalkd/tubes', [
        'as' => 'beanstalkd.tubes.index',
        'uses' => 'Sassnowski\BeanstalkdUI\Controllers\TubesController@index',
    ]);

    Route::get('beanstalkd/tubes/{tube}', [
        'as' => 'beanstalkd.tubes.show',
        'uses' => 'Sassnowski\BeanstalkdUI\Controllers\TubesController@showTube',
    ]);

    Route::delete('beanstalkd/jobs/{job}', [
        'as' => 'beanstalkd.jobs.delete',
        'uses' => 'Sassnowski\BeanstalkdUI\Controllers\JobsController@delete',
    ]);

    Route::post('beanstalkd/jobs/{job}', [
        'as' => 'beanstalkd.jobs.kick',
        'uses' => 'Sassnowski\BeanstalkdUI\Controllers\JobsController@kick',
    ]);
});
