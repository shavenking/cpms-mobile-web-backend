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

    // 施工日報
    Route::group(['prefix' => '/projects/{project}'], function () {
        Route::get('/construction-dailies', 'ConstructionDailyController@list');
        Route::get('/construction-dailies/{constructionDaily}/summary', 'ConstructionDailyController@summary');
        Route::post('/construction-dailies', 'ConstructionDailyController@create');
    });

    // 工項
    Route::get('/works', 'WorkController@list');
    Route::post('/works', 'WorkController@create');
});
