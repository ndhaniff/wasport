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

  Auth::routes();
  
});

Route::group(['prefix' =>'admin'],function()
{
  Route::get('/', 'Auth\AdminLoginController@showLogin');
  Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
  Route::post('/login', 'Auth\AdminLoginController@login');

  //Races
  Route::resource('races','Main\RacesController');
});

