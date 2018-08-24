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
  //user
  Route::get('/dashboard', 'User\UserController@dashboard' )->name('user.dashboard');;
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
  Route::put('/races/edit','Admin\AdminRacesController@edit')->name('admin.races.edit.submit');
  Route::post('/races/edit/{id}','Admin\AdminRacesController@duplicate')->name('admin.races.edit.dupe');
});

//Strava
Route::get('/strava/getAuthToken','API\StravaController@getAuthToken')->name('strava.getToken');
Route::post('/strava/getStats','API\StravaController@getStats')->name('strava.getStats');

