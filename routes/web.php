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

    # ACL Routes

    // Permission Route
    Route::get('permissions', 'ACLController@indexPermission')->name('per.index');
    Route::get('permissions/create', 'ACLController@createPermission')->name('per.create');
    Route::post('permissions/store', 'ACLController@storePermission')->name('per.store');

    // Role Route
    Route::get('roles', 'ACLController@indexRole')->name('roles.index');
    Route::get('roles/create', 'ACLController@createRole')->name('roles.create');
    Route::post('roles/store', 'ACLController@storeRole')->name('roles.store');
    Route::get('roles/{role}/edit', 'ACLController@storeRole')->name('roles.edit');
    Route::delete('roles/delete', 'ACLController@storeRole')->name('roles.destroy');



    Route::resource('costs/static', 'CoststaticController');
    Route::resource('costs', 'CostController');
    Route::get('dashborad', 'IndexController@index')->name('admin.dashboard');
    Route::get('earnings/pay/{earning?}', 'EarningController@create')->name('earnings.pay');
    Route::resource('earnings', 'EarningController');
    Route::resource('categories', 'CategoryController');
    Route::post('profile/change/password', 'ProfileController@changePassword')->name('admin.password.change');
    Route::post('profile/change/image', 'ProfileController@changeImage')->name('admin.image.change');
    Route::get('profile', 'ProfileController@index')->name('admin.profile.index');
    Route::post('projects/contractors/divide', 'ProjectController@percentDivide')->name('projects.divide');
    Route::post('projects/complete', 'ProjectController@complete')->name('projects.complete');
    Route::resource('projects', 'ProjectController');
    Route::resource('users', 'UserController');
    Route::get('give/contractor', 'UserController@getContractors');
});

# Contractors (Users) Routes
Route::group(['namespace' => 'Contractor', 'middleware' => ['isLogin', 'isContractor'], 'prefix' => 'panel'], function () {
    Route::get('dashborad', 'IndexController@index')->name('contractor.dashbord');
    Route::get('projects', 'ProjectController@index')->name('contractor.projects.index');
    Route::get('projects/ongoing', 'ProjectController@ongoing')->name('contractor.projects.ongoing');
    Route::get('projects/finished', 'ProjectController@finished')->name('contractor.projects.finished');
    Route::get('projects/{project}', 'ProjectController@show')->name('contractor.projects.show');
    Route::get('projects/{project}/progress', 'ProjectController@showProgress')->name('contractor.projects.show.progress');
    Route::post('projects/progress', 'ProjectController@storeProgress')->name('contractor.projects.store.progress');
    Route::post('profile/change/password', 'ProfileController@changePassword')->name('profile.change.password');
    Route::get('profile', 'ProfileController@info')->name('contractor.profile.index');
    Route::post('profile/change/image', 'ProfileController@changeImage')->name('profile.change.image');
    Route::get('earnings', 'EarningController@index')->name('contractor.earning.index');
    Route::get('earnings/project/{project}', 'EarningController@project')->name('contractor.earning.project');
    Route::get('earnings/credit', 'EarningController@credit')->name('contractor.earning.credit');
    Route::get('earnings/{earnings}', 'EarningController@show')->name('contractor.earning.show');

});

# Debug or Test Rotue
Route::get('test', function () {
    return Hash::make('raya-px724');
});
