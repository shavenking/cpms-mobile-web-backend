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

    // 材料
    Route::get('/materials', 'MaterialController@list');
    Route::post('/materials', 'MaterialController@create');

    // 工地人員
    Route::get('/labors', 'LaborController@list');
    Route::post('/labors', 'LaborController@create');

    // 機具
    Route::get('/appliances', 'ApplianceController@list');
    Route::post('/appliances', 'ApplianceController@create');

    Route::group(['prefix' => '/projects/{project}'], function () {
        Route::group(['prefix' => '/construction-dailies'], function () {
            // 施工日報
            Route::get('/', 'ConstructionDailyController@list');
            Route::post('/', 'ConstructionDailyController@create');
            Route::get('/{constructionDaily}/summary', 'ConstructionDailyController@summary');

            // 施工工項
            Route::get('/{constructionDaily}/works', 'DailyWorkController@list');
            Route::post('/{constructionDaily}/works', 'DailyWorkController@create');

            // 工地材料
            Route::get('/{constructionDaily}/materials', 'DailyMaterialController@list');
            Route::post('/{constructionDaily}/materials', 'DailyMaterialController@create');

            // 工地人員
            Route::get('/{constructionDaily}/labors', 'DailyLaborController@list');
            Route::post('/{constructionDaily}/labors', 'DailyLaborController@create');

            // 機具管理
            Route::get('/{constructionDaily}/appliances', 'DailyApplianceController@list');
            Route::post('/{constructionDaily}/appliances', 'DailyApplianceController@create');
        });
    });
});
