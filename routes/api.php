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


    Route::prefix('users')->middleware(['api'])->group(function () {
        Route::post('/', 'UserController@store'); // 회원가입
        Route::post('/login', 'UserController@login'); // 로그인
        // 로그아웃
        //refresh
        // 나 조회
    });
});


//Route::post('/bookmark', 'BookmarkController@store'); // 공유하기
//Route::get('/bookmark', 'BookmarkController@index'); // 카테고리의 공유항목 가져오기

