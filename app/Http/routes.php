<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::get('logout', 'AuthenticateController@logout');

    Route::get('skill/user/{user}','SkillController@forUser');
    Route::get('user/{user}/following','UsersController@following');
    Route::get('user/{user}/followers','UsersController@followers');
    Route::get('user/follow/{user}','UsersController@follow');

    Route::resource('skill', 'SkillController');
    Route::resource('users', 'UsersController');
    Route::resource('setting', 'SettingsController');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['web']], function () {
//    //
//});
