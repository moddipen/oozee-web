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

Route::get('/admin', function () {
    return redirect('/admin/login');
});

// Social login routes ...
Route::group(['namespace' => 'Frontend', 'prefix' => 'oauth', 'as' => 'oauth.', 'middleware' => ['guest', 'web']], function () {
    Route::get('/{provider}', 'LoginController@redirectToProvider')->name('login')->where('provider', 'google|facebook');
    Route::get('/{provider}/callback', 'LoginController@handleProviderCallback')->name('social.redirect')->where('provider', 'google|facebook');
});

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'GeneralController@index')->name('frontend.home');
    Route::get('/login', 'LoginController@login')->name('login')->middleware('guest');
    Route::get('/download', 'GeneralController@download')->name('download');
    Route::get('/support', 'GeneralController@support')->name('support');
    Route::post('/support-request', 'GeneralController@supportStore')->name('support.store');
    Route::get('/blog', 'GeneralController@blog')->name('blog');
    Route::get('/news', 'GeneralController@news')->name('news');
    Route::get('/blog/{slug}', 'GeneralController@blogDetails')->name('blog.details');
    Route::get('/news/{slug}', 'GeneralController@newsDetails')->name('news.details');
    Route::get('/{slug}', 'GeneralController@cms')->name('cms');
    Route::post('search', function (\Illuminate\Http\Request $request) {
        return redirect('search/' . $request->iso . '/' . $request->number);
    })->name('frontend.search');
});

Route::group(['namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('search/{iso}/{phone}', 'SearchController@search');
    Route::post('update-contact', 'SearchController@updateContact')->name('update.contact');
    Route::post('download-contact', 'SearchController@downloadContact')->name('download.contact');
    Route::post('/logout', 'LoginController@logout')->name('user.logout');
});

Route::group(['middleware' => ['web', 'revalidate']],function(){
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminAuth\LoginController@authenticate')->name('admin.authenticate');
    Route::get('/logout', 'AdminAuth\LoginController@logout')->name('logout');
    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});