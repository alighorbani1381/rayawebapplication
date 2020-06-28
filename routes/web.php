<?php

use Illuminate\Support\Facades\Hash;
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

# Authentication Routes
Route::group(['namespace' => 'Admin'], function () {
    Route::get('login', 'UserController@showLogin')->name('login.show');
    Route::post('login', 'UserController@checkLogin')->name('login.check');
    Route::get('logout', 'UserController@logout')->name('logout');
});

# Administrator Routes
Route::group(['namespace' => 'Admin', 'middleware' => ['isLogin', 'isAdmin'], 'prefix' => 'admin'], function () {
    Route::resource('costs/static', 'CoststaticController');
    Route::resource('costs', 'CostController');
    Route::get('dashborad', 'IndexController@index')->name('admin.dashboard');
    Route::get('earnings/pay/{earning?}', 'EarningController@create')->name('earnings.pay');
    Route::resource('earnings', 'EarningController');
    Route::resource('categories', 'CategoryController');
    Route::post('projects/contractors/divide', 'ProjectController@percentDivide')->name('projects.divide');
    Route::resource('projects', 'ProjectController');
    Route::resource('users', 'UserController');
    Route::get('give/contractor', 'UserController@getContractors');
});

# Contractors (Users) Routes
Route::group(['namespace' => 'Contractor', 'middleware' => ['isLogin']], function () {
    Route::get('dashborad', 'IndexController@index')->name('contractor.dashbord');
    Route::get('projects', 'ProjectController@index')->name('contractor.projects.index');
    Route::get('projects/ongoing', 'ProjectController@ongoing')->name('contractor.projects.ongoing');
    Route::get('projects/finished', 'ProjectController@finished')->name('contractor.projects.finished');
    Route::get('projects/{project}', 'ProjectController@show')->name('contractor.projects.show');
    Route::get('projects/{project}/progress', 'ProjectController@showProgress')->name('contractor.projects.show.progress');
    Route::post('projects/progress', 'ProjectController@storeProgress')->name('contractor.projects.store.progress');
    Route::get('profile', 'ProfileController@info')->name('contractor.profile.index');
    Route::post('profile/change/password', 'ProfileController@changePassword')->name('profile.change.password');
});

# Debug or Test Rotue
Route::get('test', function () {
    return Hash::make('raya-px724');
});
