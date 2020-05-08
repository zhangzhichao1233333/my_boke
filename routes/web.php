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

/*Route::get('/', function () {
    return view('welcome');
})*/

Route::get('/','StaticPagesController@home')->name('home');
Route::get('/help','StaticPagesController@help')->name('help');
Route::get('/about','StaticPagesController@about')->name('about');

Route::get('/signup','UsersController@create')->name('signup');
Route::resource('users','UsersController');
/**上面创建的这句话相当于
 * te::get('/users','UsersController@index')->name('users.index'); 显示所有用户列表的页面
 * Route::get('/users/create','UsersController@create')->name('users.create'); 显示用户个人信息的页面
 * Route::get('/users/{user}','UsersController@show')->name('user.show'); 创建用户的页面
 * Route::post('/users','UsersController@store')->name('users.store');  创建用户
 * Route::get('/users/{user}/edit',"UsersControll;er@edit")->name('users.edit');编辑用户个人资料的页面
 * Route::patch('/users/{user}','UsersController@update')->name('user.update');更新用户 
 * Route::delete('/users/{user}','UsersController@destroy')->name('users,destroy'); 删除用户
 */
Route::get('/login','SessionsController@create')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destroy')->name('logout');
Route::get('/users/{user}/edit','UsersController@edit')->name('users.edit');

Route::get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');
