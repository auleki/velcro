<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use PDF;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use App\Fund;
use App\CompanyFund;
use App\Report;
use App\FundActivity;
use App\Http\Controllers\HomeController as Chart;
use App\FundChart;
use App\FundChartMetric;

class ScreenShotController extends Controller
{
    public function index() {
        $websiteURL = "http://54.165.117.81";
        $api_response = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$websiteURL&screenshot=true");
        //decode json data
        $result = json_decode($api_response, true);
        //screenshot data
        $screenshot = $result['screenshot']['data'];
        $screenshot = str_replace(array('_','-'),array('/','+'),$screenshot); 
        //display screenshot image
        echo "<img src=\"data:image/jpeg;base64,".$screenshot."\" />";
    }

    public function snapshot($id) {
        $logo = 'data:image/' . 'png' . ';base64,' . base64_encode(file_get_contents("https://user-images.githubusercontent.com/22575481/78081212-eb249f80-73a7-11ea-9389-8c4dd3b13b02.png"));
        try {
            $fund = Fund::find($id);
            $emails = explode(',',request()->emails);

            $num_of_investments = 0;
            $amount_invested = 0;
            $num_of_exits = 0;

            $company_funds = CompanyFund::where('fund_id', $id)->orderBy('company_id', 'desc')->get();

            foreach($company_funds as $c_fund) {
                $tranches = $c_fund->tranches()->get();
                $num_of_investments += count($tranches);

                if($c_fund->status == 'close') {
                    $num_of_exits += 1;
                }

                foreach($tranches as $tranche) {
                    $amount_invested += $tranche->tranche_value;
                }
            }

            $home = new Chart;
            $charts = $home->dashboard($fund->id, 'fund');

            $activity_summary = [];
            $each_company = [];
            $c_id = 0;
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

            set_time_limit(3600);
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            $pdf->loadView('home.share_welcome_page', compact('fund', 'logo', 'num_of_investments', 'amount_invested', 'num_of_exits', 'charts', 'activity_summary'));
            // $pdf->download('fund.pdf');
            $content = $pdf->output();
            // dd($content);
            // $name = str_random(32);
            $name =  date('d-m-y') . '.pdf';
            $filePath = 'snapshots' . '/' .  $name;
            file_put_contents($name, $content);
            Storage::disk('public')->put($filePath, file_get_contents($name));
                
            Storage::disk('public')->setVisibility($filePath, 'public');
            $url = config('app.url') . '/storage/'.$filePath;
            dd($url);
        return view('home.share_welcome_page', compact('fund', 'logo', 'num_of_investments', 'amount_invested', 'num_of_exits', 'charts', 'activity_summary'));
            dd($fund, $emails, $num_of_exits, $num_of_investments, $amount_invested, $charts, $activity_summary);

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
            
           
        
      } catch (\Throwable $th) {
          dd($th);
        notify()->error("An error occured. Please try again","","topRight");
        return back();
      }

        return view('home.share_welcome_page');
    }
}
