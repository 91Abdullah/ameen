<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);

Route::get('/calls', ['as' => 'admin.calls', 'uses' => 'CallController@index']);

Route::get('/messages', ['as' => 'admin.messages', 'uses' => 'MessageController@index']);

Route::get('/imap', ['as' => 'admin.imap', 'uses' => 'ImapController@index']);
Route::get('/imap/{id}', ['as' => 'admin.imap.view', 'uses' => 'ImapController@view']);

Route::get('/emails/sync', ['as' => 'admin.emails.sync', 'uses' => 'EmailController@sync']);

Route::get('/emails/sent/{id}', ['as' => 'admin.emails.showSent', 'uses' => 'EmailController@showSent']);

Route::get('/emails/inbox', ['as' => 'admin.emails', 'uses' => 'EmailController@index']);
Route::post('/emails/reply', ['as' => 'admin.emails.sendReply', 'uses' => 'EmailController@sendReply']);
Route::get('/emails/compose', ['as' => 'admin.emails.compose',  'uses' => 'EmailController@compose']);
Route::get('/emails/sent', ['as' => 'admin.emails.sent', 'uses' => 'EmailController@sent']);
Route::get('/emails/inbox/{id}', ['as' => 'admin.emails.show', 'uses' => 'EmailController@show']);

Route::get('/emails/{id}/reply', ['as' => 'admin.emails.reply', 'uses' => 'EmailController@reply']);
Route::get('/emails/{id}/forward', ['as' => 'admin.emails.forward', 'uses' => 'EmailController@forward']);
Route::get('/emails/{id}/delete', ['as' => 'admin.emails.delete', 'uses' => 'EmailController@delete']);

Route::get('/preferences', ['as' => 'admin.preferences', 'uses' => 'PreferenceController@index']);
Route::post('/preferences', ['as' => 'admin.preferences', 'uses' => 'PreferenceController@save']);
