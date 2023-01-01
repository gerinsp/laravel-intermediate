<?php

namespace App\Http\Controllers;

use App\Jobs\SendmailJob;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    public function sendMail()
    {
        SendmailJob::dispatch()->delay(now()->addSeconds(5));   
        echo "Email sent.";
    }
}
