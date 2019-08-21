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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::prefix('v1')->group(function () {

    Route::prefix('users')->group(function () {

        Route::post('/', 'UserController@store'); // 회원가입
        Route::get('/users/{id}', 'UserController@show'); // 회원조회


    });




    Route::get('/share', 'ShareController@index'); // 회원가입
});


