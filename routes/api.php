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

Route::group([
    'prefix' => 'v1',
], function () {

    Route::post('/token', 'UserController@refreshToken'); // refresh token
    Route::prefix('users')->group(function () {
        Route::post('/', 'UserController@store'); // 회원가입
        Route::post('/login', 'UserController@login')->name('login'); // 로그인
    });

    Route::post('/category', 'BookMarkCategoryController@store'); // 카테고리 추가
    Route::get('/category', 'BookMarkCategoryController@show'); // 카테고리 조회
    Route::delete('/category/{category_id}', 'BookMarkCategoryController@destroy'); // 카테고리 삭제

    Route::post('/bookmarks', 'BookmarkController@store'); // 공유하기
    Route::post('/bookmarks/move', 'BookmarkController@move'); // 북마크 이동
    Route::get('/bookmarks/{category_id}', 'BookmarkController@index'); // 카테고리의 북마크들 가져오기
    Route::delete('/bookmarks/{category_id}/{bookmark_id}', 'BookmarkController@destroy'); // 북마크 삭제하기
});






