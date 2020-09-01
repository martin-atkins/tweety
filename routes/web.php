<?php

// Useful database snippet...
// DB::listen(function ($query) { var_dump($query->sql, $query->bindings); });

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/tweets', 'TweetsController@index')->name('home');
    Route::post('/tweets', 'TweetsController@store');

    Route::post('/tweets/{tweet}/like', 'TweetLikesController@store');
    Route::delete('/tweets/{tweet}/like', 'TweetLikesController@destroy');


    Route::post(
        '/profiles/{user:username}/follow',
        'FollowsController@store'
    )->name('follow');

    Route::get(
        '/profiles/{user:username}/edit',
        'ProfilesController@edit'
    )->middleware('can:edit,user');

    Route::patch(
        '/profiles/{user:username}',
        'ProfilesController@update'
    )->middleware('can:edit,user');

    // Need to make this an "invokeable" controller...
    // Route::get('/explore', 'ExploreController@index');
    // Remove the "@index" text (and update the controller)
    Route::get('/explore', 'ExploreController');
});

// Laravel 6 way of doing this...
//Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');

// Laravel 7 way...
Route::get(
    '/profiles/{user:username}',
    'ProfilesController@show'
)->name('profile');


Auth::routes();
