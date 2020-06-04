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

Route::get('/','PagesController@root')->name('root');
//Route::get('sss','PagesController@root')->name('root1');
//Route::get('home','StaticPagesController@home')->name('home');
//Route::get('/help','StaticPagesController@help')->name('help');
//Route::get('/about','StaticPagesController@about')->name('about');

//Route::get('/signup','UsersController@create')->name('signup');
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
//Route::get('/login','SessionsController@create')->name('login');
//Route::post('login','SessionsController@store')->name('login');
//Route::delete('logout','SessionsController@destroy')->name('logout');
//Route::get('/users/{user}/edit','UsersController@edit')->name('users.edit');

//Route::get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');
//Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');
//Route::resource('statuses','StatusesController',['only' => ['store','destroy']]);
//Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
//Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');
//Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
//Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');




//Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
//
//
// 用户身份验证相关的路由
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// 用户注册相关路由
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// 密码重置相关路由
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email 认证相关路由
//Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
//Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
//Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::resource('topics', 'TopicsController', ['only' => ['index',  'create', 'store', 'update', 'edit', 'destroy']]);

Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

//设置上传图片的 URL
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
