<?php

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('/user', 'AuthController@profile');

    Route::post('/projects', 'ProjectController@create');
});
