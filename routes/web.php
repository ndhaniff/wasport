<?php

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

Route::group([
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
], function()
{
	Route::get('/', 'Pages\HomeController@index')->name('home');
  Route::get('/races', 'Pages\RacesController@index')->name('races');
  Route::get('/racedetails/{id}', 'Pages\RacesController@details')->name('racedetails');
  Route::get('/howitworks', 'Pages\HomeController@howitworks')->name('howitworks');
  //user
  Route::get('/dashboard', 'User\UserController@dashboard' )->name('user.dashboard');

  Auth::routes();

});

Route::group(['prefix' =>'admin'],function()
{
  //authentication
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
  Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
  Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout')->middleware('auth:admin');
  Route::get('/', function() {
    return redirect()->route('admin.login');
  });
  //Races
  Route::get('/races','Admin\AdminRacesController@index')->name('admin.races');
  Route::delete('/races/{id}','Admin\AdminRacesController@destroy')->name('admin.races.destroy');
  Route::get('/races/create','Admin\AdminRacesController@create')->name('admin.races.create');
  Route::post('/races/create','Admin\AdminRacesController@store')->name('admin.races.submit');
  Route::get('/races/edit/{id}','Admin\AdminRacesController@editForm')->name('admin.races.edit');
  Route::post('/races/edit','Admin\AdminRacesController@edit')->name('admin.races.edit.submit');
  Route::post('/races/edit/{id}','Admin\AdminRacesController@duplicate')->name('admin.races.edit.dupe');
  //Addons
  Route::get('/addons','Admin\AdminAddonsController@index')->name('admin.addons');
  Route::delete('/addons/{id}','Admin\AdminAddonsController@destroy')->name('admin.addons.destroy');
  Route::get('/addons/create','Admin\AdminAddonsController@create')->name('admin.addons.create');
  Route::post('/addons/create','Admin\AdminAddonsController@store')->name('admin.addons.submit');
  Route::get('/addons/edit/{id}','Admin\AdminAddonsController@editForm')->name('admin.addons.edit');
  Route::post('/addons/edit','Admin\AdminAddonsController@edit')->name('admin.addons.edit.submit');
  Route::post('/addons/edit/{id}','Admin\AdminAddonsController@duplicate')->name('admin.addons.edit.dupe');
});

//Strava
Route::get('/strava/getAuthToken','API\StravaController@getAuthToken')->name('strava.getToken');
Route::post('/strava/getStats','API\StravaController@getStats')->name('strava.getStats');
Route::post('/strava/disconnect','API\StravaController@disconnect')->name('strava.disconnect');

//User profile
Route::post('/user/upload', 'User\UserController@handleProfileImg' )->name('user.profileImg');
Route::post('/user/updateProfile', 'User\UserController@updateProfile' )->name('user.updateProfile');
Route::post('/user/updateAddress', 'User\UserController@updateAddress' )->name('user.updateAddress');
Route::post('/user/updatePassword', 'User\UserController@updatePassword' )->name('user.updatePassword');
