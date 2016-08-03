<?php

Route::group(['middleware' => 'web'], function () {
    Route::get('beanstalkd', [
        'as' => 'beanstalkd.tubes.index',
        'uses' => 'Sassnowski\BeanstalkdUI\Controllers\TubesController@index',
    ]);

    Route::get('beanstalkd/{tube}', [
        'as' => 'beanstalkd.tubes.show',
        'uses' => 'Sassnowski\BeanstalkdUI\Controllers\TubesController@showTube',
    ]);

    Route::delete('beanstalkd/{job}', [
        'as' => 'beanstalkd.jobs.delete',
        'uses' => 'Sassnowski\BeanstalkdUI\Controllers\JobsController@delete',
    ]);
});
