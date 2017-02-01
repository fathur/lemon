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

Route::get('/', function () {
    return view('layout.default');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group([
    'prefix'    => 'permission',
    'namespace' => 'Permission',
    'middleware' => ['auth']
], function () {
    Route::get('users/data', ['uses' => 'UserController@data', 'as' => 'users.data']);
    Route::resource('users', 'UserController', [
        'except' => ['show']
    ]);

    Route::get('roles/select', ['uses' => 'RoleController@select', 'as' => 'roles.select']);
    Route::get('roles/data', ['uses' => 'RoleController@data', 'as' => 'roles.data']);
    Route::resource('roles', 'RoleController');

    Route::get('manage', 'PermissionController@show');
    Route::post('manage', 'PermissionController@manage');
});
