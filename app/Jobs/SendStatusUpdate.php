<?php

namespace App\Jobs;

use App\TextMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use anlutro\LaravelSettings\Facade as Setting;
use Ixudra\Curl\Facades\Curl;

class SendStatusUpdate implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TextMessage $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $server_ip = Setting::get("status_server_ip");
        $port = Setting::get("status_server_port");
        $user_id = Setting::get("status_user_id");
        $password = Setting::get("status_password");
        $url = "http://" . $server_ip . ":" . $port . "/outbox.php";
        $response = Curl::to($url)
            ->withData([
                "username" => $user_id,
                "password" => $password,
                "msgid" => $this->message->message_id
            ])
            ->get();
        $response = json_decode($response);
        if ($response->action == "success") {
            //logger(dd($response));
            $this->message->status = $response->data[0]->status;
            $this->message->update();
        }
    }
}
