<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
// Use App\Compose;
use App\Report;
use App\SentReport;
use App\ScheduledReport;
use App\DraftReport;
use App\User;
use App\Contact;
use App\Recipient;
use App\ReceivedReport;
use App\ReportTextRequest;
use App\ReportMetric;
use App\ReportMetricKpi;
use App\SubmittedReport;
use App\ReportFileRequest;
use App\Services\FileUpload;
use App\Services\Mailer;
use App\Services\Report as NewReport;
use Auth;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Tool;
use App\CompanyReport;

//Sending reports (mails) to contact
use App\Mail\ReportsMail;
use Mail;

class ComposeMailController extends Controller
{

  // ********Access control for Reports********
  public function __construct()
  {
    // $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $all_reports = Report::orderBy('id', 'desc')->get();

    $received_reports = ReceivedReport::where('status', 'new')
      ->where('user_id', auth()->user()->id)
      ->get();

    if (count($received_reports) > 0) {
      foreach ($received_reports as $received_report) {
        $received_report->status = 'viewed';

        $received_report->save();
      }
    }

    $active = "all";

    $reports = [];
    for ($i = 0; $i < count($all_reports); $i++) {
      $report = $all_reports[$i];
      $rep_obj = new \stdClass;

      if ($report->report_type == 'sent') {
        // dd($report->sent_report);
        $sent_report = SentReport::where('report_id', $report->id)->first();
        if ($sent_report) {
          $recipients = Recipient::where('report_id', $sent_report->id)
            ->get();
          $contacts = 'To:';
          // dd($recipients);
          $prev_email = '';
          $prev_company = '';
          // dd($recipients);
          for ($j = 0; $j < count($recipients); $j++) {
            if ($recipients[$j]->contact()->first() && $recipients[$j]->contact()->first()->company()->first()) {
              $comp_name = $recipients[$j]->contact()->first()->company()->first()->c_name;
              $contact_email = $recipients[$j]->contact()->first()->email;
              if ($prev_company != $comp_name && $prev_email != $contact_email) {
                $contacts .= $contact_email . ' for ' . $comp_name . ';';
              }

              $prev_company = $comp_name;
              $prev_email == $contact_email;
            }
          }
          $rep_obj->recipient = $contacts;

          $rep_obj->report_title = $sent_report->report_title;
          $rep_obj->message = $sent_report->message;
          $rep_obj->id = $sent_report->id;
          $rep_obj->type = 'sent';
          $rep_obj->time = Carbon::parse($sent_report->created_at)->diffForHumans(); //count(Recipient::where('report_id', $report->id)->get()) . ' receipients';

          $new_report = ReceivedReport::where('sent_report_id', $sent_report->id)
            ->where('status', 'viewed')->first();

          if ($new_report) {
            $rep_obj->new_report = TRUE;
          } else {
            $rep_obj->new_report = FALSE;
          }

          array_push($reports, $rep_obj);
        }
      } elseif ($report->report_type == 'draft') {
        $draft_report = DraftReport::where('report_id', $report->id)->first();

        if ($draft_report) {
          $rep_obj->report_title = $draft_report->report_title;
          $rep_obj->recipient = '';
          $rep_obj->message = $draft_report->message;
          $rep_obj->id = $draft_report->id;
          $rep_obj->type = 'draft';
          $rep_obj->time = Carbon::parse($draft_report->created_at)->diffForHumans();
          $rep_obj->new_report = FALSE;

          array_push($reports, $rep_obj);
        }
      } elseif ($report->report_type == 'scheduled') {
        $scheduled_report = ScheduledReport::where('report_id', $report->id)->first();

        if ($scheduled_report) {
          $rep_obj->report_title = $scheduled_report->report_title;
          $rep_obj->recipient = '';
          $rep_obj->message = $scheduled_report->message;
          $rep_obj->id = $scheduled_report->id;
          $rep_obj->type = 'scheduled';
          $rep_obj->time = Carbon::parse($scheduled_report->created_at)->diffForHumans();
          $rep_obj->new_report = FALSE;

          array_push($reports, $rep_obj);
        }
      } elseif ($report->report_type == 'received') {
        $received_report = ReceivedReport::where('report_id', $report->id)->first();

        if ($received_report) {
          $rep_obj->report_title = $received_report->report_title;
          $receipient = Recipient::find($received_report->recipient_id);
          $contact = Contact::find($receipient->contact_id);
          $from = '';
          if ($contact->company()->first()) {
            $from = ' from ' . $contact->company()->first()->c_name;
          };
          $rep_obj->recipient = $contact->fname . $from;
          $rep_obj->message = $received_report->message;
          $rep_obj->id = $received_report->id;
          $rep_obj->type = 'received';
          $rep_obj->time = Carbon::parse($received_report->created_at)->diffForHumans();
          $rep_obj->new_report = FALSE;

          array_push($reports, $rep_obj);
        }
      }
    }

    // foreach($all_reports as $report) {
    //   // dd($report);
    //   $report->delete();
    // }

    // dd($reports);
    if (count($reports) <= 0) {
      return view('reports.report');
    }
    return view('reports.all')->with(compact('reports', 'active'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $contacts = Contact::where('user_id', auth()->user()->id)->get();

    return view('reports.new_report', compact('contacts'));
  }

  public function draftReport(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'body_content' => 'required'
    ]);

    // dd($request);

    if ($validator->fails()) {
      $errors = $validator->errors();
      // dd($errors->first('title'));
      return redirect('reports/create')
        ->withErrors($errors)
        ->withInput();
    }
    // dd($request);

    $report = new Report;

    $report->report_type = 'draft';
    $report->company_id = auth()->user()->id;
    $report->user_id = auth()->user()->id;

    $report->save();

    $draft_report = new DraftReport;

    $draft_report->report_id = $report->id;
    $draft_report->report_title = $request->title;
    $draft_report->content = $request->body_content;
    $draft_report->message = $request->message;
    $draft_report->status = 'draft';
    $draft_report->save();

    $this->save($request, $report);

    return redirect()->action('ComposeMailController@index');
  }

  public function sendReport(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'body_content' => 'required'
    ]);

    // dd($request);

    if ($validator->fails()) {
      $errors = $validator->errors();
      // dd($errors->first('title'));
      return redirect('reports/create')
        ->withErrors($errors)
        ->withInput();
    }
    // dd($request);

    $report = new Report;
    $report->report_type = 'sent';
    $report->company_id = auth()->user()->id;
    $report->user_id = auth()->user()->id;

    $report->save();

    $sent_report = new SentReport;

    $sent_report->report_id = $report->id;
    $sent_report->report_title = $request->title;
    $sent_report->content = $request->body_content;
    $sent_report->message = $request->message;
    $sent_report->status = 'sent';
    $sent_report->save();

    $this->save($request, $report);

    return redirect('/report/add-emails/' . $sent_report->id);
  }

  public function scheduleReport(Request $request)
  {
    // dd($request);
    if (!$request->contacts) {
      notify()->error("Kindly select at least one contact", "", "topRight");
      return back();
    }

    try {
      $report = new Report;

      $report->report_type = 'scheduled';
      $report->company_id = auth()->user()->id;
      $report->user_id = auth()->user()->id;

      $report->save();

      $scheduled_report = new ScheduledReport;

      $scheduled_report->report_id = $report->id;
      $scheduled_report->report_title = $request->title;
      $scheduled_report->content = $request->body_content;
      $scheduled_report->message = $request->message;
      $scheduled_report->schedule = $request->schedule_type;
      $scheduled_report->status = 'running';
      $scheduled_report->type = $request->schedule_type == 'recurring' ? $request->period : '';
      $scheduled_report->hour = $request->hour;
      $scheduled_report->minute = $request->minute;
      $scheduled_report->date = $request->schedule_date;
      $scheduled_report->period = $request->am_pm;
      $scheduled_report->selected_day = $request->selected_day;
      $scheduled_report->recurring = $request->recurring;
      $recipients = '';
      foreach ($request->contacts as $contact) {
        $recipients .= $contact . '_';
      }
      $scheduled_report->recipients = $recipients;

      $scheduled_report->save();

      $this->save($request, $report);
    } catch (\Throwable $th) {
      // dd();
      //throw $th;
      notify()->error($th->errorInfo[2], "", "topRight");
      return back();
    }
    return redirect('/scheduled_report');
  }

  public function save($request, $report)
  {
    $total_text_requests = $request->total_texts;
    $total_metric_requests = $request->total_metrics;
    $total_file_requests = $request->total_files;

    for ($i = 0; $i < $total_text_requests; $i++) {
      $report_text_request = new ReportTextRequest;
      $title = 'text_title_' . $i;
      $desc = 'text_desc_' . $i;
      $reqd = 'text_req_' . $i;
      $report_text_request->title = $request->$title;
      $report_text_request->desc = $request->$desc;
      $report_text_request->reqd = $request->$reqd;
      $report_text_request->report_id = $report->id;

      $report_text_request->save();
    }

    for ($i = 0; $i < $total_file_requests; $i++) {
      $report_file = new ReportFileRequest;
      $title = 'file_title_' . $i;
      $desc = 'file_desc_' . $i;
      $reqd = 'file_req_' . $i;
      $report_file->title = $request->$title;
      $report_file->desc = $request->$desc;
      $report_file->reqd = $request->$reqd;
      $report_file->report_id = $report->id;

      $report_file->save();
    }

    for ($i = 0; $i < $total_metric_requests; $i++) {
      $report_metric = new ReportMetric;
      $title = 'metric_title_' . $i;
      $desc = 'metric_desc_' . $i;
      $reqd = 'metric_req_' . $i;
      $report_metric->title = $request->$title;
      $report_metric->desc = $request->$desc;
      $report_metric->reqd = $request->$reqd;
      $report_metric->report_id = $report->id;

      $report_metric->save();

      $metric_kpi = 'metric_' . $i;
      $total_kpis = $request->$metric_kpi;

      for ($k = 0; $k < $total_kpis; $k++) {
        $kpi = new ReportMetricKpi;

        $name = 'kpi_name_' . $i . '_' . $k;
        $format = 'kpi_format_' . $i . '_' . $k;
        $kpi->name = $request->$name;
        $kpi->format = $request->$format;
        $kpi->report_metric_id = $report_metric->id;

        $kpi->save();
      }
    }

    return;
  }

  public function selectReceivers(Request $request, $id)
  {
    // $find_report = Report::find($id);
    // dd($id, $request->type);
    $contacts = Contact::all();
    if ($request->query('type') == 'draft') {
      $draft_report = DraftReport::find($id);

      $rept = new Report;
      $rept->user_id = auth()->user()->id;
      $rept->status = 'sent';
      $rept->report_type = 'sent';
      $rept->company_id = auth()->user()->id;
      $rept->save();

      $report = new SentReport;
      $report->report_id = $rept->id;
      $report->report_title = $draft_report->report_title;
      $report->content = $draft_report->content;
      $report->message = $draft_report->message;
      $report->status = 'sent';
      $report->save();

      $texts = ReportTextRequest::where('report_id', $draft_report->report_id)->get();
      $metrics = ReportMetric::where('report_id', $draft_report->report_id)->get();

      $all_metrics = [];
      for ($i = 0; $i < count($metrics); $i++) {
        $metric_kpis = ReportMetricKpi::where('report_metric_id', $metrics[$i]->id)->get();
        $metric = new \stdClass;
        $metric->data = $metrics[$i];
        $metric->kpis = $metric_kpis;

        array_push($all_metrics, $metric);
      }

      $files = ReportFileRequest::where('report_id', $draft_report->report_id)->get();
      return view('reports.sample', compact('report', 'contacts', 'texts', 'files', 'all_metrics'));
      // $draft_report->delete();
    } else {
      $report = SentReport::find($id);

      $texts = ReportTextRequest::where('report_id', $report->report_id)->get();
      $metrics = ReportMetric::where('report_id', $report->report_id)->get();

      $all_metrics = [];
      for ($i = 0; $i < count($metrics); $i++) {
        $metric_kpis = ReportMetricKpi::where('report_metric_id', $metrics[$i]->id)->get();
        $metric = new \stdClass;
        $metric->data = $metrics[$i];
        $metric->kpis = $metric_kpis;

        array_push($all_metrics, $metric);
      }

      $files = ReportFileRequest::where('report_id', $report->report_id)->get();
      return view('reports.sample', compact('report', 'contacts', 'texts', 'files', 'all_metrics'));
    }
    // dd($report);
    // if($report) {
    //   $contacts = Contact::all();
    //   $texts = ReportTextRequest::where('report_id', $report->report_id)->get();
    //   $metrics = ReportMetric::where('report_id', $report->report_id)->get();

    //   $all_metrics = [];
    //   for ($i=0; $i < count($metrics); $i++) {
    //     $metric_kpis = ReportMetricKpi::where('report_metric_id', $metrics[$i]->id)->get();
    //     $metric = new \stdClass;
    //     $metric->data = $metrics[$i];
    //     $metric->kpis = $metric_kpis;

    //     array_push($all_metrics, $metric);
    //   }

    //   $files = ReportFileRequest::where('report_id', $report->report_id)->get();
    //   // dd($report);
    //   // if($request->query('type') == 'draft') {
    //   //   return view('reports.draft_report', compact('report', 'contacts', 'texts', 'files', 'all_metrics'));
    //   // }
    //   return view('reports.sample', compact('report', 'contacts', 'texts', 'files', 'all_metrics'));
    // }

    return back()->with('error', 'Report does not exist');
  }

  public function send(Request $request, $id)
  {
    // dd($request, $id);
    $report = SentReport::find($id);

    // $report->save();
    // dd($report);
    if ($request->query('save')) return redirect('/reports');

    // dd(env('MAIL_PASSWORD'));
    for ($i = 0; $i < count($request->contacts); $i++) {
      $contact_id = $request->contacts[$i];

      $recipient = new Recipient;

      $recipient->contact_id = $contact_id;
      $recipient->report_id = $report->id;

      $recipient->save();

      $contact = Contact::find($contact_id);

      $company_report = new CompanyReport;
      $company_report->company_id = $contact->company;
      $company_report->report_id = $report->report_id;
      $company_report->save();

      Mailer::sendReportMail($report, $contact, $recipient);
    }

    $rep = Report::find($report->report_id);

    if ($rep->report_type == 'draft') {
      $rep->report_type = 'sent';

      $rep->save();
    }

    return redirect('/sent_report');
  }

  public function resendReport($id)
  {
    // return [ request()->query('contact'),request()->query('report'), $id];
    $report = SentReport::find(request()->query('report'));

    $recipient = Recipient::find($id);

    $recipient->updated_at = date('Y-m-d H:i:s');
    $recipient->save();

    $contact = Contact::find(request()->query('contact'));

    $company_report = CompanyReport::where('company_id', $contact->company)->where('report_id', $report->id)->first();

    if ($company_report) {
      $company_report->updated_at = date('d-m-Y H:m:i');
      $company_report->save();
    }

    Mailer::sendReportMail($report, $contact, $recipient);

    return;
  }

  public function viewReport($id)
  {
    // dd($id);
    $recipient = Recipient::find($id);
    // dd(Carbon::now()->toDateTimeString());
    $recipient->opened = true;
    if ($recipient->number_of_times_opened < 1) {
      $recipient->time_viewed = Carbon::now()->toDateTimeString();
    }
    $recipient->number_of_times_opened = (int) $recipient->number_of_times_opened + 1;
    // dd($recipient);
    $recipient->save();
    // dd($recipient);

    $report = SentReport::find($recipient->report_id);

    $result = $this->sentReport($report);

    return view('reports.investor_report', [
      'report' => $report,
      'recipient' => $recipient,
      'texts' => $result[0],
      'files' => $result[2],
      'all_metrics' => $result[1]
    ]);
  }

  public function sentReport($report)
  {
    $texts = ReportTextRequest::where('report_id', $report->report_id)->get();
    $metrics = ReportMetric::where('report_id', $report->report_id)->get();

    $all_metrics = [];
    for ($i = 0; $i < count($metrics); $i++) {
      $metric_kpis = ReportMetricKpi::where('report_metric_id', $metrics[$i]->id)->get();
      $metric = new \stdClass;
      $metric->data = $metrics[$i];
      $metric->kpis = $metric_kpis;

      array_push($all_metrics, $metric);
    }

    $files = ReportFileRequest::where('report_id', $report->report_id)->get();

    return [$texts, $all_metrics, $files];
  }

  public function fillReport(Request $request, $id)
  {
    $recipient = Recipient::find($id);
    // dd($recipient);
    $sent_report = SentReport::find($recipient->report_id);
    $report = Report::find($sent_report->report_id);
    // $user = User::find($report->user_id);
    // dd($sent_report, $report);
    $new_report = new Report;

    $new_report->user_id = $report->user_id;
    $new_report->company_id = $recipient->contact_id;
    $new_report->report_type = 'received';
    $new_report->save();

    $company_report = new CompanyReport;
    $company_report->company_id = $recipient->contact()->first()->company;
    $company_report->report_id = $new_report->id;
    $company_report->save();

    $received_report = new ReceivedReport;
    $received_report->recipient_id = $id;
    $received_report->user_id = $report->user_id;
    $received_report->message = $request->message;
    $received_report->report_id = $new_report->id;
    $received_report->report_title = $request->report_title;
    $received_report->sent_report_id = $sent_report->id;

    $received_report->save();

    $metrics = ReportMetric::where('report_id', $sent_report->report_id)->get();

    for ($i = 0; $i < count($metrics); $i++) {
      $metric_kpis = ReportMetricKpi::where('report_metric_id', $metrics[$i]->id)->get();

      // dd($metric_kpis);
      for ($j = 0; $j < count($metric_kpis); $j++) {
        $submitted = new SubmittedReport;
        $submitted->received_report_id = $received_report->id;
        $submitted->request_type = 'metric';
        $submitted->request_id = $metrics[$i]->id;
        $submitted->kpi_id = $metric_kpis[$j]->id;
        $res = 'kpi_value_' . $i . '_' . $j;
        $submitted->response = $request->$res;
        // dd($submitted, $request, $request->$res);

        $submitted->save();
      }
    }

    $texts = ReportTextRequest::where('report_id', $sent_report->report_id)->get();

    for ($k = 0; $k < count($texts); $k++) {
      $submitted = new SubmittedReport;
      $submitted->received_report_id = $received_report->id;
      $submitted->request_type = 'text';
      $submitted->request_id = $texts[$k]->id;
      $res = 'text_' . $k;
      $submitted->response = $request->$res;

      $submitted->save();
    }

    $files = ReportFileRequest::where('report_id', $sent_report->report_id)->get();

    for ($m = 0; $m < count($files); $m++) {
      $submitted = new SubmittedReport;
      $submitted->received_report_id = $received_report->id;
      $submitted->request_type = 'file';
      $submitted->request_id = $files[$m]->id;
      $res = 'file_' . $m;
      $submitted->response = $request->hasFile($res) ? FileUpload::uploadImage($request->$res, 'reports') : null;

      $submitted->save();
    }
    return redirect('/login');
  }

  /**
   * Received report
   */
  public function received()
  {
    $reports = DB::table('reports')
      ->where('user_id', auth()->user()->id)
      ->where('report_type', 'received')
      ->orderBy('id', 'desc')
      ->get();

    // dd($reports);
    $real_reports = [];

    for ($i = 0; $i < count($reports); $i++) {
      $report = $reports[$i];
      $received_report = ReceivedReport::where('report_id', $report->id)->first();

      if ($received_report) {
        $receipient = Recipient::find($received_report->recipient_id);
        $contact = Contact::find($receipient->contact_id);

        $filter_report = new \stdClass;
        $date = date('d-M-Y', strtotime($received_report->updated_at));
        $filter_report->date = $date;

        $recipient = Recipient::find($received_report->recipient_id);

        $filter_report->title = $received_report->report_title;
        $filter_report->id = $received_report->id;
        $filter_report->from = $contact->fname . ' from ' . $contact->company;
        $filter_report->message = $received_report->message;
        $filter_report->status = $received_report->status;
        $filter_report->type = 'received';

        array_push($real_reports, $filter_report);
      }
    }

    $active = "received";

    return view('reports.received', [
      'reports' => $real_reports,
      'active' => $active
    ]);
  }

  public function viewReceivedReport($id)
  {
    // dd(url()->previous());
    $received_report = ReceivedReport::find($id);
    $sent_report = SentReport::find($received_report->sent_report_id);
    $recipient = Recipient::find($received_report->recipient_id);
    $report = Report::find($sent_report->report_id);
    $contact = Contact::find($recipient->contact_id);
    if ($received_report->status != 'opened') {
      $received_report->status = 'opened';
      $received_report->save();
    }
    // dd($received_report,$sent_report,$recipient,$report);
    $report_metrics = ReportMetric::where('report_id', $report->id)->get();
    // dd($report_metrics);
    $total_metrics = [];
    for ($i = 0; $i < count($report_metrics); $i++) {
      $metric = $report_metrics[$i];
      $submitted_report = SubmittedReport::where('received_report_id', $id)
        ->where('request_type', 'metric')
        ->where('request_id', $metric->id)
        ->get();
      // dd($submitted_report);

      $metrics = new \stdClass;
      $metric_kpis = [];
      $metrics->title = $metric->title;
      $metrics->desc = $metric->desc;
      $metrics->reqd = $metric->reqd;

      for ($j = 0; $j < count($submitted_report); $j++) {
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
    // dd($total_metrics);
    // dd($submitted_report, $report_metrics);
    $report_texts = ReportTextRequest::where('report_id', $report->id)->get();

    $total_texts = [];
    for ($k = 0; $k < count($report_texts); $k++) {
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

    $report_files = ReportFileRequest::where('report_id', $report->id)->get();

    $total_files = [];
    for ($k = 0; $k < count($report_files); $k++) {
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
    // dd($total_texts);
    $path = request()->query('from_name');
    // $path[1] = url()->previous();
    // dd($total_metrics);
    return view('reports.received_report', [
      'metrics' => $total_metrics,
      'texts' => $total_texts,
      'files' => $total_files,
      'report' => $report,
      'contact' => $contact,
      'date' => $date,
      'sent_report' => $sent_report,
      'from' => $path
    ]);
  }

  /**
   * Scheduled report
   */
  public function scheduled()
  {
    $reports = DB::table('reports')
      ->where('user_id', auth()->user()->id)
      ->where('report_type', 'scheduled')
      ->orderBy('id', 'desc')
      ->get();

    $real_reports = [];
    // dd($reports);
    for ($i = 0; $i < count($reports); $i++) {
      $report = $reports[$i];
      // dd($report);
      $scheduled_report = ScheduledReport::where('report_id', $report->id)->first();
      // dd($scheduled_report);
      if ($scheduled_report) {
        $filter_report = new \stdClass;
        $schedule_time = $scheduled_report->hour . ':' . $scheduled_report->minute . $scheduled_report->period;
        $date = $scheduled_report->date;
        $filter_report->schedule = $scheduled_report->type ? ucfirst($scheduled_report->type) : 'One time';

        if ($scheduled_report->schedule == 'one-time') {
          $time = strtotime($scheduled_report->created_at);
          $month = date("M", $time);
          $year = date("Y", $time);
          $filter_report->date = $date . ' ' . $month . ' ' . $year . ' ' . $schedule_time;
          // dd($month, $year);
        } else {
          date_default_timezone_set('Africa/Lagos');
          $y = date('Y');
          $m = date('m');
          $d = date('d');
          $current = date('Y-m-d H:i:s');
          $time2 = strtotime($current);
          $dates = explode('_', $scheduled_report->date);
          // dd($y, $m);
          // dd($d);
          $real_date = null;
          if ($scheduled_report->type == 'monthly') {
            for ($j = 0; $j < count($dates); $j++) {
              $time = strtotime($y . '-' . $m . '-' . $dates[$j] . ' ' . $schedule_time);
              if ($time > $time2) {
                $real_date = $dates[$j] . ' ' . date("M", $time) . ' ' . date('Y', $time) . ' ' . $schedule_time;
                break;
              }
            }

            if (!$real_date) {
              $time = strtotime('+' . $scheduled_report->recurring . ' month', strtotime($y . '-' . $m . '-' . $dates[0]));

              $real_date = date('d', $time) . ' ' . date("M", $time) . ' ' . date('Y', $time) . ' ' . $schedule_time;
            }
          } else if ($scheduled_report->type == 'weekly') {
            $date = $dates[0];

            $time = strtotime($y . '-' . $m . '-' . $date . ' ' . $schedule_time);

            if ($time > $time2) {
              $real_date = $date . ' ' . date("M", $time) . ' ' . date('Y', $time) . ' ' . $schedule_time;
            } else {
              $time = strtotime('+' . $scheduled_report->recurring . ' week', strtotime($y . '-' . $m . '-' . $date));

              $real_date = date('d', $time) . ' ' . date("M", $time) . ' ' . date('Y', $time) . ' ' . $schedule_time;
            }
          } else if ($scheduled_report->type == 'daily') {
            $date = $dates[0];

            $time = strtotime($y . '-' . $m . '-' . $date . ' ' . $schedule_time);

            if ($time > $time2) {
              $real_date = $date . ' ' . date("M", $time) . ' ' . date('Y', $time) . ' ' . $schedule_time;
              // dd($real_date, 1);
            } else {
              $time = strtotime('+' . $scheduled_report->recurring . ' day', strtotime($y . '-' . $m . '-' . $date));

              $real_date = date('d', $time) . ' ' . date("M", $time) . ' ' . date('Y', $time) . ' ' . $schedule_time;
              // dd($real_date, 2);
            }
          }

          $filter_report->date = $real_date;
        }


        // $filter_report->title = $scheduled_report->report_title;
        $filter_report->id = $scheduled_report->id;
        // $recipients = rtrim($scheduled_report->recipients, '_');
        // dd($recipients);
        $contacts = explode('_', rtrim($scheduled_report->recipients, '_'));
        $filter_report->type = $scheduled_report->schedule;
        // dd($contacts);
        // $prev_email = '';
        // $prev_company = '';
        // for ($j=0; $j < count($recipients); $j++) {
        //   if ($prev_company != $recipients[$j]->company && $prev_email != $recipients[$j]->email) {
        //     $contacts .= $recipients[$j]->email . ' for ' . $recipients[$j]->company . ';';
        //   }

        //   $prev_company = $recipients[$j]->company;
        //   $prev_email == $recipients[$j]->email;
        // }
        $filter_report->recipients = count($contacts);
        $filter_report->message = $scheduled_report->message;
        $filter_report->type = 'scheduled';

        array_push($real_reports, $filter_report);
      }
    }
    // dd($real_reports);
    $active = "scheduled";
    return view('reports.scheduled', [
      'reports' => $real_reports,
      'active' => $active
    ]);
  }

  /**
   * Sent report
   */
  public function sent()
  {
    $reports = Report::where('user_id', auth()->user()->id)
      ->where('report_type', 'sent')
      ->orderBy('id', 'desc')
      ->get();

    // dd($reports);


    $real_reports = [];
    // dd($reports);
    for ($i = 0; $i < count($reports); $i++) {
      $report = $reports[$i];
      $sent_report = SentReport::where('report_id', $report->id)->first();
      // dd($reports, $sent_report);
      if ($sent_report) {
        $new_report = ReceivedReport::where('sent_report_id', $sent_report->id)
          ->where('status', 'viewed')->first();
        $filter_report = new \stdClass;
        $date = date('d-M-Y', strtotime($sent_report->updated_at));
        $filter_report->date = $date;

        $recipients = $sent_report->recipient()->get();
        // dd($recipients);
        $contact_email = '';
        $total_recipients = 0;
        if (count($recipients) > 0) {
          $contact_email = $recipients[0]->contact()->first()->email;
          if($recipients[0]->contact()->first()->company()->first()) {
            $c_name = $recipients[0]->contact()->first()->company()->first()->c_name;
            $filter_report->recipients = $contact_email . ' for ' . $c_name;
          } else
            $filter_report->recipients = $contact_email;
          $total_recipients = count($recipients) - 1;
          if ($total_recipients > 0) {
            $filter_report->recipients .=  ' +' . $total_recipients;
          }
        } else {
          $filter_report->recipients = '';
        }

        $filter_report->title = $sent_report->report_title;
        $filter_report->id = $sent_report->id;

        $filter_report->message = $sent_report->message;
        if ($new_report) {
          $filter_report->new_report = TRUE;
        } else {
          $filter_report->new_report = FALSE;
        }

        $filter_report->type = 'sent';

        array_push($real_reports, $filter_report);
      }
    }
    // dd($real_reports);
    $active = "sent";
    // dd($real_reports);
    return view('reports.sent', [
      'reports' => $real_reports,
      'active' => $active
    ]);
  }

  /**
   * Saved/Draft report
   */
  public function draft()
  {
    $reports = DB::table('reports')
      ->where('user_id', auth()->user()->id)
      ->where('report_type', 'draft')
      ->orderBy('id', 'desc')
      ->get();

    $real_reports = [];

    for ($i = 0; $i < count($reports); $i++) {
      $report = $reports[$i];
      $draft_report = DraftReport::where('report_id', $report->id)->first();
      // dd($draft_report);
      if ($draft_report) {
        $filter_report = new \stdClass;
        $date = date('d-M-Y', strtotime($draft_report->updated_at));
        $filter_report->date = $date;

        $filter_report->title = $draft_report->report_title;
        $filter_report->id = $draft_report->id;
        $filter_report->message = $draft_report->message;
        $filter_report->type = 'draft';

        array_push($real_reports, $filter_report);
      }
    }

    $active = "draft";
    return view('reports.draft', [
      'reports' => $real_reports,
      'active' => $active
    ]);
  }

  public function report(Request $request, $type)
  {
    // dd($type, $request->query('q'));
    $q = $request->query('q');

    if ($type == 'sent') {
      $report = SentReport::find($q);
      $result = $this->sentReport($report);
    } elseif ($type == 'received') {
      $report = ReceivedReport::find($q);
      $result = $this->sentReport($report);
    } elseif ($type == 'draft') {
      $report = DraftReport::find($q);
      $result = $this->sentReport($report);
    } else {
      $report = ScheduledReport::find($q);
      $result = $this->sentReport($report);
    }

    // dd($report);
    return view('reports.view_report', [
      'report' => $report,
      'texts' => $result[0],
      'files' => $result[2],
      'all_metrics' => $result[1]
    ]);
  }

  public function reportRecipients($id)
  {
    $report = SentReport::find($id);
    $recipients = Recipient::where('report_id', $id)->get();
    // dd($recipients[0]->received_report()->first());

    return view('reports.report_recipient', compact('report', 'recipients'));
    // dd($recipients[0]->contact()->first());
  }

  public function viewDraft($id)
  {
    $draft = DraftReport::find($id);
    dd($draft);
  }

  public function tracker($id)
  {
    header("Content-Type: image/jpeg"); // it will return image
    readfile("dot.jpg");
    $recipient = Recipient::find($id);

    $recipient->status = 'read';
    $recipient->delivered = true;

    $recipient->save();
    return;
  }
}
