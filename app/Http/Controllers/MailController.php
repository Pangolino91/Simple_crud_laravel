<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function send() {
        $name = 'Jacopo';
        Mail::to('enrico.cerri1991@gmail.com')->send(new SendMailable($name));
        
        return 'Email was sent';
    }
}
