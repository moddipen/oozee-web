<?php

Route::group(['namespace' => 'Admin'], function () {

    Route::get('/home', 'GeneralController@dashboard')->name('home');
    Route::post('location-users', 'GeneralController@getUsersByLocation')->name('location.users');
    Route::get('profile', 'AdminUserController@profile')->name('profile');
    Route::post('update-profile', 'AdminUserController@updateProfile')->name('update-profile');
    Route::put('admin-users/{id}/password-change','AdminUserController@changePassword')->name('admin-users.password-change');

    /**
     * Admin User routes
     */
    Route::group(['middleware' => ['permission:admin-user-views']], function () {
        Route::get('/admin-users','AdminUserController@index')->name('admin-users.index');
        Route::get('admin-users-ajax', 'AdminUserController@getAdminUsers')->name('ajax.admin-users');
    });
    Route::group(['middleware' => ['permission:admin-user-create']], function () {
        Route::get('/admin-users/create','AdminUserController@create')->name('admin-users.create');
        Route::post('admin-users','AdminUserController@store')->name('admin-users.store');
    });
    Route::group(['middleware' => ['permission:admin-user-edit']], function () {
        Route::get('/admin-users/{id}/edit','AdminUserController@edit')->name('admin-users.edit');
        Route::put('admin-users/{id}/update','AdminUserController@update')->name('admin-users.update');
    });
    Route::group(['middleware' => ['permission:admin-user-show']], function () {
        Route::get('/admin-users/{id}/show','AdminUserController@show')->name('admin-users.show');
    });
    Route::group(['middleware' => ['permission:admin-user-delete']], function () {
        Route::delete('/admin-users/{id}','AdminUserController@destroy')->name('admin-users.destroy');
    });

    /**
     * Role routes
     */
    Route::group(['middleware' => ['permission:role-views']], function () {
        Route::get('roles','RoleController@index')->name('roles.index');
        Route::get('roles-ajax', 'RoleController@getRoles')->name('ajax.roles');
    });
    Route::group(['middleware' => ['permission:role-create']], function () {
        Route::get('roles/create','RoleController@create')->name('roles.create');
        Route::post('roles','RoleController@store')->name('roles.store');
    });
    Route::group(['middleware' => ['permission:role-edit']], function () {
        Route::get('roles/{id}/edit','RoleController@edit')->name('roles.edit');
        Route::put('roles/{id}/update','RoleController@update')->name('roles.update');
    });
    Route::group(['middleware' => ['permission:role-show']], function () {
        Route::get('roles/{id}/show','RoleController@show')->name('roles.show');
    });
    Route::group(['middleware' => ['permission:role-delete']], function () {
        Route::delete('roles/{id}','RoleController@destroy')->name('roles.destroy');
    });

    /**
     * Permissions routes
     */
    Route::group(['middleware' => ['permission:permission-views']], function () {
        Route::get('permissions','PermissionController@index')->name('permissions.index');
        Route::get('permissions-ajax', 'PermissionController@getPermissions')->name('ajax.permissions');
    });
    Route::group(['middleware' => ['permission:permission-create']], function () {
        Route::get('permissions/create','PermissionController@create')->name('permissions.create');
        Route::post('permissions','PermissionController@store')->name('permissions.store');
    });
    Route::group(['middleware' => ['permission:permission-edit']], function () {
        Route::get('permissions/{id}/edit','PermissionController@edit')->name('permissions.edit');
        Route::put('permissions/{id}/update','PermissionController@update')->name('permissions.update');
    });
    Route::group(['middleware' => ['permission:permission-show']], function () {
        Route::get('permissions/{id}/show','PermissionController@show')->name('permissions.show');
    });
    Route::group(['middleware' => ['permission:permission-delete']], function () {
        Route::delete('permissions/{id}','PermissionController@destroy')->name('permissions.destroy');
    });

    /**
     * Blog routes
     */
    Route::group(['middleware' => ['permission:blog-views']], function () {
        Route::get('blogs','BlogController@index')->name('blogs.index');
        Route::get('blogs-ajax', 'BlogController@getBlogs')->name('ajax.blogs');
    });
    Route::group(['middleware' => ['permission:blog-create']], function () {
        Route::get('blogs/create','BlogController@create')->name('blogs.create');
        Route::post('blogs','BlogController@store')->name('blogs.store');
    });
    Route::group(['middleware' => ['permission:blog-edit']], function () {
        Route::get('blogs/{id}/edit','BlogController@edit')->name('blogs.edit');
        Route::put('blogs/{id}/update','BlogController@update')->name('blogs.update');
    });
    Route::group(['middleware' => ['permission:blog-show']], function () {
        Route::get('blogs/{id}/show','BlogController@show')->name('blogs.show');
    });
    Route::group(['middleware' => ['permission:blog-delete']], function () {
        Route::delete('blogs/{id}','BlogController@destroy')->name('blogs.destroy');
    });

     /**
     * Feedback routes
     */
    Route::group(['middleware' => ['permission:feedback']], function () {
        Route::get('feedback','FeedbackController@index')->name('feedback.index');
        Route::get('feedback-ajax', 'FeedbackController@getFeedback')->name('ajax.feedback');
    });

    /**
     * News routes
     */
    Route::group(['middleware' => ['permission:news-views']], function () {
        Route::get('news','NewsController@index')->name('news.index');
        Route::get('news-ajax', 'NewsController@getNews')->name('ajax.news');
    });
    Route::group(['middleware' => ['permission:news-create']], function () {
        Route::get('news/create','NewsController@create')->name('news.create');
        Route::post('news','NewsController@store')->name('news.store');
    });
    Route::group(['middleware' => ['permission:news-edit']], function () {
        Route::get('news/{id}/edit','NewsController@edit')->name('news.edit');
        Route::put('news/{id}/update','NewsController@update')->name('news.update');
    });
    Route::group(['middleware' => ['permission:news-show']], function () {
        Route::get('news/{id}/show','NewsController@show')->name('news.show');
    });
    Route::group(['middleware' => ['permission:news-delete']], function () {
        Route::delete('news/{id}','NewsController@destroy')->name('news.destroy');
    });

    /**
     * Cms page routes
     */
    Route::group(['middleware' => ['permission:cms-views']], function () {
        Route::get('cms','CmsController@index')->name('cms.index');
        Route::get('cms-ajax', 'CmsController@getCms')->name('ajax.cms');
    });
    Route::group(['middleware' => ['permission:cms-create']], function () {
        Route::get('cms/create','CmsController@create')->name('cms.create');
        Route::post('cms','CmsController@store')->name('cms.store');
    });
    Route::group(['middleware' => ['permission:cms-edit']], function () {
        Route::get('cms/{id}/edit','CmsController@edit')->name('cms.edit');
        Route::put('cms/{id}/update','CmsController@update')->name('cms.update');
    });
    Route::group(['middleware' => ['permission:cms-show']], function () {
        Route::get('cms/{id}/show','CmsController@show')->name('cms.show');
    });
    Route::group(['middleware' => ['permission:cms-delete']], function () {
        Route::delete('cms/{id}','CmsController@destroy')->name('cms.destroy');
    });

    /**
     * User routes
     */
    Route::group(['middleware' => ['permission:user-views']], function () {
        Route::get('users','UserController@index')->name('users.index');
        Route::get('users-ajax', 'UserController@getUsers')->name('ajax.users');
    });
    Route::group(['middleware' => ['permission:user-create']], function () {
        Route::get('users/create','UserController@create')->name('users.create');
        Route::post('users','UserController@store')->name('users.store');
    });
    Route::group(['middleware' => ['permission:user-edit']], function () {
        Route::get('users/{id}/edit','UserController@edit')->name('users.edit');
        Route::put('users/{id}/update','UserController@update')->name('users.update');
    });
    Route::group(['middleware' => ['permission:user-details']], function () {
        Route::post('users-details','UserController@getUserDetails')->name('users.details');
        Route::get('export-user-contacts/{id}','UserController@downloadUserContacts')->name('export.user.contacts');
    });
    Route::group(['middleware' => ['permission:user-delete']], function () {
        Route::delete('users/{id}','UserController@destroy')->name('users.destroy');
    });
    Route::group(['middleware' => ['permission:user-suspend']], function () {
        Route::post('users/suspend','UserController@suspend')->name('users.suspend');
    });

    /**
     * Plans routes
     */
    Route::group(['middleware' => ['permission:plan-views']], function () {
        Route::get('plans','PlanController@index')->name('plans.index');
        Route::get('plans-ajax', 'PlanController@getPlans')->name('ajax.plans');
    });
    Route::group(['middleware' => ['permission:plan-create']], function () {
        Route::get('plans/create','PlanController@create')->name('plans.create');
        Route::post('plans','PlanController@store')->name('plans.store');
    });
    Route::group(['middleware' => ['permission:plan-edit']], function () {
        Route::get('plans/{id}/edit','PlanController@edit')->name('plans.edit');
        Route::put('plans/{id}/update','PlanController@update')->name('plans.update');
    });
    Route::group(['middleware' => ['permission:plan-show']], function () {
        Route::get('plans/{id}/show','PlanController@show')->name('plans.show');
    });
    Route::group(['middleware' => ['permission:plan-delete']], function () {
        Route::delete('plans/{id}','PlanController@destroy')->name('plans.destroy');
    });

    /**
     * Contacts routes
     */
    Route::group(['middleware' => ['permission:contact-views']], function () {
        Route::get('contacts','ContactController@index')->name('contacts.index');
        Route::get('contacts-ajax', 'ContactController@getContacts')->name('ajax.contacts');
    });
    Route::group(['middleware' => ['permission:contact-import']], function () {
        Route::post('contacts/import','ContactController@import')->name('contacts.import');
    });

    /**
     * Notifications routes
     */
    Route::group(['middleware' => ['permission:notification-send']], function () {
        Route::get('notification-create','NotificationController@create')->name('notification.create');
        Route::post('notification-send','NotificationController@send')->name('notification.send');
    });
});