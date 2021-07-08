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
Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('user.register');
Route::post('register', 'Auth\RegisterController@register');

//User Routes
Route::namespace('User')->prefix('user')->name('user.')->group(function () {
	Route::middleware('user')->group(function () {
    	Route::get('dashboard', 'UserController@index')->name('dashboard');
    	Route::get('logout', 'UserController@logout')->name('logout');
	});
});

//SuperAdmin Routes
Route::namespace('SuperAdmin')->prefix('superadmin')->name('superadmin.')->group(function () {
	Route::middleware('superadmin')->group(function () {
    	Route::get('dashboard', 'SuperAdminController@index')->name('dashboard');
    	
    	//Admins
    	Route::get('admins', 'AdminUsersController@index')->name('users.admins');

    	//Domains
    	Route::get('domains', 'DomainsController@index')->name('domains');

    	Route::get('logout', 'SuperAdminController@logout')->name('logout');
	});
});


//Admin Routes
Route::group(['domain' => '{subdomain}.'.env('SITE_DOMAIN')],function() {
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
	Route::middleware('admin')->group(function () {
    	Route::get('dashboard', 'AdminController@index')->name('dashboard');
    	
    	//Users
    	Route::get('users', 'UsersController@index')->name('users');

    	Route::get('logout', 'AdminController@logout')->name('logout');
	});
});
});