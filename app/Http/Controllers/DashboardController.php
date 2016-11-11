<?php

namespace App\Http\Controllers;

use App\Cdr;
use App\TextMessage;
use Illuminate\Http\Request;
use PhpImap\Mailbox as ImapMailbox;

use App\Http\Requests;

class DashboardController extends Controller
{
    public function index()
    {
        $rmessages = TextMessage::where("type", "=", "Incoming")->count();
        $smessages = TextMessage::where("type", "=", "Outgoing")->count();
        $mailbox = new ImapMailbox('{mail.ocs.com.pk:993/imap/ssl/novalidate-cert}INBOX', 'feedback.view@ocs.com.pk', 'ocs123+');
        //$mails = 11;
        $mails = $mailbox->countMails();
        $calls = Cdr::where('lastapp', '=', 'VoiceMail')->count();
        return view('admin.dashboard', compact('rmessages', 'smessages', 'mails', 'calls'));
    }
}
