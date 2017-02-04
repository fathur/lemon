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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::group([

    'prefix'     => 'permission',
    'namespace'  => 'Permission',
    'middleware' => ['auth']

], function () {

    Route::get('users/data', ['uses' => 'UserController@data', 'as' => 'users.data']);
    Route::resource('users', 'UserController', ['except' => ['show']]);

    Route::get('users/{user}/password', ['uses' => 'UserController@password', 'as' => 'users.password.index']);
    Route::put('users/{user}/password', ['uses' => 'UserController@changePassword', 'as' => 'users.password.update']);

    Route::get('roles/select', ['uses' => 'RoleController@select', 'as' => 'roles.select']);
    Route::get('roles/data', ['uses' => 'RoleController@data', 'as' => 'roles.data']);
    Route::resource('roles', 'RoleController', ['except' => ['show']]);

    Route::get('manage', ['uses' => 'ManagerController@index', 'as' => 'permissions.index']);
    Route::get('manage/data', ['uses' => 'ManagerController@data', 'as' => 'permissions.data']);
    Route::put('manage', ['uses' => 'ManagerController@manage', 'as' => 'permissions.manage']);
});

Route::get('posts/data', ['uses' => 'PostController@data', 'as' => 'posts.data']);
Route::resource('posts', 'PostController');
