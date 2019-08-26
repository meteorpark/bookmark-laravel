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



Route::get('unauthenticated', function () {
    return response()->json(['status' => 'unauthenticated', 'errors' => new stdClass()], 401);
})->name('unauthenticated');

Route::prefix('v1')->middleware(['api'])->group(function () {


    Route::prefix('users')->group(function () {
        Route::post('/', 'UserController@store'); // 회원가입
        Route::post('/login', 'UserController@login')->name('login'); // 로그인

    });

    Route::post('/bookmarks/category', 'BookMarkCategoryController@store'); // 카테고리 추가
    Route::get('/bookmarks/category', 'BookMarkCategoryController@show'); // 카테고리 조회





});


//Route::post('/bookmark', 'BookmarkController@store'); // 공유하기
//Route::get('/bookmark', 'BookmarkController@index'); // 카테고리의 공유항목 가져오기

