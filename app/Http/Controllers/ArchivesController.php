<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Services\Report;
use App\Report;
use Auth;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
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
class ArchivesController extends Controller
{
    public function index() {
      $user =  Auth::user();
      
      if($user->permission === 'admin')
      {
        $archives = Report::onlyTrashed()->paginate(10);
      }
      else{
        $archives = Report::where('user_id',Auth::user()->id)->onlyTrashed()->paginate(10);
      }
     
     
      if($archives->count() > 0)
      {
        return view('archives.list', compact('archives'));
      }

        return view('archives.archives');
        $folder = 'archived';

        // Get root directory contents...
        $contents = collect(Storage::cloud()->listContents('/', false));

        // Find the folder you are looking for...
        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folder)
            ->first(); // There could be duplicate directory names!

        if ( ! $dir) {
            return view('archives.archives');
        }

        // Get the files inside the folder...
        $files = collect(Storage::cloud()->listContents($dir['path'], false))
            ->where('type', '=', 'file');

            return view('archives.archivelist', compact('files'));
    }



    public function restore(Request $request)
    {

      $id =$request->ids;
      $myArray = explode(',', $id[0]);
      $ids = $myArray;

       

        $archives = Report::onlyTrashed()->whereIn('id',$ids)->get();

        if (!is_null($archives) && $archives->count() > 0) {

            foreach ($archives as $archive) {
              // $archive->restore();
              if($archive->report_type == 'sent') {
                $sent_report = SentReport::withTrashed()->where('report_id', $archive->id)->first();
                $sent_report->restore();
                $archive->restore();
          }
          else if($archive->report_type == 'received') {
            $received_report = ReceivedReport::withTrashed()->where('report_id', $archive->id)->first();
            $received_report->restore();
            $archive->restore();
          }
          else if($archive->report_type == 'draft') {
            $draft_report = DraftReport::withTrashed()->where('report_id', $archive->id)->first();
            $draft_report->restore();
            $archive->restore();
          }
          else if($archive->report_type == 'scheduled') {
            $scheduled_report = ScheduledReport::withTrashed()->where('report_id', $archive->id)->first();
            $scheduled_report->restore();
            $archive->restore();
          }
              
            }

            
        }
        return back()->with('success','Archive have been successfully deleted.');
    }


    public function delete(Request $request)
    {

      $id =$request->ids;
      $myArray = explode(',', $id[0]);
      $ids = $myArray;

       

        $archives = Report::onlyTrashed()->whereIn('id',$ids)->get();

        if (!is_null($archives) && $archives->count() > 0) {

            foreach ($archives as $archive) {
              if($archive->report_type == 'sent') {
                    $sent_report = SentReport::withTrashed()->where('report_id', $archive->id)->first();
                    $sent_report->forceDelete();
                    $archive->forceDelete();
              }
              else if($archive->report_type == 'received') {
                $received_report = ReceivedReport::withTrashed()->where('report_id', $archive->id)->first();
                $received_report->forceDelete();
                $archive->forceDelete();
              }
              else if($archive->report_type == 'draft') {
                $draft_report = DraftReport::withTrashed()->where('report_id', $archive->id)->first();
                $draft_report->forceDelete();
                $archive->forceDelete();
              }
              else if($archive->report_type == 'scheduled') {
                $scheduled_report = ScheduledReport::withTrashed()->where('report_id', $archive->id)->first();
                $scheduled_report->forceDelete();
                $archive->forceDelete();
              }
            }
            
        }
        return back()->with('success','Archive have been successfully deleted.');
    }


    public function cloudUpload($type) {
      // $getToastOptions = config('lara-izitoast');
      // dd($getToastOptions);
      $logo = 'data:image/' . 'png' . ';base64,' . base64_encode(file_get_contents("https://user-images.githubusercontent.com/22575481/78081212-eb249f80-73a7-11ea-9389-8c4dd3b13b02.png"));
        
      $all_id = request()->query('id');
      $id_arr = explode(',', $all_id);

      try {
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

                set_time_limit(3600);
                $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
                $pdf->loadView('reports.sent_pdf', [
                    'report' => $sent_report,
                    'texts' => $texts,
                    'files' => $files,
                    'all_metrics' => $all_metrics,
                    'logo' => $logo
                ]);
                $content = $pdf->output();
                // $name = str_random(32);
                $name = $sent_report->report_title . date('d-m-y');
                file_put_contents('storage/archived/'.$name.'.pdf', $content);
                Storage::disk('google')->put('1sYCyyyOx3WZxYK06duB3PlrrvsQIuTUa/'.$name.'pdf', file_get_contents('storage/archived/'.$name.'.pdf'));
                // dd(TRUE);
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
                
                $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
                $pdf->loadView('reports.sent_pdf', [
                    'metrics' => $total_metrics,
                    'texts' => $total_texts,
                    'files' => $total_files,
                    'contact' => $contact,
                    'date' => $date,
                    'sent_report' => $sent_report,
                    'logo' => $logo
                ]);
                $content = $pdf->output();
                // $name = str_random(32);
                $name = $sent_report->report_title . date('d-m-y');
                file_put_contents('storage/archived/'.$name.'.pdf', $content);
                Storage::disk('google')->put('1sYCyyyOx3WZxYK06duB3PlrrvsQIuTUa/'.$name.'pdf', file_get_contents('storage/archived/'.$name.'.pdf'));
            }
          }    
        }
      } catch (\Throwable $th) {
        //   dd($th);
        notify()->error("An error occured. Please try again","","topRight");
        return back();
      }

      notify()->success("Your upload was successful","","topRight");
      return back();

    }

    public function archiveReport($type) {
      $all_id = request()->query('id');
      $id_arr = explode(',', $all_id);

      try {
        if($type == 'report'){
          // dd($id_arr);

          for ($i=0; $i < count($id_arr); $i++) { 
            $id_type = explode('_', $id_arr[$i]);
            $id = $id_type[0];
            $rep_type = $id_type[1];

            if($rep_type == 'sent') {
              $sent_report = SentReport::find($id);
              $report = Report::find($sent_report->report_id);

              $sent_report->delete();
              $report->delete();
            } else if($rep_type == 'received') {
              $received_report = ReceivedReport::find($id);
              $report = Report::find($received_report->report_id);

              $received_report->delete();
              $report->delete();
            } else if($rep_type == 'scheduled') {
              $scheduled_report = ScheduledReport::find($id);
              $report = Report::find($scheduled_report->report_id);

              $scheduled_report->delete();
              $report->delete();
            } else if($rep_type == 'draft') {
              $draft_report = DraftReport::find($id);
              $report = Report::find($draft_report->report_id);

              $draft_report->delete();
              $report->delete();
            }
          }
        }
      } catch (\Throwable $th) {
        notify()->error("An error occured. Please try again","","topRight");
        return back();
      }

      notify()->success("Your request was successful","","topRight");
      return back();
    }
}



    