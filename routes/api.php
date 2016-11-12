<?php

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('/user', 'UserController@profile');

    Route::get('/projects', 'ProjectController@list');
    Route::post('/projects', 'ProjectController@create');
});
