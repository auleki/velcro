<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DashboardChartsTable;
use App\SelectedMetric;
use App\Services\MetricValue;
use App\Dashboard;
use App\Services\Client;
use App\Company;
use App\Fund;
use App\CompanyFund;
use App\Report;
use App\FundActivity;
use App\Http\Controllers\MetricsController as Metric;
use App\FundChart;
use App\FundChartMetric;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $company = \Auth::user()->id;

        $dashboards = Dashboard::where('company_id', $company)->orderBy('id', 'asc')->get();

        // dd($dashboards, $charts_tables, $selected_metrics);
        
        if (count($dashboards) <= 0) {
            return view('home.dashboard');
        }
        
        $result = [];
        $graph_names = [];
        $chart_type = [];
        $colors = [];
        $names = [];

        for ($i=0; $i < count($dashboards); $i++) { 
            $data = $this->dashboard($dashboards[$i]->id);
            array_push($result, $data[0]);
            // dd($data);
            array_push($graph_names, $data[1]);
            array_push($chart_type, $data[2]);
            array_push($colors, $data[3]);
            array_push($names, $data[4]);
        }
        
        $metric = new Metric;
        $sources = $metric->addChart($dashboards[0]->id);
        // dd($metrics);
        // dd($dashboards, $result, $graph_names, $chart_type, $colors, $names);
        return view('home.dashboard1', compact('dashboards', 'result', 'graph_names', 'chart_type', 'colors', 'names', 'sources'));

    }

    public function dashboard($dashboard_id, $board='dashboard')
    {
        // dd($dashboard_id, $company);
        if($board == 'dashboard') {
            $charts_tables = DashboardChartsTable::where('dashboard_id', $dashboard_id)->get();
        } else {
            $charts_tables = FundChart::where('fund_id', $dashboard_id)->get();
        }
        //dd($charts_tables);
        $dashboard_charts_tables = [];
        $graph_names = [];
        $chart_type = [];
        $colors = [];
        $names = [];

        for ($i=0; $i < count($charts_tables); $i++) { 
            $el = $charts_tables[$i];
            if($board == 'dashboard') {
                $selected_metrics = SelectedMetric::where('charts_tables_id', $el->id)->get();
            } else {
                $selected_metrics = FundChartMetric::where('fund_chart_id', $el->id)->get();
            }

            $all_colors = [];
            $all_names = [];
            $all_metrics = [];
            // dd($selected_metrics);
            foreach($selected_metrics as $selected_metric) {
                $source = explode('_', $selected_metric->source)[0];
                $sheet = explode('_', $selected_metric->source)[1];
                // $metrics = [];
                // dd($company, $metrics, $selected_metrics);
                $response = MetricValue::getMetricValues($source, $selected_metric->metric, $selected_metric->row, $selected_metric->tool, $sheet);
                array_push($all_colors, '#' . $selected_metric->color);
                array_push($all_names, $selected_metric->name);
                array_push($all_metrics, $response);
            }
            
            // die();
            array_push($dashboard_charts_tables, $all_metrics);
            $obj = new \stdClass;
            $obj->id = $el->id;
            $obj->title = $el->title;
            array_push($graph_names, $obj);
            array_push($chart_type, $el->type);
            array_push($colors, $all_colors);
            array_push($names, $all_names);
        }
        
       // dd($dashboard_charts_tables);
        // if (count($dashboard_charts_tables) > 0) {
        //     return view('home.dashboard1', compact('dashboard_charts_tables'));
        // }
        // dd($dashboard_charts_tables, $graph_names, $chart_type, $colors, $names);
        return [$dashboard_charts_tables, $graph_names, $chart_type, $colors, $names];
    }

    public function createDashboard(Request $request) {
        $name = $request->dashboard;
        $user_id = \Auth::user()->id;
        $company_id = \Auth::user()->id;

        $dashboard = new Dashboard;

        $dashboard->name = $name;
        $dashboard->user_id = $user_id;
        $dashboard->company_id = $company_id;

        $dashboard->save();

        // dd($dashboard);
        return redirect()->action('HomeController@index');
    }

    public function deleteChart($id) {
        $charts_tables = DashboardChartsTable::find($id);

        $selected_metrics = SelectedMetric::where('charts_tables_id', $charts_tables->id)->get();

        foreach($selected_metrics as $metric) {
            $metric->delete();
        }

        $charts_tables->delete();

        return 'success';
    }

    public function deleteDashboard($id) {
        $dashboard = Dashboard::find($id);

        $charts_tables = DashboardChartsTable::where('dashboard_id',$id)->get();

        foreach($charts_tables as $chart) {
            $selected_metrics = SelectedMetric::where('charts_tables_id', $chart->id)->get();

            foreach($selected_metrics as $metric) {
                $metric->delete();
            }
            $charts_tables->delete();
        }

        $dashboard->delete();

        return back();
    }

    public function welcome(){
        $user = auth()->user();
        $fund_id = request()->query('fund');
        // dd($user);

        $funds = Fund::all();

        if(count($funds) <= 0) {
            return view('home.new_welcome');
        }

        $num_of_investments = 0;
        $amount_invested = 0;
        $num_of_exits = 0;

        if(!$fund_id && count($funds) > 0) {
            $fund_id = $funds[0]->id;
        }
        
        // $company_funds = CompanyFund::where('fund_id', $fund_id)->orderBy('id', 'desc')->get();
        $company_funds = CompanyFund::where('fund_id', $fund_id)->orderBy('company_id', 'desc')->get();

        foreach($company_funds as $c_fund) {
            $tranches = $c_fund->tranches()->get();
            $num_of_investments += count($tranches);

            foreach($tranches as $tranche) {
                $amount_invested += $tranche->tranche_value;
            }
        }

        $active_fund = $fund_id;

        $reports = Report::orderBy('id', 'desc')->paginate(2);

        $latest_reports = [];
        foreach($reports as $report) {
            if($report->report_type == 'sent') {
                $rep = [];
                $rep['type'] = 'sent';
                $sent_report = $report->sent_report()->first();
                $rep['id'] = $sent_report->id;
                $rep['title'] = $sent_report->report_title;
                array_push($latest_reports, $rep);
            } else if($report->report_type == 'received') {
                $rep = [];
                $rep['type'] = 'received';
                $received = $report->received_report()->first();
                $rep['id'] = $received->id;
                $rep['title'] = $received->report_title;
                $recipient = $received->recipient()->first();
                $rep['name'] = $recipient->contact()->first()->fname . ' ' . $recipient->contact()->first()->lname[0] . '.';
                    
                array_push($latest_reports, $rep);
            } else if($report->report_type == 'draft') {
                $rep = [];
                $rep['type'] = 'draft';
                $draft_report = $report->draft_report()->first();
                $rep['id'] = $draft_report->id;
                $rep['title'] = $draft_report->report_title;
                    
                array_push($latest_reports, $rep); 
            } else if($report->report_type == 'scheduled') {
                $rep = [];
                $rep['type'] = 'scheduled';
                $scheduled = $report->scheduled_report()->first();
                $rep['id'] = $scheduled->id;
                $rep['title'] = $scheduled->report_title;
                    
                array_push($latest_reports, $rep);
            }
        }

        // dd($num_of_investments, $amount_invested, $num_of_exits, $latest_reports);
        $c_id = 0;

        $activity_summary = [];
        $each_company = [];
        foreach($company_funds as $comp) {
            if($comp->company_id != $c_id) {
                if(count($each_company) > 0) array_push($activity_summary, $each_company);
                $each_company = [];
                array_push($each_company, $comp);
                $c_id = $comp->company_id;
            } else {
                array_push($each_company, $comp);
            }
        }
        if(count($each_company) > 0) array_push($activity_summary, $each_company);
        // dd($activity_summary);
        $fund_data = Fund::find($fund_id);
        // dd($fund_data->tag);
        if($fund_data) $latest_activities = $fund_data->activities()->orderBy('id', 'desc')->paginate(2);
        else $latest_activities = [];
        // dd($latest_activities);

        $metric = new Metric;
        $sources = $metric->addChart(0);

        $charts = $this->dashboard($fund_data->id, 'fund');
        
        return view('home.welcome', compact(
            'user', 
            // 'companies', 
            'funds', 
            'num_of_investments', 
            'amount_invested', 
            'num_of_exits', 
            'latest_reports',
            'active_fund',
            'activity_summary',
            'fund_data',
            'latest_activities',
            'sources',
            'charts'
        ));
    }

    public function addMetrics($company_funds) {
        $filtered_company = [];
        $c_id = [];
        foreach($company_funds as $c_fund) {
            if(!in_array($c_fund->company_id, $c_id)) {
                array_push($filtered_company, $c_fund);
                array_push($c_id, $c_fund->company_id);
            }
        }



        dd($filtered_company);
    }
}
