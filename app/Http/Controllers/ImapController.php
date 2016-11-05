<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use PhpImap\Mailbox as ImapMailbox;
use PhpImap\IncomingMail;
use PhpImap\IncomingMailAttachment;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImapController extends Controller
{
    //
    public function index()
    {
        /*$mailbox = new ImapMailbox('{mail.ocs.com.pk:993/imap/ssl/novalidate-cert}INBOX', 'feedback.view@ocs.com.pk', 'ocs123+', public_path('attachments'));
        // Read all messaged into an array:
        $mailsIds = $mailbox->sortMails(SORT_ASC);
        if(!$mailsIds) {
            die('Mailbox is empty');
        }
        $mail = [];
        foreach ($mailsIds as $mailsId) {
            $mail[] = $mailbox->getMail($mailsId);
        }*/
        return view('admin.imap.index');
        //return dd($mail);
    }

    public function getMails(Request $request)
    {
        if ($request->ajax())
        {
            $mailbox = new ImapMailbox('{mail.ocs.com.pk:993/imap/ssl/novalidate-cert}INBOX', 'feedback.view@ocs.com.pk', 'ocs123+', public_path('attachments'));
            // Read all messaged into an array:
            $mailsIds = $mailbox->sortMails(SORT_ASC);
            if(!$mailsIds) {
                die('Mailbox is empty');
            }
            $mail = [];
            foreach ($mailsIds as $mailsId) {
                $mail[] = $mailbox->getMail($mailsId);
            }
            if (!is_null($mail))
            {
                foreach ($mail as $obj) {
                    $obj->date = (new Carbon($obj->date))->diffForHumans();
                }

                return response()->json($mail, 200);
            }
            else
                return response()->json('Error fetching mails. Please try again later.', 404);
        }
        else
            return new NotFoundHttpException();
    }

    public function view($id)
    {
        $mailbox = new ImapMailbox('{mail.ocs.com.pk:993/imap/ssl/novalidate-cert}INBOX', 'feedback.view@ocs.com.pk', 'ocs123+');
        $mail = $mailbox->getMail($id);
        $mailbox->setAttachmentsDir(public_path('attachments'));
        //return view('admin.imap.view', ['message' => $mail]);
        return dd($mail->getAttachments());
    }

    public function downloadFile($filename)
    {
        return response()->download(storage_path($filename));
    }
}
