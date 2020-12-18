<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Report;
use Auth;
use App\User;
use App\Company;
use Illuminate\Support\Facades\DB;

//Sending reports (mails) to contact
use App\Mail\ReportsMail;
use Mail;
use App\Services\Report as NewReport;

class ReportsController extends Controller
{

      // ********Access control for Reports********
      public function __construct()
      {
          $this->middleware('auth');
      }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $reports = Report::all();
        $new_submissions = NewReport::newSubmissions();
      return view('reports.all', )->with('reports', $reports);
      // return view('reports.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $usersmail = User::all();

      return view('reports.new_report')->with('usersmail', $usersmail);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // To get the user id of who is sending a report
        $loguser = Auth::user();
      // dd($loguser);
      // To get the company's id of the sender
        $compa = Company::all();
        $comp = $compa[0];

        $this->validate($request, [
          'report_title' => 'required',
          'content' => 'required',
          'receiver' => 'required',
        ]);

        //Create Report
        $report = new Report;
        $report->report_title =$request->input('report_title');
        $report->receiver =$request->input('receiver');
        $report->content =$request->input('content');
        $report->btn =$request->input('status');
        $report->user_id =$loguser->id;
        $report->company_id =$comp->id;
        $report->save();

        $details = [
            'subject' => $report->receiver,
            'title' => $report->report_title,
            'body' => $report->content,
            'status' => $report->status
        ];
        // dd($details);
        if($details['status'] == 'saved'){
            return redirect('/reports/sample')->with('success', 'Report Successful Saved');
          }
          else {
              Mail::to('odun.agbolade@gmail.com')->send(new ReportsMail($details));
            return redirect('/reports/new_report1')->with('success', 'Report Successful Sent to Contacts');
          }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    $reports = Report::all();
    // dd($reports);
    // return view('reports.show')->with('reports', $reports);
    return view('reports.new_report1');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function received() {
      $receiverid = Auth::user()->email;

      $reports = Report::where('receiver', '$receiverid')->get();
      // $reports = DB::table('reports')->where('receiver', '$receiverid')->get();
      return view('reports.received')->with('reports', $reports);
    }

    public function scheduled() {
      return view('reports.scheduled');
    }

    public function sent() {
      $senderid = Auth::user()->id;

      $reports = Report::where('user_id', $senderid)->get();
      // $reports = DB::table('reports')->where('user_id', $senderid)->get();
      return view('reports.sent')->with('reports', $reports);

    }

    public function real() {
      return view('reports.reports1');
    }

    public function sample() {
      return view('reports.sample');
    }


}
