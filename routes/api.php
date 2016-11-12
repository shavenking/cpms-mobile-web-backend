<?php

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    // User
    Route::get('/user', 'UserController@profile');

    // Project
    Route::get('/projects', 'ProjectController@list');
    Route::post('/projects', 'ProjectController@create');

    // 施工日報
    Route::group(['prefix' => '/projects/{project}'], function () {
        Route::get('/construction-dailies', 'ConstructionDailyController@list');
        Route::post('/construction-dailies', 'ConstructionDailyController@create');
    });
});
