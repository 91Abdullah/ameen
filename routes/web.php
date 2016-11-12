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

use Ixudra\Curl\Facades\Curl;

Route::get('/', ['as' => 'admin.login', 'uses' => 'LoginController@index']);
Route::post('/login', ['as' => 'admin.login.auth', 'uses' => 'LoginController@authenticate']);
Route::get('/login', ['as' => 'admin.login.check', 'uses' => 'LoginController@index']);

Route::get('/test/apiTest', function() {
    $response = Curl::to("http://server/ameen/public/api/message")
        ->withData([
            "sender" => "03350362957",
            "message" => "Test Message"
        ])
        ->get();
    return dd($response);
});

Route::get('/dbTest', ['as' => 'dbtest', 'uses' => 'TestController@dbtest']);


Route::group(['middleware' => 'auth'], function() {

    Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'LoginController@logout']);

    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);

    Route::get('/calls', ['as' => 'admin.calls', 'uses' => 'CallController@index']);
    Route::get('/getRecording', ['as' => 'admin.getFile', 'uses' => 'CallController@getFile']);
    Route::get('/audio/{filename}', ['as' => 'admin.getAudio', 'uses' => 'CallController@getAudio']);

//Messages

    Route::get('/messages', ['as' => 'admin.messages', 'uses' => 'MessageController@index']);
    Route::post('/messages/send', ['as' => 'admin.messages.send', 'uses' => 'MessageController@send']);
    Route::get('/messages/sent', ['as' => 'admin.messages.sent', 'uses' => 'MessageController@sent']);
    Route::get('/messages/recieved', ['as' => 'admin.messages.recieved', 'uses' => 'MessageController@recieved']);

//End Messages

    Route::get('/imap', ['as' => 'admin.imap', 'uses' => 'ImapController@index']);
    Route::get('/imap/getMails/all', ['as' => 'admin.imap.getMails', 'uses' => 'ImapController@getMails']);
    Route::get('/imap/{id}', ['as' => 'admin.imap.view', 'uses' => 'ImapController@view']);
    Route::get('/downloadFile/{filename}', ['as' => 'admin.imap.downloadFile', 'uses' => 'ImapController@downloadFile']);

/*    Route::get('/emails/sync', ['as' => 'admin.emails.sync', 'uses' => 'EmailController@sync']);

    Route::get('/emails/sent/{id}', ['as' => 'admin.emails.showSent', 'uses' => 'EmailController@showSent']);

    Route::get('/emails/inbox', ['as' => 'admin.emails', 'uses' => 'EmailController@index']);
    Route::post('/emails/reply', ['as' => 'admin.emails.sendReply', 'uses' => 'EmailController@sendReply']);
    Route::get('/emails/compose', ['as' => 'admin.emails.compose',  'uses' => 'EmailController@compose']);
    Route::get('/emails/sent', ['as' => 'admin.emails.sent', 'uses' => 'EmailController@sent']);
    Route::get('/emails/inbox/{id}', ['as' => 'admin.emails.show', 'uses' => 'EmailController@show']);

    Route::get('/emails/{id}/reply', ['as' => 'admin.emails.reply', 'uses' => 'EmailController@reply']);
    Route::get('/emails/{id}/forward', ['as' => 'admin.emails.forward', 'uses' => 'EmailController@forward']);
    Route::get('/emails/{id}/delete', ['as' => 'admin.emails.delete', 'uses' => 'EmailController@delete']);*/

    Route::get('/preferences/mail', ['as' => 'admin.preferences.mail', 'uses' => 'PreferenceController@index']);
    Route::post('/preferences/mail', ['as' => 'admin.preferences.mail', 'uses' => 'PreferenceController@save']);

    Route::get('/preferences/user', ['as' => 'admin.preferences.user', 'uses' => 'PreferenceController@createUser']);
    Route::post('/preferences/user', ['as' => 'admin.preferences.user', 'uses' => 'PreferenceController@addUser']);
    Route::get('/preferences/updateUser', ['as' => 'admin.preferences.updateUser', 'uses' => 'PreferenceController@updateUser']);
    Route::put('/preferences/editUser', ['as' => 'admin.preferences.editUser', 'uses' => 'PreferenceController@editUser']);
    Route::delete('/preferences/deleteUser', ['as' => 'admin.preferences.deleteUser', 'uses' => 'PreferenceController@deleteUser']);

    Route::get('/preferences/message', ['as' => 'admin.preferences.messageIndex', 'uses' => 'PreferenceController@messageIndex']);
    Route::post('/preferences/message', ['as' => 'admin.preferences.messageSave', 'uses' => 'PreferenceController@messageSave']);
    Route::post('/preferences/status', ['as' => 'admin.preferences.statusSave', 'uses' => 'PreferenceController@statusSave']);
});
