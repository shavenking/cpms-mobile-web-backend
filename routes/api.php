<?php

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    // User
    Route::get('/user', 'UserController@profile');

    // Project
    Route::get('/projects', 'ProjectController@list');
    Route::get('/projects/{project}', 'ProjectController@show');
    Route::post('/projects', 'ProjectController@create');

    // 工項
    Route::get('/works', 'WorkController@list');
    Route::post('/works', 'WorkController@create');

    Route::group(['prefix' => '/projects/{project}'], function () {
        Route::group(['prefix' => '/construction-dailies'], function () {
            // 施工日報
            Route::get('/', 'ConstructionDailyController@list');
            Route::post('/', 'ConstructionDailyController@create');
            Route::get('/{constructionDaily}/summary', 'ConstructionDailyController@summary');

            // 施工工項
            Route::get('/{constructionDaily}/works', 'DailyWorkController@list');
            Route::post('/{constructionDaily}/works', 'DailyWorkController@create');
        });
    });
});
