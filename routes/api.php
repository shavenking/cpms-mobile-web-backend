<?php

Route::get('/user', 'AuthController@profile')->middleware('auth.jwt');
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
