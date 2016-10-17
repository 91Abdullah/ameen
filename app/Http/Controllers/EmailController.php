<?php

namespace App\Http\Controllers;

use App\Body;
use App\Preference;
use App\SentItem;
use App\Inbox;
use App\From;
use App\ReplyTo;
use App\Sync;
use App\To;
use App\Cc;
use App\Bcc;
use App\Sender;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Zalazdi\LaravelImap\Client;
use Zalazdi\LaravelImap\Mailbox;

use App\Http\Requests;
use Zalazdi\LaravelImap\Message;

class EmailController extends Controller
{
    public function index()
    {
        /*$preferences = Preference::first();
        $client = new Client();
        $client->host = $preferences->host;
        $client->port = $preferences->port;
        $client->encryption = $preferences->encryption;
        $client->password = $preferences->password;
        $client->username = $preferences->username;
        $client->password = $preferences->password;
        $client->validate_cert = $preferences->validate_cert;
        $client->connect();
        $mailbox = new Mailbox($client, null, 'INBOX');
        $messages = $client->getMessages($mailbox);
        //return view('admin.emails.index', compact('messages'));
        return dd($messages);*/
        $messages = Inbox::all();
        $sync = Sync::all()->last();
        return view('admin.emails.index', compact('messages', 'sync'));
    }

    public function sync()
    {
        $preferences = Preference::first();
        $client = new Client();
        $client->host = $preferences->host;
        $client->port = $preferences->port;
        $client->encryption = $preferences->encryption;
        $client->password = $preferences->password;
        $client->username = $preferences->username;
        $client->password = $preferences->password;
        $client->validate_cert = $preferences->validate_cert;
        $client->connect();
        $mailbox = new Mailbox($client, null, 'INBOX');
        $messages = $client->getMessages($mailbox);

        $inboxes = Inbox::all();

        if (count($messages) == count($inboxes)) {
            Sync::create(['last_sync' => Carbon::now()]);
            return redirect()->route('admin.emails');
        }

        foreach ($messages as $message) {
            $inbox = new Inbox();
            $inbox->subject = $message->subject;
            $inbox->message_id = $message->message_id;
            $inbox->message_no = $message->message_no;
            $inbox->date = $message->date;
            $inbox->save();
            foreach ($message->from as $index => $from) {
                $from_ = new From();
                $from_->mail = $from->mail;
                $from_->mailbox = $from->mailbox;
                $from_->personal = $from->personal;
                $from_->host = $from->host;
                $from_->full = $from->full;
                $inbox->froms()->save($from_);
            }
            foreach ($message->to as $index => $to) {
                $to_ = new To();
                $to_->mail = $to->mail;
                $to_->mailbox = $to->mailbox;
                $to_->personal = $to->personal;
                $to_->host = $to->host;
                $to_->full = $to->full;
                $inbox->tos()->save($to_);
            }
            foreach ($message->reply_to as $index => $replyTo) {
                $replyTo_ = new ReplyTo();
                $replyTo_->mail = $replyTo->mail;
                $replyTo_->mailbox = $replyTo->mailbox;
                $replyTo_->personal = $replyTo->personal;
                $replyTo_->host = $replyTo->host;
                $replyTo_->full = $replyTo->full;
                $inbox->replyTos()->save($replyTo_);
            }
            foreach ($message->cc as $index => $cc) {
                $cc_ = new Cc();
                $cc_->mail = $cc->mail;
                $cc_->mailbox = $cc->mailbox;
                $cc_->personal = $cc->personal;
                $cc_->host = $cc->host;
                $cc_->full = $cc->full;
                $inbox->froms()->save($cc_);
            }
            foreach ($message->bcc as $index => $bcc) {
                $bcc_ = new Bcc();
                $bcc_->mail = $bcc->mail;
                $bcc_->mailbox = $bcc->mailbox;
                $bcc_->personal = $bcc->personal;
                $bcc_->host = $bcc->host;
                $bcc_->full = $bcc->full;
                $inbox->bccs()->save($bcc_);
            }
            foreach ($message->sender as $index => $sender) {
                $sender_ = new Sender();
                $sender_->mail = $sender->mail;
                $sender_->mailbox = $sender->mailbox;
                $sender_->personal = $sender->personal;
                $sender_->host = $sender->host;
                $sender_->full = $sender->full;
                $inbox->senders()->save($sender_);
            }
            if ($message->hasTextBody())
            {
                $body = new Body();
                $body->type = "text";
                $body->content = $message->bodies['text']->content;
                $inbox->body()->save($body);
            }
            else
            {
                $body = new Body();
                $body->type = "html";
                $body->content = $message->bodies['html']->content;
                $inbox->body()->save($body);
            }
            $status = $inbox->update();
            if ($status)
                Sync::create(['last_sync' => Carbon::now()]);
        }
        return redirect()->route('admin.emails');
    }

    public function sent()
    {
        $messages = SentItem::all(['to', 'cc', 'bcc', 'from', 'message', 'created_at']);
        return view('admin.emails.sent', compact('messages'));
    }

    public function showSent($id)
    {
        $message = SentItem::findOrFail($id);
        return view('admin.emails.showSent', compact('message'));
    }

    public function reply($id)
    {
        $preferences = Preference::first();
        $client = new Client();
        $client->host = $preferences->host;
        $client->port = $preferences->port;
        $client->encryption = $preferences->encryption;
        $client->password = $preferences->password;
        $client->username = $preferences->username;
        $client->password = $preferences->password;
        $client->validate_cert = $preferences->validate_cert;
        $client->connect();
        $message = new Message($client, $id);
        return view('admin.emails.reply', compact('message'));
    }

    public function compose()
    {
        return view('admin.emails.compose');
    }

    public function sendReply(Request $request)
    {
        Mail::send('admin.emails.blank', ['msg' => $request->message], function($message) use ($request) {
            $message->from('customer.first@ocs.com.pk', 'Customer First');
            $message->to($request->to)->subject($request->subject);
            if ($request->cc)
                $message->cc($request->cc);
            if ($request->bcc)
                $message->bcc($request->bcc);
            $sentItem = new SentItem();
            $sentItem->to = $request->to;
            $sentItem->from = 'customer.first@ocs.com.pk';
            $sentItem->subject = $request->subject;
            $sentItem->cc = $request->cc;
            $sentItem->bcc = $request->bcc;
            $sentItem->message = $request->message;
            $sentItem->save();
        });
        return redirect()->route('admin.emails');
    }

    public function show($id)
    {
        $preferences = Preference::first();
        $client = new Client();
        $client->host = $preferences->host;
        $client->port = $preferences->port;
        $client->encryption = $preferences->encryption;
        $client->password = $preferences->password;
        $client->username = $preferences->username;
        $client->password = $preferences->password;
        $client->validate_cert = $preferences->validate_cert;
        $client->connect();
        $message = new Message($client, (int)$id);
        return view('admin.emails.view', compact('message'));
    }
}
