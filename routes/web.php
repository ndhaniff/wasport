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
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
  Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
  Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');
  Route::get('/', 'Admin\AdminController@index')->name('admin');
  //Races
  Route::get('/races/create','Admin\AdminRacesController@create')->name('admin.races.create');
  Route::post('/races/create','Admin\AdminRacesController@store');
});

