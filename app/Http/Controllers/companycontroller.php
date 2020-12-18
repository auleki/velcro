<?php

namespace App\Http\Controllers;

use Session;
use Storage;
use Redirect;
use App\Cfile;
use App\Efile;
use Countries;
use App\Company;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
// use App\Services\Report;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Filesystem;
use App\Services\FileSize;
use App\Services\FileUpload;
use App\CompareCompany;
use App\CompareCompanyData;
use App\Tool;
use App\SpreadSheet;
use App\SheetColumnRow;
use App\Sheet;
use App\Services\Client;
use App\Services\Color;
use App\Http\Controllers\MetricsController as Metrics;
use App\CompanyPerformance;
use App\CompanyPerformanceChart;
use App\Recipient;
use App\SentReport;
use App\Report;
use App\ReportMetric;
use App\ReportMetricKpi;
use App\SubmittedReport;
use App\CompanyNote;
use App\CompanyReport;
use App\CompanyHistory;
use Carbon\Carbon;
use App\Fund;
use App\CompanyFund;
use App\CompanyFundTranche;
use App\FundActivity;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = company::all();
        // $companyData = Company::getAllCompanydata();
        // dd($companies);

        if(count($companies) > 0) {
            return view('portfolio_company.company_list', compact('companies'));
        }

        //return view('add_company.index');
        return view('portfolio_company.new_company');
        //
    }

    /**
     * Show the form to create the company resource
     * 
     * @return \just the blade view
     * */

    public function create()
    {
        $company = Company::all();
        $contacts = Contact::all();

        return view('portfolio_company.add_company', [
            'company' => $company,
            'contacts' => $contacts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'c_name' =>'required|min:3',
            'website' => 'required',
            'country' => 'required',
            'status' => 'required',
            'stage' => 'required',
            'email' => 'required|email',
        ]);
        
        $company = new Company;
        $company->c_name = $request->c_name;
        $company->website = $request->website;
        $company->user_id = Auth::user()->id;
        $company->country = $request->country;
        $company->contact_id = $request->contact_id;
        $company->status = $request->status;
        $company->stage = $request->stage;
        $company->lead = $request->lead;
        $company->analyst = $request->analyst;
        $company->tags = $request->tags;
        $company->email = $request->email;

        $company->save();

        return redirect('company_list')->with('success', 'Company details saved!');
        return $request->all();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $company = Company::getAllCompanydata();
        if (count($company) > 0)
        {
            return view('portfolio_company.company_list', [
                'companyData' => $company
            ]);
        }
        else
        {
            return view ('portfolio_company.company_list');
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response    
     */
    public function viewSingleCompany(Request $request){
        $id = $request->id;
        $companyData = Company::find($id);

        if(!$companyData) {
            return redirect('/company_list');
        }

        $company_contacts = [];
        $all_contacts = explode('_', $companyData->contact_id);

        foreach($all_contacts as $contact_id) {
            $contact = Contact::find($contact_id);

            array_push($company_contacts, $contact);
        }
        // dd($company_contacts);
        $files = Cfile::where('company_id',$id)->get();
        // dd($files[2]);
        $contacts = Contact::all();

        $dir = '/';
        $type = 'file';
        $mimetype = 'application/vnd.google-apps.spreadsheet';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $google_files = $contents->where('type', '=', $type);
        // dd(Storage::cloud()->url($google_files[0]['path']));

        $companies = Company::where('id', '!=', $companyData->id)->get();

        $compared_companies = CompareCompany::where('company_id', $companyData->id)->get();

        $all_compared_data = [];
        foreach($compared_companies as $compared) {
            // dd($compared->company()->first());
            $compared_data = CompareCompanyData::where('compare_company_id', $compared->id)->get();

            $each_kpi = [];
            $colors = [];
            $graph_name = '';
            foreach($compared_data as $data) {
                $kpi_data = explode('_', $data->kpis);
                // dd($compared);
                $sheet = Sheet::where('name', $compared->company()->first()->c_name)->first();

                if($data->source == 'google' && $sheet) {
                    $result = $this->getGoogleSheetKpiData($sheet, $kpi_data);

                    array_push($colors, Color::random_color());
                    array_push($each_kpi, $result[0]);
                    $graph_name .= $result[1];
                } else {
                    $report_metric_kpis = ReportMetricKpi::where('name', $kpi_data[0])->get();
                }
            }

            $company_compared['company'] = $compared->company()->first()->c_name;
            $company_compared['graph'] = $each_kpi;
            $company_compared['colors'] = $colors;
            $company_compared['chart'] = $compared->id;
            $company_compared['name'] = rtrim($graph_name, '/');
            array_push($all_compared_data, $company_compared);
        }
        // dd($all_compared_data);
        $metrics = new Metrics;
        $company_kpis = $metrics->fetchKPI($companyData->id);

        $performances = CompanyPerformance::where('company_id', $companyData->id)->get();
        $total_perfomances = [];

        foreach($performances as $performance) {
            $performance_charts = CompanyPerformanceChart::where('company_performance_id', $performance->id)->get();

            $each_metric = [];
            $perf_colors = [];
            $labels = [];
            foreach($performance_charts as $chart) {
                if($chart->type == 'report') {
                    $result = $this->getReportKpiData($chart->column, $companyData->id);
                } else {
                    $sheet = Sheet::where('name', $companyData->c_name)->first();
                    if($sheet) {
                        $kpi_data = array($chart->column, $chart->row);
                        $result = $this->getGoogleSheetKpiData($sheet, $kpi_data);
                    }
                }

                array_push($each_metric, $result[0]);
                array_push($perf_colors, Color::random_color());
                array_push($labels, $result[1]);
            }

            $perf_array['chart'] = $each_metric;
            $perf_array['name'] = $performance->name;
            $perf_array['colors'] = $perf_colors;
            $perf_array['labels'] = $labels;
            array_push($total_perfomances, $perf_array);
        }
        // dd($total_perfomances);

        $notes = CompanyNote::where('company_id', $companyData->id)->get();

        $latest_reports = [];

        $reports = CompanyReport::where('company_id', $companyData->id)->orderBy('id', 'desc')->paginate(2);
        // dd($reports);
        foreach($reports as $report) {
            if($report->report()->first()->report_type == 'sent') {
                $rep = [];
                $rep['type'] = 'sent';
                $sent_report = $report->report()->first()->sent_report()->first();
                $rep['id'] = $sent_report->id;
                $rep['title'] = $sent_report->report_title;
                array_push($latest_reports, $rep);
            } else if($report->report()->first()->report_type == 'received') {
                $rep = [];
                $rep['type'] = 'received';
                $received = $report->report()->first()->received_report()->first();
                $rep['id'] = $received->id;
                $rep['title'] = $received->report_title;
                $recipient = $received->recipient()->first();
                $rep['name'] = $recipient->contact()->first()->fname . ' ' . $recipient->contact()->first()->lname[0] . '.';
                    
                
                array_push($latest_reports, $rep);
            }
        }

        // dd($latest_reports);

        $company_history = CompanyHistory::where('company_id', $companyData->id)->orderBy('id', 'desc')->paginate(2);

        $funds = Fund::all();

        $company_funds = CompanyFund::where('company_id', $companyData->id)->orderBy('id', 'desc')->get();
        // dd($company_contacts);

        if ($companyData){
            return view ('portfolio_company.single_company',[
                'companyData'=>$companyData,
                'files' => $files,
                'contacts' => $contacts,
                'company_contacts' => $company_contacts,
                'google_files' => $google_files,
                'companies' => $companies,
                'compared_data' => $all_compared_data,
                'kpis' => $company_kpis,
                'performances' => $total_perfomances,
                'notes' => $notes,
                'reports' => $latest_reports,
                'histories' => $company_history,
                'funds' => $funds,
                'company_funds' => $company_funds
            ]);
        }
        
        return redirect('CompanyController@index');
    }

    public function getGoogleSheetKpiData($sheet, $kpi_data){
        $tool = Tool::where('name', 'google')->first();
        // dd($sheet);
        $spreadsheet = SpreadSheet::find($sheet->spread_sheet_id);
        $sheet_column_row = SheetColumnRow::where('sheet_id', $sheet->id)->first();
        $alphabet = range('A', 'Z');
        $length = 26;

        $client = Client::getClient($tool);
        $service = new \Google_Service_Sheets($client);

        // Get values
        $range = $sheet->name . '!' . $kpi_data[0] . $kpi_data[1] . ':' . $alphabet[$length-1] . $kpi_data[1] ;
        $response = $service->spreadsheets_values->get($spreadsheet->spread_sheet_id, $range);
        $metric_values = $response->getValues();

        // Get dates
        $range = $sheet->name . '!' . $sheet_column_row->date_row . ':' . $sheet_column_row->date_row;
        $response = $service->spreadsheets_values->get($spreadsheet->spread_sheet_id, $range);
        $dates = $response->getValues();

        $graph_name = $metric_values[0][0] . '/';

        $data = [];
        for ($i=0; $i < count($metric_values[0]); $i++) {
            if(!empty($dates[0][$i])) {
                $obj = new \stdClass;
                $val = $metric_values[0][$i];
                $ndate = \DateTime::createFromFormat('y', explode(" ", $dates[0][$i])[1]);
                //now to get the output
                $date = $ndate->format('Y');
                $obj->value = $val;
                $obj->date = explode(" ", $dates[0][$i])[0] . ' ' . $date;

                array_push($data, $obj);
            }
        }

        // array_push($colors, Color::random_color());
        // array_push($each_kpi, $data);
        // dd($data);

        return [$data, $graph_name];      
    }

    public function getReportKpiData($name, $company) {
        $contacts = Contact::where('company', $company)->get();
        
        $kpi_values = [];
        foreach($contacts as $contact) {
            $recipients = Recipient::where('contact_id', $contact->id)->get();
            foreach($recipients as $recipient) {
                $sent_report = SentReport::find($recipient->report_id);
                if($sent_report) {
                    $report = Report::find($sent_report->report_id);
                    $report_metrics = ReportMetric::where('report_id', $report->id)->get();

                    foreach($report_metrics as $metric) {
                        $metric_kpis = ReportMetricKpi::where('report_metric_id', $metric->id)
                            ->where('name', $name)
                            ->get();

                        foreach($metric_kpis as $metric_kpi) {
                            $submitted_report = SubmittedReport::where('request_id', $metric->id)
                                ->where('kpi_id', $metric_kpi->id)
                                ->first();
                            
                            $obj = new \stdClass;
                            $obj->value = $submitted_report->response;
                            $obj->date = date('M Y', strtotime($metric_kpi->created_at));

                            array_push($kpi_values, $obj);
                        }
                    }
                }
            }
        }
        // dd($kpi_values);

        return [$kpi_values, $name];
    }

    public function addPerformanceChart(Request $request, $id) {
        $performance = new CompanyPerformance;
        $performance->company_id = $id;
        $performance->name = $request->name;
        $performance->save();

        foreach($request->kpis as $kpi) {
            $performance_chart = new CompanyPerformanceChart;
            $performance_chart->company_performance_id = $performance->id;
            $data = explode('_', $kpi);
            $performance_chart->type = $data[0];
            $performance_chart->column = $data[1];
            if($data[0] == 'google') {
                $performance_chart->row = $data[2];
            }
            $performance_chart->save();

            $history = new CompanyHistory;
            $history->company_id = $id;
            $history->action = 'Edited Performance section to include “' . $performance->name . '”';
            $history->user = auth()->user()->id;

            $history->save();
        }
        // dd($performance, $performance_chart);

        return back();
    }
 
    public function updateCompany($id){
        $type = request()->query('type');
        $company = Company::find($id);

        $history = new CompanyHistory;
        $history->company_id = $company->id;

        if($type == 'contact') {
            $company->contact_id .= '_'.request()->contact;

            $contact = Contact::find(request()->contact);
            
            $history->action = 'Edited contact section to include “' . $contact->fname . ' ' . $contact->lname . '”';
            $history->user = auth()->user()->id;

            $history->save();
        } else if($type == 'desc') {
            $company->desc = request()->desc;

            $history->action = 'Edited description section';
            $history->user = auth()->user()->id;

            $history->save();
        } else if($type == 'google') {
            $efile = new Efile;

            $file_data = explode('___', request()->file);
            $efile->user_id = auth()->user()->id;
            $efile->name = $file_data[0];
            $efile->type = $file_data[1];
            $efile->path = $file_data[2];
            $efile->company_id = $id;
            $efile->source = $type;
            $efile->size = FileSize::approxSize($file_data[3]);
            
            $efile->save();

            $cfile = new Cfile;

            $cfile->efile_id = $efile->id;
            $cfile->user_id = auth()->user()->id;
            $cfile->company_id = $id;
            $cfile->type = $type;

            $cfile->save();

            
            $history->action = 'Linked file “' . $efile->name . '”';
            $history->user = auth()->user()->id;

            $history->save();
        } else if($type == 'local') {
            $file = FileUpload::uploadImage(request()->file('file'), 'files');
            // dd($file, request()->file);

            $efile = new Efile;

            $efile->user_id = auth()->user()->id;
            $efile->name = request()->file->getClientOriginalName();
            $efile->type = request()->file->getMimeType();
            $efile->path = $file;
            $efile->company_id = $id;
            $efile->source = $type;
            $efile->size = FileSize::approxSize(request()->file->getSize());

            $efile->save();

            $cfile = new Cfile;

            $cfile->efile_id = $efile->id;
            $cfile->user_id = auth()->user()->id;
            $cfile->company_id = $id;
            $cfile->type = $type;

            $cfile->save();
            
            $history->action = 'Linked file “' . $efile->name . '”';
            $history->user = auth()->user()->id;

            $history->save();
        } else if($type == 'compare') {
            $compare = new CompareCompany;

            $compare->company_id = $id;
            $compare->compared_company = request()->company;

            $compare->save();
            // dd(request());
            foreach(request()->kpis as $kpi) {
                $data = explode('_', $kpi);

                $compared_data = new CompareCompanyData;

                $compared_data->compare_company_id = $compare->id;
                $compared_data->source = count($data) > 1 ? 'google':'report';
                $compared_data->kpis = $kpi;

                $compared_data->save();

            }
            
            $history->action = 'Edited comparison section to include “' . $compare->company()->first()->c_name . '”';
            $history->user = auth()->user()->id;

            $history->save();

            // dd($compare, $compared_data);
        }

        $company->save();

        return back();
    }

    public function deleteContact(Request $request, $id) {
        $company_id = $request->query('company');

        $company = Company::find($company_id);
        $contacts = explode('_', $company->contact_id);

        $key = array_search($id, $contacts);

        if($key) {
            unset($contacts[$key]);
        }

        $new_contacts = join($contacts, '_');
        $company->contact_id = $new_contacts;

        $company->save();

        $contact = Contact::find($id);
        $history = new CompanyHistory;
        $history->company_id = $company->id;
        $history->action = '“' . $contact->fname . ' ' . $contact->lname .'” was removed from your contacts';
        $history->user = auth()->user()->id;

        $history->save();

        return back();
    }

    public function removeCompared($id) {
        // $company = Company::where('c_name', request()->query('company'))->first();

        $company_compared = CompareCompany::find($id);

        $data = CompareCompanyData::where('compare_company_id', $company_compared->id)->get();

        foreach($data as $chart) {
            $chart->delete();
        }

        $company_compared->delete();

        $history = new CompanyHistory;
        $history->company_id = $company_compared->company_id;
        $history->action = '“' . $company_compared->company()->first()->c_name .'” was removed from comparison section';
        $history->user = auth()->user()->id;

        $history->save();

        return back();
    }

    public function sendNote(Request $request,$id)
    {
        $contact = Contact::find($request->contact);
        if($contact){
            $len = strlen('@'.$contact->fname);
            $pos = strpos($request->note, '@'.$contact->fname);
            $note = substr($request->note, $len);
        } else {
            $note = $request->note;
        }
        
        // dd($note);

        $new_note = new CompanyNote;
        $new_note->contact_id = $request->contact;
        $new_note->company_id = $id;
        $new_note->note = $note;

        $new_note->save();

        
        $history = new CompanyHistory;
        $history->company_id = $id;
        if($contact) $history->action = 'A note was sent to “' . $contact->fname . ' ' . $contact->lname . '”';
        else $history->action = 'A note was created by “' . auth()->user()->fname . ' ' . auth()->user()->lname . '”';
        $history->user = auth()->user()->id;

        $history->save();

        return back();
    }

    public function addRound(Request $request, $id) {
        // dd($request);
        // $new_fund = CompanyFund::where('company_id', $id)->where('fund_id', $request->fund)->first();

        // if(!$new_fund) {
            $new_fund = new CompanyFund;
            $new_fund->company_id = $id;
            $new_fund->fund_id = $request->fund;
            $new_fund->committed =$request->committed;
            $new_fund->committed_currency = $request->commited_currency;
            $new_fund->round = $request->round;
            $new_fund->save();
        // }

        $new_tranche = new CompanyFundTranche;
        $new_tranche->company_fund_id = $new_fund->id;
        $new_tranche->tranche_value = $request->tranche_value;
        $new_tranche->tranche_currency = $request->tranche_currency;
        $new_tranche->tranche_date = $request->tranche_date;
        $new_tranche->save();

        $history = new CompanyHistory;
        $history->company_id = $id;
        $history->action = '“' . $new_fund->round . '” was added to the funding section';
        $history->user = auth()->user()->id;

        $history->save();

        $fund_activity = new FundActivity;
        $fund_activity->user_id = auth()->user()->id;
        $fund_activity->company_id = $id;
        $fund_activity->action = $new_fund->round;
        $fund_activity->amount = $new_fund->committed_currency . $new_fund->committed;
        $fund_activity->fund_id = $new_fund->fund_id;
        $fund_activity->save();

        return back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCompanyPictureAttribute(Request $request)
    {
        $company = Company::find($request->website);

        if ($company->website)
        {
            return $company->website;
        }

        return substr($company->c_name, 0, 1) . '.png';
    }

    public function newCompany() {
        return view('portfolio_company.new_company');
    }

    public function updateFund(Request $request, $id) {
        // dd($request, $id);
        // $company_fund_id = $request->qwery('q');
        $company_fund = CompanyFund::find($id);

        $company_fund->round = $request->round;
        $company_fund->shares = $request->shares;
        $company_fund->percent_owned = $request->percent_owned;
        $company_fund->round = $request->round;
        $company_fund->round_size = $request->round_size;
        $company_fund->round_size_currency = $request->round_size_currency;
        $company_fund->next_round_timeline = $request->next_round_timeline;
        $company_fund->forecast_echovc_inv = $request->forecast_echovc_inv;
        $company_fund->forecast_echovc_inv_currency = $request->forecast_echovc_inv_currency;
        $company_fund->investors_in_seed = $request->investors_in_seed;

        $company_fund->save();

        $fund_activity = new FundActivity;
        $fund_activity->fund_id = $request->fund_id;
        // $fund_activity->action = 'Edited “' . $request->round . '” for “' . $company_fund->company()->first()->c_name . '”';
        $fund_activity->company_id = $company_fund->company_id;
        $fund_activity->action = $request->round;
        $fund_activity->amount = $request->round_size_currency . $request->round_size;
        $fund_activity->user_id = auth()->user()->id;
        $fund_activity->save();

        return back();

        // $company_fund_tranche = CompanyFundTranche::where()
    }

    public function exit($id) {
        $status = request()->status;

        $company = Company::find($id);

        $company->status = $status == 'true' ? 'open' : 'close';
        $company->save();

        $history = new CompanyHistory;
        $history->company_id = $id;
        $history->action = $company->status == 'close' ? 'Company exited' : 'Company opened';
        $history->user = auth()->user()->id;

        $history->save();

        return;
    }

    public function update(Request $request, $id)
    {
        // dd($request, $id);
        $company = Company::find($id);

        $company->website = $request->website;
        $company->email = $request->email;
        if($request->country) $company->country = $request->country;
        $company->tags = $request->tags;

        $company->save();

        return back();
    }

    public function archive($id)
    {
        $company = Company::find($id);
        $company->delete();

        $company_funds = CompanyFund::where('company_id', $id)->get();
        foreach($company_funds as $company_fund){
            $company_fund->delete();
        }

        $fund_activities = FundActivity::where('company_id', $id)->get();
        foreach($fund_activities as $fund_activity){
            $fund_activity->delete();
        }

        $companies_compared = CompareCompany::where('compared_company', $id)
                                ->orWhere('company_id', $id)
                                ->get();
        foreach($companies_compared as $company_compared){
            $companies_compared->delete();
        }
        
        

        return redirect('/company_list');
    }
}
