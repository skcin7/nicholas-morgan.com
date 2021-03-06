<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlphabetizerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Basic application routes:
Route::get('/', 'AppController@welcome')->name('welcome');
Route::get('contact', 'AppController@contact')->name('contact');
Route::get('contact_card', 'AppController@downloadContactCard')->name('contact_card');
Route::get('about', 'AppController@about')->name('about');
Route::get('pgp', 'AppController@pgp')->name('pgp');
Route::get('followers_difference', 'AppController@followersDifference')->name('followers_difference');
Route::post('followers_difference', 'AppController@followersDifference')->name('followers_difference');

Route::group(['prefix' => 'alphabetizer'], function() {
    Route::get('/', [AlphabetizerController::class, 'index'])->name('alphabetizer.index');

    //Route::get('/', 'AlphabetizerController@index')->name('alphabetizer.index');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::group(['prefix' => 'writings'], function() {
    Route::get('/', 'WritingsController@index')->name('writings');
    Route::get('create', 'WritingsController@create')->name('writings.create');
    Route::post('create', 'WritingsController@processCreate')->name('writings.create');
    Route::get('{id}', 'WritingsController@writing')->name('writings.writing');
    Route::get('{id}/edit', 'WritingsController@edit')->name('writings.writing.edit');
    Route::post('{id}/edit', 'WritingsController@processEdit')->name('writings.writing.process_edit');
    Route::post('{id}/trash', 'WritingsController@trash')->name('writings.writing.trash');
    Route::post('{id}/untrash', 'WritingsController@untrash')->name('writings.writing.untrash');
    Route::post('{id}/permanently_delete', 'WritingsController@permanentlyDelete')->name('writings.writing.permanently_delete');
});

Route::group(['prefix' => 'albums'], function() {
    Route::get('/', 'AlbumsController@index')->name('albums');
//    Route::get('create', 'AlbumsController@create')->name('albums.create');
//    Route::post('create', 'AlbumsController@processCreate')->name('albums.create');
//    Route::get('{id}', 'AlbumsController@writing')->name('albums.writing');
//    Route::get('{id}/edit', 'AlbumsController@edit')->name('albums.writing.edit');
//    Route::post('{id}/edit', 'AlbumsController@processEdit')->name('albums.writing.process_edit');
//    Route::post('{id}/trash', 'AlbumsController@trash')->name('albums.writing.trash');
//    Route::post('{id}/untrash', 'AlbumsController@untrash')->name('albums.writing.untrash');
//    Route::post('{id}/permanently_delete', 'AlbumsController@permanentlyDelete')->name('albums.writing.permanently_delete');
});

// Routes related to the JNES emulator/Contra:
Route::group(['prefix' => 'nes'], function() {
    Route::get('{rom?}', 'NesEmulatorController@play')->name('nes');
//    Route::get('', 'NesEmulatorController@play')->name('contra_rom');
});


Route::get('home', 'HomeController@index')->name('home');


// Admin routes:
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('phpinfo', "AdminController@showPhpinfo")->name('admin.phpinfo');
    Route::get('adminer', "AdminController@showAdminer")->name('admin.adminer');
});

// Users routes:
Route::group(['prefix' => 'users'], function() {
    Route::get('/', "UsersController@index")->name('users');
});
Route::get('@{id}', "UsersController@get")->name('users.user');
Route::get('@{id}/secret', "UsersController@secret")->name('users.user.secret');
Route::get('@{id}/logins', "UsersController@logins")->name('users.user.logins');
