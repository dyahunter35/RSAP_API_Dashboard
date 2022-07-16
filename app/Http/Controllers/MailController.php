<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {

        $details = [
            'title' => 'Dya Deen',
            'body' => 'ASDBjhkjhsaddsd',
        ];

        Mail::to("dyahunter35@gmail.com")->send(new TestMail($details));

        return 'done';
        //return view("email.password2",compact('details'));
    }


}
