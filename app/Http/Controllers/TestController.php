<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{

    public function sendMailWithPDF()
    {
        $data["email"] = "test@gmail.com";
        $data["title"] = "Welcome to MyNotePaper";
        $data["body"] = "This is the email body.";

        $pdf = PDF::loadView('mail', $data);

        Mail::send('mail', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "test.pdf");
        });

        dd('Email has been sent successfully');
    }
}
