<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use PhpImap\Mailbox as ImapMailbox;
use PhpImap\IncomingMail;
use PhpImap\IncomingMailAttachment;

class ImapController extends Controller
{
    //
    public function index()
    {
        $mailbox = new ImapMailbox('{mail.ocs.com.pk:993/imap/ssl/novalidate-cert}INBOX', 'customer.first@ocs.com.pk', 'ocs123+');
        // Read all messaged into an array:
        $mailsIds = $mailbox->searchMailbox('ALL');
        if(!$mailsIds) {
            die('Mailbox is empty');
        }
        $mail = [];
        foreach ($mailsIds as $mailsId) {
            $mail[] = $mailbox->getMail($mailsId);
        }
        return view('admin.imap.index', compact('mail'));
    }

    public function view($id)
    {
        $mailbox = new ImapMailbox('{mail.ocs.com.pk:993/imap/ssl/novalidate-cert}INBOX', 'customer.first@ocs.com.pk', 'ocs123+');
        $mail = $mailbox->getMail($id);
        return view('admin.imap.view', ['message' => $mail]);
    }
}
