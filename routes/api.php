<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api', 'prefix' => 'v1'],function() {
    Route::post('login', 'UserController@login');
    Route::post('refresh-token', 'UserController@refreshToken');
    Route::post('add-media', 'GeneralController@addMedia');
    Route::get('countries', 'GeneralController@countries');
    Route::post('users-details-by-number', 'GeneralController@getUserDetailsByNumber');
    Route::post('call-details', 'ContactController@callPopupDetails');
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api', 'prefix' => 'v1'],function(){
    Route::get('auth-user', 'UserController@getAuthUserDetails');
    Route::post('update-user-profile', 'UserController@updateProfile');
    Route::post('update-user-location', 'UserController@updateLocation');
    Route::post('update-user-settings', 'UserController@updateSettings');
    Route::post('get-user-settings', 'UserController@getSettings');
    Route::post('update-user-status', 'UserController@updateStatus');
    Route::post('get-users-status', 'UserController@getContactUserStatus');
    Route::post('get-chat-users', 'UserController@getChatUsers');

    Route::resource('notes', 'NoteController');
    Route::post('get-notes', 'NoteController@getNotes');

    Route::resource('plans', 'PlanController');
    Route::post('update-user-plan', 'PlanController@updateUserPlan');
    Route::post('get-plan-history', 'PlanController@userPlanHistory');

    Route::resource('voice-messages', 'VoiceMessageController');
    Route::resource('recordings', 'RecordingController');
    Route::post('get-recordings', 'RecordingController@getRecordings');

    Route::get('text-templates', 'GeneralController@textTemplates');
    Route::get('image-templates', 'GeneralController@imageTemplates');
    Route::get('blogs', 'GeneralController@blogs');
    Route::get('blogs/{id}', 'GeneralController@blogById');
    Route::get('news', 'GeneralController@news');
    Route::get('news/{id}', 'GeneralController@newsById');
    Route::get('cms-pages', 'GeneralController@cms');
    Route::get('cms-pages/{id}', 'GeneralController@cmsById');
    Route::get('tags', 'GeneralController@tags');
    Route::get('sub-tags/{id}', 'GeneralController@subTagsById');
    Route::post('user-notifications', 'GeneralController@getNotifications');
    Route::post('feedback', 'GeneralController@feedback');

    Route::post('search', 'ContactController@searchContact');
    Route::post('contact-details', 'ContactController@getNumberDetails');
//    Route::post('call-details', 'ContactController@callPopupDetails');
    Route::post('add-number-tags', 'ContactController@addTagToNumber');
    Route::post('update-number-tags', 'ContactController@updateTagToNumber');
    Route::post('blocked-contacts', 'ContactController@storeBlockContact');
    Route::post('multiple-blocked-contacts', 'ContactController@storeMultipleBlockContact');
    Route::get('blocked-contacts', 'ContactController@getBlockedContacts');
    Route::delete('blocked-contacts/{id}', 'ContactController@destroyBlockedContacts');
    Route::post('quick-lists', 'ContactController@storeQuickContact');
    Route::post('multiple-quick-lists', 'ContactController@storeMultipleQuickContact');
    Route::get('quick-lists', 'ContactController@getQuickListContacts');
    Route::delete('quick-lists/{id}', 'ContactController@destroyQuickListContacts');
    Route::post('dead-contacts', 'ContactController@storeDeadContact');
    Route::post('multiple-dead-contacts', 'ContactController@storeMultipleDeadContact');
    Route::get('dead-contacts', 'ContactController@getDeadContacts');
    Route::delete('dead-contacts/{id}', 'ContactController@destroyDeadContacts');
    Route::post('sync-contacts', 'ContactController@syncContacts');
    Route::post('details', 'ContactController@details');
});