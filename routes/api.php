<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Basic routes:
// These API endpoints do not require user authentication to be accessed:
Route::get('hello', [ApiController::class, 'hello'])->name('api.hello');
Route::get('protected', [ApiController::class, 'protected'])->middleware('auth:api')->name('api.protected');
Route::get('user', [ApiController::class, 'user'])->middleware('auth:api')->name('api.user');

Route::group(['prefix' => 'albums'], function() {
    Route::get('/', 'AlbumsController@index');
    Route::get('{id}', 'AlbumsController@get');
    Route::post('{id?}', 'AlbumsController@create');
    Route::put('{id}', 'AlbumsController@update');
    Route::delete('{id}', 'AlbumsController@delete');
});
