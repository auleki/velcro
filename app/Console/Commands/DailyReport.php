<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
Use App\Report;
Use App\SentReport;
Use App\ScheduledReport;
use App\Contact;
use App\Recipient;
use App\Services\Mailer;

class DailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily reports';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        date_default_timezone_set('Africa/Lagos');
        $l = date('l');
        $d = date('d');
        $m = date('m');
        $y = date('Y');
        $h = date('h');
        $i = date('i');
        $a = date('a');
        // dd($d);

        $dt = \DateTime::createFromFormat("Y-m-d", date('Y-m-d'));
        $current = $dt->getTimestamp();

        // Find all reports for current time
        $reports = ScheduledReport::where('schedule', 'recurring')
                    ->where('type', 'daily')
                    ->where('hour', ltrim($h, '0'))
                    ->where('minute', $i)
                    ->where('period', $a)
                    ->get();

        foreach($reports as $report) {
            $contact_ids = array_filter(explode('_', $report->recipients));
            // $dates = array_filter(explode('_', $report->date));
            // dd($contact_ids, $dates);
            if($report->last_send == null) {
                $report->last_send = $y.'-'.$m.'-'.$d.' '.$h.':'.$i.$a;
                $report->save();

                $sent_report = new SentReport;

                $sent_report->report_id = $report->report_id;
                $sent_report->report_title = $report->report_title;
                $sent_report->content = $report->content;
                $sent_report->message = $report->message;
                $sent_report->status = 'sent';
                $sent_report->save();

                for ($i=0; $i < count($contact_ids); $i++) { 

                    $recipient = new Recipient;

                    $recipient->contact_id = $contact_ids[$i];
                    $recipient->report_id = $sent_report->id;

                    $recipient->save();
                    
                    $contact = Contact::find($contact_ids[$i]);

                    Mailer::sendReportMail($sent_report, $contact, $recipient);
                }
            } else {
                $last_send = $report->last_send;
                $time = strtotime('+'.$report->recurring.' day', strtotime($last_send));
                
                if($time == $current) {
                    $report->last_send = $y.'-'.$m.'-'.$d.' '.$h.':'.$i.$a;
                    $report->save();

                    $sent_report = SentReport::where('report_id', $report->report_id)->first();
                    for ($i=0; $i < count($contact_ids); $i++) { 

                        $recipient = new Recipient;

                        $recipient->contact_id = $contact_ids[$i];
                        $recipient->report_id = $sent_report->id;

                        $recipient->save();
                        
                        $contact = Contact::find($contact_ids[$i]);

                        Mailer::sendReportMail($sent_report, $contact, $recipient);
                    }
                }
            }
        }

        $this->info('Daily report sent');
    }
}
