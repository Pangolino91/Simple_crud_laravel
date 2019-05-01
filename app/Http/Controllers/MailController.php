<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DemoEmail; 
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send()  
    {
        $objDemo = new \stdClass();
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'SenderUserName';
        $objDemo->receiver = 'ReceiverUserName';
 
        Mail::to("enrico.cerri1991@gmail.com")->send(new DemoEmail($objDemo));
        // Mail::to("info@recconsulting-services.com")->send(new DemoEmail($objDemo));
    }
}

