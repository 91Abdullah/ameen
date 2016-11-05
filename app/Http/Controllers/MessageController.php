<?php

namespace App\Http\Controllers;

use App\Jobs\SendStatusUpdate;
use App\TextMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;

use anlutro\LaravelSettings\Facade as Setting;

use App\Http\Requests;
use Ixudra\Curl\Facades\Curl;
use Orchestra\Parser\Xml\Facade as XmlParser;

class MessageController extends Controller
{
    public function index()
    {

    }

    public function recieved()
    {
        $smessages = TextMessage::latest()->where("type", "=", "Incoming")->simplePaginate(5);
        $typeOf = 'Recieved';
        return view('admin.messages.index', compact('smessages', 'typeOf'));
    }

    public function sent()
    {
        $smessages = TextMessage::latest()->where("type", "=", "Outgoing")->simplePaginate(5);
        $typeOf = 'Sent';
        return view('admin.messages.index', compact('smessages', 'typeOf'));
    }

    public function send(Request $request)
    {
        $server_ip = Setting::get("server_ip");
        $port = Setting::get("server_port");
        $user_id = Setting::get("user_id");
        $password = Setting::get("password");
        $url = "http://" . $server_ip . ":" . $port . "/api";
        $response = Curl::to($url)
            ->withData([
            "action" => "sendmessage",
            "username" => $user_id,
            "password" => $password,
            "recipient" => $request->reciever,
            "messagedata" => $request->message
        ])
            ->get();

        if($response !== false) {
            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $arr = json_decode($json,true);

            $message = new TextMessage();
            $message->sender = "82660";
            $message->reciever = $request->reciever;
            $message->message = $request->message;
            $message->status = $arr['data']['acceptreport']['statusmessage'];
            $message->type = "Outgoing";
            $message->message_id = $arr['data']['acceptreport']['messageid'];
            $message->save();
            dispatch((new SendStatusUpdate($message))->delay(Carbon::now()->addMinutes(5)));
            return response()->json(['message' => $message]);
        }
        else
            return response()->json($response);
    }
}
