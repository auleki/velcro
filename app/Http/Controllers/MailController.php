<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Mail\Report;
use Mail;


class MailController extends Controller
{

     public function html_email() {
        $data = array('name'=>"EchoVC");
        Mail::send('mails', $data, function($message) {
           // $message->to('odun.agbolade@gmail.com', 'Testing')->subject
           $message->to(array("odun.agbolade@gmail.com", "projectofechocv@gmail.com"), 'Testing')->subject

              ('EchoVC reports Testing');
           $message->from('xyz@gmail.com','HR1');
        });
        echo "HTML Email Sent. Check your inbox.";
     }


     public function attachment_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel Testing Mail with Attachment');
           $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
           $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
     }


     public function email() {
       $details = [
           'title' => 'Mail from Me to U',
           'body' => 'This is for testing email using smtp'
       ];

       Mail::to('projectofechocv@gmail.com')->send(new Report($details));
       // Mail::to($myEmail)->send(new MyDemoMail($details));

       // dd("Email is Sent.");
       return view('welcome');
     }

}
