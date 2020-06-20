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

Route::get('/', function () {
    return view('welcome');
});

# Auth Route
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    Route::get('dashborad', 'IndexController@index')->name('admin.dashboard');
    Route::resource('earnings', 'EarningController');
    Route::resource('categories', 'CategoryController');
    Route::post('projects/contractors/divide', 'ProjectController@percentDivide')->name('projects.divide');
    Route::resource('projects', 'ProjectController');
    Route::resource('users', 'UserController');
});
Route::get('test', function(){
    
});

