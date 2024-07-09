<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailController extends Controller
{

    public function index()
    {
        $data = [
            "subject"=>"Cambo Tutorial Mail",
            "body"=>"Hello friends, Welcome to Cambo Tutorial Mail Delivery!"
        ];
        // MailNotify class that is extend from Mailable class.
        try
        {
            Mail::to('rothsamreth@gmail.com')->send(new TestMail());
            return response()->json(['Great! Successfully send in your mail']);
        }
        catch(\Exception $e)
        {
            return response()->json(['Sorry! Please try again latter','error'=>$e->getMessage()]);
        }
    }
}
