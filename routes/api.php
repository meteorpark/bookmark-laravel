<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function () {

    Route::prefix('users')->group(function () {

        Route::post('/', 'UserController@store'); // 회원가입
        Route::get('/users/{id}', 'UserController@show'); // 회원조회


    });

    Route::post('/bookmark', 'BookmarkController@store'); // 공유하기
    Route::get('/bookmark', 'BookmarkController@index'); // 카테고리의 공유항목 가져오기
});


