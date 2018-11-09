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
  Route::get('/racedetails/{rid}', 'Pages\RacesController@details')->name('racedetails');
  Route::get('/aboutus', 'Pages\HomeController@aboutus')->name('aboutus');
  Route::get('/guide', 'Pages\HomeController@guide')->name('guide');
  Route::get('/howitworks', 'Pages\HomeController@howitworks')->name('howitworks');
  Route::get('/privacypolicy', 'Pages\HomeController@privacypolicy')->name('privacypolicy');
  Route::get('/termsandconditions', 'Pages\HomeController@termsandconditions')->name('termsandconditions');
  Route::get('/relatedcooperation', 'Pages\HomeController@relatedCooperation')->name('relatedcooperation');
  Route::get('/contactus', 'Pages\ContactController@contactus')->name('contactus');
  Route::get('/registersuccess', 'Pages\HomeController@registersuccess')->name('registersuccess');
  //Route::get('/registerrace/{rid}', 'User\UserController@registerRace')->name('registerrace');

  //user
  Route::get('/dashboard', 'User\UserController@dashboard' )->name('user.dashboard');
  Route::get('/viewMedals', 'User\UserController@viewMedals' )->name('user.viewMedals');
  Route::get('/viewjoined', 'User\UserController@viewJoined' )->name('user.viewjoined');

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
  Route::get('/races/search', 'Admin\AdminRacesController@search')->name('admin.races.search');
  Route::get('/races/create','Admin\AdminRacesController@create')->name('admin.races.create');
  Route::post('/races/create','Admin\AdminRacesController@store')->name('admin.races.submit');
  Route::get('/races/edit/{rid}','Admin\AdminRacesController@editForm')->name('admin.races.edit');
  Route::post('/races/edit','Admin\AdminRacesController@edit')->name('admin.races.edit.submit');
  Route::delete('/races/{rid}','Admin\AdminRacesController@destroy')->name('admin.races.destroy');
  Route::post('/races/edit/{rid}','Admin\AdminRacesController@duplicate')->name('admin.races.edit.dupe');
  //Addons
  Route::get('/addons','Admin\AdminAddonsController@index')->name('admin.addons');
  Route::get('/addons/search', 'Admin\AdminAddonsController@search')->name('admin.addons.search');
  Route::get('/addons/filter', 'Admin\AdminAddonsController@filter')->name('admin.addons.filter');
  Route::delete('/addons/{aid}','Admin\AdminAddonsController@destroy')->name('admin.addons.destroy');
  Route::get('/addons/create','Admin\AdminAddonsController@create')->name('admin.addons.create');
  Route::post('/addons/create','Admin\AdminAddonsController@store')->name('admin.addons.submit');
  Route::get('/addons/edit/{aid}','Admin\AdminAddonsController@editForm')->name('admin.addons.edit');
  Route::post('/addons/edit','Admin\AdminAddonsController@edit')->name('admin.addons.edit.submit');
  Route::post('/addons/edit/{aid}','Admin\AdminAddonsController@duplicate')->name('admin.addons.edit.dupe');
  //Users
  Route::get('/users','Admin\AdminUsersController@index')->name('admin.users');
  Route::get('/users/search', 'Admin\AdminUsersController@search')->name('admin.users.search');
  Route::delete('/users/{id}','Admin\AdminUsersController@destroy')->name('admin.users.destroy');
  Route::post('/users/block/{id}', 'Admin\AdminUsersController@block')->name('admin.users.block');
  Route::post('/users/unblock/{id}', 'Admin\AdminUsersController@unblock')->name('admin.users.unblock');
  Route::get('/users/create','Admin\AdminUsersController@create')->name('admin.users.create');
  Route::post('/users/create','Admin\AdminUsersController@store')->name('admin.users.submit');
  Route::get('/users/edit/{id}','Admin\AdminUsersController@editForm')->name('admin.users.edit');
  Route::post('/users/edit','Admin\AdminUsersController@edit')->name('admin.users.edit.submit');
  Route::post('/users/edit/{id}','Admin\AdminUsersController@duplicate')->name('admin.users.edit.dupe');
  Route::get('/users/reset/{id}','Admin\AdminUsersController@resetForm')->name('admin.users.reset');
  Route::post('/users/reset','Admin\AdminUsersController@reset')->name('admin.users.reset.submit');
  //Medals
  Route::get('/medals','Admin\AdminMedalsController@index')->name('admin.medals');
  Route::get('/medals/search', 'Admin\AdminMedalsController@search')->name('admin.medals.search');
  Route::get('/medals/filter', 'Admin\AdminMedalsController@filter')->name('admin.medals.filter');
  Route::delete('/medals/{mid}','Admin\AdminMedalsController@destroy')->name('admin.medals.destroy');
  Route::get('/medals/create','Admin\AdminMedalsController@create')->name('admin.medals.create');
  Route::post('/medals/create','Admin\AdminMedalsController@store')->name('admin.medals.submit');
  Route::get('/medals/edit/{mid}','Admin\AdminMedalsController@editForm')->name('admin.medals.edit');
  Route::post('/medals/edit','Admin\AdminMedalsController@edit')->name('admin.medals.edit.submit');
  Route::post('/medals/edit/{mid}','Admin\AdminMedalsController@duplicate')->name('admin.medals.edit.dupe');
  //Orders
  Route::get('/orders','Admin\AdminOrdersController@index')->name('admin.orders');
  Route::get('/orders/searchBy', 'Admin\AdminOrdersController@searchBy')->name('admin.orders.searchBy');
  Route::get('/orders/filterRace', 'Admin\AdminOrdersController@filterRace')->name('admin.orders.filterRace');
  Route::delete('/orders/{oid}','Admin\AdminOrdersController@orders')->name('admin.orders.destroy');
  Route::get('/orders/edit/{oid}','Admin\AdminOrdersController@editForm')->name('admin.orders.edit');
  Route::post('/orders/edit','Admin\AdminOrdersController@edit')->name('admin.orders.edit.submit');
  Route::post('/orders/updateRaceStatus/{oid}', 'Admin\AdminOrdersController@updateRaceStatus')->name('admin.orders.updateRaceStatus');
  //Contacts
  Route::get('/contacts','Admin\AdminContactsController@index')->name('admin.contacts');
  Route::get('/contacts/search', 'Admin\AdminContactsController@search')->name('admin.contacts.search');
  Route::get('/contacts/filter', 'Admin\AdminContactsController@filter')->name('admin.contacts.filter');
  Route::delete('/contacts/{cid}','Admin\AdminContactsController@destroy')->name('admin.contacts.destroy');
});

//Verify Email
Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@verifyEmailDone')->name('verifyEmailDone');

//Strava
Route::get('/strava/getAuthToken','API\StravaController@getAuthToken')->name('strava.getToken');
Route::post('/strava/getStats','API\StravaController@getStats')->name('strava.getStats');
Route::post('/strava/getLatest', 'API\StravaController@getLatest')->name('strava.getLatest');
Route::post('/strava/disconnect','API\StravaController@disconnect')->name('strava.disconnect');

//User profile
Route::post('/user/upload', 'User\UserController@handleProfileImg' )->name('user.profileImg');
Route::post('/user/uploadImage', 'User\UserController@uploadProfileImg' )->name('user.uploadImg');
Route::post('/user/updateProfile', 'User\UserController@updateProfile' )->name('user.updateProfile');
Route::post('/user/updateAddress', 'User\UserController@updateAddress' )->name('user.updateAddress');
Route::post('/user/updatePassword', 'User\UserController@updatePassword' )->name('user.updatePassword');

Route::post('/user/uploadRoute', 'User\UserController@uploadRoute' )->name('user.uploadRoute');
Route::post('/user/updateSubmission', 'User\UserController@updateSubmission' )->name('user.updateSubmission');
Route::post('/user/deleteSubmission', 'User\UserController@deleteSubmission' )->name('user.deleteSubmission');

//Register race
Route::post('/user/submitrace', 'User\UserController@submitRace')->name('user.submitrace');

//Contact Us
Route::post('/submitcontact', 'Pages\ContactController@submitContact')->name('submitcontact');

// OAuth Routes
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
