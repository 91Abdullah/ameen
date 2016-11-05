<?php

use App\TextMessage;
use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/message', function(Request $request) {
    $message = new TextMessage();
    $message->sender = $request->sender;
    $message->reciever = "82660";
    $message->message = $request->message;
    $message->status = "deliveredincoming";
    $message->type = "Incoming";
    $message->message_id = "0";
    $message->save();
    $message->message_id = $message->id;
    $message->update();
    if($message) {
        return response()->xml(['status' => 'success']);
    }
    else {
        return response()->xml(['status' => 'failed']);
    }
});
