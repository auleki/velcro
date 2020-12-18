<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Report;
Use App\SentReport;
Use App\ScheduledReport;
Use App\DraftReport;
use App\User;
use App\Contact;
use App\Recipient;
use App\ReceivedReport;
use App\ReportTextRequest;
use App\ReportMetric;
use App\ReportMetricKpi;
use App\SubmittedReport;
use App\ReportFileRequest;
use PDF;
use Carbon\Carbon;

class DownloadController extends Controller
{
    public function pdf($type)
    {
        $logo = 'data:image/' . 'png' . ';base64,' . base64_encode(file_get_contents("https://user-images.githubusercontent.com/22575481/78081212-eb249f80-73a7-11ea-9389-8c4dd3b13b02.png"));
        // dd($logo);
        $all_id = request()->query('id');
        $id_arr = explode(',', $all_id);
        // dd($all_id, $id_arr, $type);

        if($type == 'report'){
            for ($i=0; $i < count($id_arr); $i++) { 
                $id_type = explode('_', $id_arr[$i]);
                $id = $id_type[0];
                $rep_type = $id_type[1];
                // dd($rep_type, $id);
                if($rep_type == 'sent') {
                    $sent_report = SentReport::find($id);
                    // dd($sent_report);


                    $texts = ReportTextRequest::where('report_id', $sent_report->report_id)->get();
                    $metrics = ReportMetric::where('report_id', $sent_report->report_id)->get();

                    $all_metrics = [];
                    for ($i=0; $i < count($metrics); $i++) { 
                        $metric_kpis = ReportMetricKpi::where('report_metric_id', $metrics[$i]->id)->get();
                        $metric = new \stdClass;
                        $metric->data = $metrics[$i];
                        $metric->kpis = $metric_kpis;

                        array_push($all_metrics, $metric);
                    }
                        
                    $files = ReportFileRequest::where('report_id', $sent_report->report_id)->get();
                    // dd($sent_report,$texts, $all_metrics, $files);

                    // return view('reports.sent_pdf', [
                    //     'report' => $sent_report,
                    //     'texts' => $texts, 
                    //     'files' => $files,
                    //     'all_metrics' => $all_metrics,
                    //     'logo' => $logo
                    // ]);

                        set_time_limit(3600);
                    $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reports.sent_pdf', [
                        'report' => $sent_report,
                        'texts' => $texts,
                        'files' => $files,
                        'all_metrics' => $all_metrics,
                        'logo' => $logo
                    ]);
        
                    return $pdf->download('report.pdf');
                } else if($rep_type == 'received') {
                    $received_report = ReceivedReport::find($id);
                    $sent_report = SentReport::find($received_report->sent_report_id);
                    $recipient = Recipient::find($received_report->recipient_id);
                    $report = Report::find($recipient->report_id);
                    $contact = Contact::find($recipient->contact_id);

                    $report_metrics = ReportMetric::where('report_id', $sent_report->id)->get();

                    $total_metrics = [];
                    for ($i=0; $i < count($report_metrics); $i++) { 
                        $metric = $report_metrics[$i];
                        $submitted_report = SubmittedReport::where('received_report_id', $id)
                        ->where('request_type', 'metric')
                        ->where('request_id', $metric->id)
                        ->get();

                        $metrics = new \stdClass;
                        $metric_kpis = [];
                        $metrics->title = $metric->title;
                        $metrics->desc = $metric->desc;
                        $metrics->reqd = $metric->reqd;

                        for ($j=0; $j < count($submitted_report); $j++) { 
                        $kpi_obj = new \stdClass;
                        $kpi = ReportMetricKpi::find($submitted_report[$j]->kpi_id);
                        $kpi_obj->name = $kpi->name;
                        $kpi_obj->format = $kpi->format;
                        $kpi_obj->value = $submitted_report[$j]->response;

                        array_push($metric_kpis, $kpi_obj);
                        }

                        $metrics->kpis = $metric_kpis;
                        array_push($total_metrics, $metrics);
                    }

                    $report_texts = ReportTextRequest::where('report_id', $sent_report->id)->get();

                    $total_texts = [];
                    for ($k=0; $k < count($report_texts); $k++) { 
                        $text = $report_texts[$k];
                        $submitted_report = SubmittedReport::where('received_report_id', $id)
                        ->where('request_type', 'text')
                        ->where('request_id', $text->id)
                        ->first();

                        $texts = new \stdClass;
                        $texts->title = $text->title;
                        $texts->desc = $text->desc;
                        $texts->reqd = $text->reqd;
                        $texts->response = $submitted_report->response;

                        array_push($total_texts, $texts);
                    }

                    $report_files = ReportFileRequest::where('report_id', $sent_report->id)->get();

                    $total_files = [];
                    for ($k=0; $k < count($report_files); $k++) { 
                        $file = $report_files[$k];
                        $submitted_report = SubmittedReport::where('received_report_id', $id)
                        ->where('request_type', 'file')
                        ->where('request_id', $file->id)
                        ->first();

                        // dd($submitted_report, $file);
                        $files = new \stdClass;
                        $files->title = $file->title;
                        $files->desc = $file->desc;
                        $files->reqd = $file->reqd;
                        $files->response = $submitted_report->response;

                        array_push($total_files, $files);
                    }

                    $date = Carbon::parse($received_report->created_at)->diffForHumans();
                    // dd($total_texts, $total_metrics, $total_files, $contact, $date, $sent_report);

                    set_time_limit(3600);
                    $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reports.received_pdf', [
                        'metrics' => $total_metrics,
                        'texts' => $total_texts,
                        'files' => $total_files,
                        'contact' => $contact,
                        'date' => $date,
                        'sent_report' => $sent_report,
                        'logo' => $logo
                    ]);
        
                    return $pdf->download('report.pdf');
                    
                    // return view('reports.received_pdf', [
                    //     'metrics' => $total_metrics,
                    //     'texts' => $total_texts,
                    //     'files' => $total_files,
                    //     'contact' => $contact,
                    //     'date' => $date,
                    //     'sent_report' => $sent_report
                    // ]);
                }
            }
            
        }

        return back();
    }
}
