<?php

use Illuminate\Support\Facades\Route;

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
Route::get('about', 'AppController@about')->name('about');
Route::get('pgp', 'AppController@pgp')->name('pgp');

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

// Routes related to the JNES emulator/Contra:
Route::group(['prefix' => 'nes'], function() {
    Route::get('{rom?}', 'NesEmulatorController@play')->name('nes');
//    Route::get('', 'NesEmulatorController@play')->name('contra_rom');
});


Route::get('home', 'HomeController@index')->name('home');


// Admin routes:
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('phpinfo.php', "AdminController@showPhpinfo")->name('admin.phpinfo');
    Route::get('adminer.php', "AdminController@showAdminer")->name('admin.adminer');
});
