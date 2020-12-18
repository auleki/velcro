<?php
namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\Report;

class Mailer {
  public static function sendReportMail($report, $contact, $recipient)
  {
    try {
      $data['recipient_id'] = $recipient->id;
      $data['content'] = $report->message;
      $data['report_title'] = $report->report_title;
      $data['message'] = $report->message;
      // dd($data, $contact, $recipient);
      Mail::to($contact->email)->send(new Report($data));

      $recipient->status = 'delivered';
      // $recipient->delivered = true;
      $recipient->updated_at = time();
      $recipient->save();
      return;
    } catch (\Throwable $th) {
      
      $recipient->status = 'failed';
      $recipient->updated_at = time();
      $recipient->save();
      dd($th);
    }
    
  }
}

?>