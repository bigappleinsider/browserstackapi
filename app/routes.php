<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', function()
{
	return View::make('home.welcome');
}]);

Route::get('login', ['uses' => 'SessionsController@create', 'as' => 'sessions.login']);
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);

Route::group(array('before' => 'auth'), function()
{
    Route::get('profile', ['uses' => 'SessionsController@profile', 'as' => 'sessions.profile']);
    Route::post('profile', ['uses' => 'SessionsController@profileSave', 'as' => 'sessions.profile-save']);
    Route::post('change-password', ['uses' => 'SessionsController@changePassword', 'as' => 'sessions.change-password']);
    Route::get('screenshots-api/all', ['uses' => 'ScreenshotApiController@showAll']);
    Route::resource('screenshots-api', 'ScreenshotApiController');
    //Route::post('screenshots-api', 'ScreenshotApiController@index');

});

Route::group(array('before' => 'role:admin'), function()
{
    Route::resource('browsers', 'BrowsersController', ['before' => 'role']);
    Route::resource('users', 'UsersController', ['before' => 'role']);
});

