<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
//Google Sheets
use Revolution\Google\Sheets\Facades\Sheets;
// These for charts
use App\Charts\UserLineChart;
use App\Graph;
//These for excel import/export
use App\Exports\ExportGraph;
use App\Imports\ImportGraph;
use App\Imports\GetSheet;
use Maatwebsite\Excel\Facades\Excel;
use App\Tool;
use Illuminate\Support\Str;
use App\Services\StorageClass;
use App\Metric;
use App\SelectedMetric;
use App\DashboardChartsTable;
use App\Services\Client;
use App\SpreadSheet;
use App\Sheet;
use App\SheetColumnRow;
use App\Services\FileUpload;
use App\ExcelSheet;
use App\Company;
use App\Contact;
use App\Recipient;
use App\SentReport;
use App\Report;
use App\ReportMetric;
use App\ReportMetricKpi;
use App\FundChart;
use App\FundChartMetric;

class MetricsController extends Controller
{

      /**
      * Handle the incoming request.
      *
      * @param  \Illuminate\Http\Request  $request
      *
      * @return \Illuminate\Http\Response
      */
     public function __invoke(Request $request)
     {
        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
                        ->sheet(config('sheets.post_sheet_id'))
                        ->get();

        //$header = $sheets->pull(0);
        $header = [
            'name',
            'message',
            'created_at',
        ]; 

        $posts = Sheets::collection($header, $sheets);
        $posts = $posts->reverse()->take(10);

        return view('metrics.google_test')->with(compact('posts'));
     }


    public function index()
    {
        $graphs = Graph::all();
        $user_id = \Auth::user()->id;
        $xero = count(Tool::where('id', $user_id)
            ->where('name', 'xero')->get());
        $google = count(Tool::where('id', $user_id)
            ->where('name', 'google')->get());
        $trello = count(Tool::where('id', $user_id)
            ->where('name', 'trello')->get());
        $airtable = count(Tool::where('id', $user_id)
            ->where('name', 'airtable')->get());
        // dd($xero, $google, $trello, $airtable);

        return view('metrics.create', compact('xero', 'trello', 'google', 'airtable'))->with('graphs', $graphs);
    }


    /**
   * @return \Illuminate\Support\Collection
   */
   public function importExport()
   {
      $graphs = Graph::all();
      return view('import')->with('graphs', $graphs);
   }

   /**
   * @return \Illuminate\Support\Collection
   */
   public function export()
   {
       return Excel::download(new ExportGraph, 'metrics.xlsx');
   }

   public function saveExcel(Request $request) {
       $file = config('app.url') . FileUpload::uploadExcel(request()->file('file'), 'excel');

       $user_provided = new ExcelSheet;
       $user_provided->user_id = auth()->user()->id;
       $user_provided->title = $request->name;
       $user_provided->link = $file;
       $user_provided->name = $request->file('file')->getClientOriginalName();
       $user_provided->description = $request->desc;

       $user_provided->save();

       return redirect('/user_provided_sheets');
   }

   public function userProvidedSheets()
   {
       $spreadsheets = ExcelSheet::all();

       $all_metrics = Tool::where('name', 'trello')
                    ->orWhere('name', 'xero')
                    ->get(); 
        $current[0] = '';
        $current[1] = 'user_provided';

        $google_sheets = Sheet::all();

        // dd($spreadsheets, $all_metrics, $current);

       return view('metrics.provided_metric', compact('spreadsheets', 'all_metrics', 'current', 'google_sheets'));
   }

   public function getExcelSheets($id)
   {
       $spread_sheet = ExcelSheet::find($id);
       $path = explode('storage', $spread_sheet->link)[1];

        $import = new GetSheet();
        $ts = Excel::import($import, $path);
        $all_sheets = $import->sheetNames;

        return view('metrics.sheets', compact('all_sheets', 'spread_sheet'));
   }

   public function getExcelSheetMetrics($name) {
       $spread_sheet = ExcelSheet::find(request()->query('s'));

       $path = explode('storage', $spread_sheet->link)[1];

        $import = new GetSheet();
        $ts = Excel::import($import, $path);
        $sheet_names = $import->sheetNames;
        $sheet_data = $import->sheetData;
        // $data = [];

        $key = array_search($name, $sheet_names);
        $data = $sheet_data[$key][0];

        $metrics = [];
        foreach ($data as $key => $value) {
            array_push($metrics, $key);
        }
        // dd($metrics);

        return view('metrics.kpi', compact('metrics', 'spread_sheet', 'name'));
   }

   public function getMetricKPI($kpi) {
       $spread_sheet = ExcelSheet::find(request()->query('s'));

       $path = explode('storage', $spread_sheet->link)[1];

        $import = new GetSheet();
        $ts = Excel::import($import, $path);
        $sheet_names = $import->sheetNames;
        $sheet_data = $import->sheetData;
        // $data = [];

        $name = request()->query('m');
        $key = array_search($name, $sheet_names);
        $sheet_data = $sheet_data[$key];

        $data = [];

        foreach ($sheet_data as $sheet) {
            foreach ($sheet as $key => $value) {
                $data_obj = new \stdClass;
                // dd($key, $kpi);
                if($key == $kpi) {
                    $data_obj->value = $value;
                    $dateFormat = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet['Date']);
                    $date = $dateFormat->format('M Y');
                    // dd($date);
                    $data_obj->date = $date;
                    array_push($data, $data_obj);
                }
            }
            
        }

        return view('metrics.single_kpi', compact('data', 'name', 'kpi', 'spread_sheet'));

   }

   /**
   * @return \Illuminate\Support\Collection
   */
   public function import(Request $request)
   {

        $file = config('app.url') . FileUpload::uploadExcel(request()->file('file'), 'excel');
        
       $array = Excel::toArray(new ImportGraph, request()->file('file'));
    //    dd($array, $file);
       $source = new Tool;
       $source->user_id = \Auth::user()->id;
       $source->name = 'excel';
       $source->token = Str::uuid()->toString();
       $source->document = 'Excel - ' . $request->file('file')->getClientOriginalName();

       $source->save();

       return redirect('/metrics')->with('success', 'Excel Sheet Successful Uploaded');
   }

   public function addChart($dashboard) {
       $user_id = \Auth::user()->id;
       $tools = Tool::where('user_id', $user_id)->get();
       $sheets = Sheet::all();
       $chart = request()->query('chart');

       $sources = [];
       $excel_spreadsheets = ExcelSheet::all();

       $excel_sheets = [];
       foreach($excel_spreadsheets as $excel)
       {
           $path = explode('storage', $excel->link)[1];

            $import = new GetSheet();
            $ts = Excel::import($import, $path);
            $all_sheets = $import->sheetNames;

            foreach($all_sheets as $sheet) {
                $obj = new \stdClass;
                $obj->name = $sheet;
                $obj->id = $excel->id;
                $obj->pre = 'Excel - ';
                $obj->tool = 'excel';
                $obj->metrics = $this->fetchMetrics($excel->id, 'excel', $sheet);
                array_push($sources, $obj);
            }
            
       }

       foreach($tools as $tool) {
        $obj = new \stdClass;
        if($tool->name != 'google' && $tool->name != 'excel') {
            $obj->name = $tool->document;
            $obj->id = $tool->id;
            $obj->pre = '';
            $obj->tool = $tool->name;
            $obj->metrics = $this->fetchMetrics($tool->id, $tool->name, $tool->document);
            array_push($sources, $obj);
        }
       }

       foreach($sheets as $sheet) {
        $obj = new \stdClass;
        $obj->name = $sheet->name;
        $obj->id = $sheet->id;
        $obj->pre = 'Google - ';
        $obj->tool = 'google';
        $obj->metrics = $this->fetchMetrics($sheet->id, 'google', $sheet->name);
        array_push($sources, $obj);
       }

       return $sources;
    //    dd($sources);

       if($chart) {
        $charts_tables = DashboardChartsTable::find($chart);
        $tool = Tool::find($charts_tables->source);
        $metrics = Metric::where('tool_id', $tool->name)->get();

        return view('home.edit_chart', compact('sources', 'dashboard', 'charts_tables', 'metrics' ));
       }

    //    dd($dashboard, $sources);

       return view('home.add_chart', compact('sources', 'dashboard'));
   }

   public function fetchMetrics($id, $tool_name, $name) {
    //    $id = request()->query('source');
    //    $tool_name = request()->query('tool');
    //    $name = request()->query('name');
    // dd($id, $tool_name, $name);
       if($tool_name == 'google') {
           $sheet = Sheet::find($id);
        //    dd($id);
           $spreadsheet = SpreadSheet::find($sheet->spread_sheet_id);
           $tool = Tool::where('name', 'google')->first();

           $sheet_row_col = SheetColumnRow::where('sheet_id', $sheet->id)->first();

           $client = Client::getClient($tool);

           $service = new \Google_Service_Sheets($client);

            // Get metric names
            $range = $sheet->name . '!' . $sheet_row_col->metric_column . ':' . $sheet_row_col->metric_column;
            $response = $service->spreadsheets_values->get($spreadsheet->spread_sheet_id, $range);
            $metrics = $response->getValues();

            $all_metrics = [];
            for($j=0; $j<count($metrics); $j++) {
                $data = new \stdClass;
                if (count($metrics[$j]) > 0) {
                    // $i = array_search($metric, $metrics);
                    // dd($i);
                    $data->column_name = $sheet_row_col->metric_column;
                    $data->row = $j + 1;
                    $data->name = $metrics[$j][0];
                    array_push($all_metrics, $data);
                }
            }

           return $all_metrics;
       } elseif($tool_name == 'excel') {
           $spread_sheet = ExcelSheet::find($id);

            $path = explode('storage', $spread_sheet->link)[1];

            $import = new GetSheet();
            $ts = Excel::import($import, $path);
            $sheet_names = $import->sheetNames;
            $sheet_data = $import->sheetData;
            // $data = [];

            $key = array_search($name, $sheet_names);
            $data = $sheet_data[$key][0];

            $metrics = [];
            foreach ($data as $key => $value) {
                array_push($metrics, $key);
            }

            return $metrics;
       }
       $tool = Tool::find($id);
    //    $user_id = $tool->user_id;
    //    $sheet = $tool->document;
       $type = $tool->name;

       $metrics = Metric::where('tool_id', $type)->get();

       return $metrics;
   }

   public function addMetrics() {
       $title = request()->query('chart_title');
       $type= request()->query('chart_type');
       $metric_source = explode(',', request()->query('metric_source'));
       $metrics = explode(',', request()->query('selected_metrics'));
       $company = request()->user()->id;
       $dashboard_id = request()->query('dashboard');
       $metric_colors = explode(',', request()->query('metric_colors'));
       $metric_rows = explode(',', request()->query('metrics_row'));
       $metric_names = explode(',', request()->query('metric_names'));

       $dashboard = new DashboardChartsTable;

       $dashboard->title = $title;
       $dashboard->type = $type;
       $dashboard->dashboard_id = (int) $dashboard_id;

       $dashboard->save();

       $data = [];

       for ($i=0; $i < count($metrics); $i++) { 
           $metric = $metrics[$i];
           $source = explode('_', $metric_source[$i])[0];
           $metric_type = explode('_', $metric_source[$i])[1];
           $sheet = explode('_', $metric_source[$i])[2];

           $add_metric = new SelectedMetric;

           $add_metric->charts_tables_id = $dashboard->id;
           $add_metric->metric = $metric;
           $add_metric->color = $metric_colors[$i];
           $add_metric->row = $metric_rows[$i];
           $add_metric->name = $metric_names[$i];
            $add_metric->source = $source . '_' . $sheet;
            $add_metric->tool = $metric_type;

           $add_metric->save();
        // dd($source, $company, $metrics, $metric_type, $metric_rows, $sheet);
           $kpi_values = $this->getMetricValues($source, $company, $metrics[$i], $metric_type, $metric_rows[$i], $sheet);
           array_push($data, $kpi_values);
       }
        // dd($data);
        return $data;
   }

   public function addFundMetrics() {
       $title = request()->query('chart_title');
       $type= request()->query('chart_type');
       $metric_source = explode(',', request()->query('metric_source'));
       $metrics = explode(',', request()->query('selected_metrics'));
       $company = request()->user()->id;
       $fund_id = request()->query('dashboard');
       $metric_colors = explode(',', request()->query('metric_colors'));
       $metric_rows = explode(',', request()->query('metrics_row'));
       $metric_names = explode(',', request()->query('metric_names'));

       $chart = new FundChart;

       $chart->title = $title;
       $chart->type = $type;
       $chart->fund_id = (int) $fund_id;

       $chart->save();

       $data = [];

       for ($i=0; $i < count($metrics); $i++) { 
           $metric = $metrics[$i];
           $source = explode('_', $metric_source[$i])[0];
           $metric_type = explode('_', $metric_source[$i])[1];
           $sheet = explode('_', $metric_source[$i])[2];

           $add_metric = new FundChartMetric;

           $add_metric->fund_chart_id = $chart->id;
           $add_metric->column = $metric;
           $add_metric->color = $metric_colors[$i];
           $add_metric->row = $metric_rows[$i];
           $add_metric->name = $metric_names[$i];
            $add_metric->source = $source . '_' . $sheet;
            $add_metric->tool = $metric_type;

           $add_metric->save();
        // dd($source, $company, $metrics, $metric_type, $metric_rows, $sheet);
           $kpi_values = $this->getMetricValues($source, $company, $metrics[$i], $metric_type, $metric_rows[$i], $sheet);
           array_push($data, $kpi_values);
       }
        // dd($data);
        return $data;
   }

   public function getMetricValues($source, $company, $metric, $type, $row, $sheet) {
       if($type == 'google') {
           $tool = Tool::where('name', $type)->first();
           $sheet = Sheet::find($source);
           $spreadsheet = SpreadSheet::find($sheet->spread_sheet_id);
           $sheet_column_row = SheetColumnRow::where('sheet_id', $sheet->id)->first();
           $alphabet = range('A', 'Z');
           $length = 26;

           $client = Client::getClient($tool);
            $service = new \Google_Service_Sheets($client);

            $new_obj = new \stdClass;
            // Get metric values
            $range = $sheet->name . '!' . $sheet_column_row->metric_column . $row . ':' . $alphabet[$length-1] . $row ;

            $response = $service->spreadsheets_values->get($spreadsheet->spread_sheet_id, $range);
            $metric_values = $response->getValues();

            // Get dates
            $range = $sheet->name . '!' . $sheet_column_row->date_row . ':' . $sheet_column_row->date_row;
            $response = $service->spreadsheets_values->get($spreadsheet->spread_sheet_id, $range);
            $dates = $response->getValues();

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
            
            return $data;
       } elseif ($type == 'excel') {
        //    dd($source, $company, $metrics, $type, $rows, $sheet);
            $spread_sheet = ExcelSheet::find($source);

            $path = explode('storage', $spread_sheet->link)[1];

            $import = new GetSheet();
            $ts = Excel::import($import, $path);
            $sheet_names = $import->sheetNames;
            $sheet_data = $import->sheetData;
            // $data = [];

            $key = array_search($sheet, $sheet_names);
            $sheet_data = $sheet_data[$key];

            $data = [];
            foreach ($sheet_data as $sheet) {
                foreach ($sheet as $key => $value) {
                    $data_obj = new \stdClass;
                    // dd($key, $kpi);
                    if($key == $row) {
                        $data_obj->value = $value;
                        $dateFormat = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet['Date']);
                        $date = $dateFormat->format('M Y');
                        // dd($date);
                        $data_obj->date = $date;
                        array_push($data, $data_obj);
                    }
                }
            }

            return $data;
       }
   }

   public function submitSheet(Request $request) {
       $new_sheet = new SpreadSheet;

       $new_sheet->title = $request->name;
       $new_sheet->spread_sheet_id = $request->link;
       $new_sheet->description = $request->desc;

       $new_sheet->save();

       return back();
    //    dd($request);
   }

   public function fetchKPI($id) {
       $company = Company::find($id);
    
       $sheet = Sheet::where('name', $company->c_name)->first();
        $all_metrics = [];
       $manual_kpis = [];
       $kpi_ids = [];
            $sheet_obj = new \stdClass;
// dd($company,$sheet);
       if($sheet) {
           $spreadsheet = SpreadSheet::find($sheet->spread_sheet_id);
           $tool = Tool::where('name', 'google')->first();

           $sheet_row_col = SheetColumnRow::where('sheet_id', $sheet->id)->first();

           $client = Client::getClient($tool);

           $service = new \Google_Service_Sheets($client);

            // Get metric names
            $range = $sheet->name . '!' . $sheet_row_col->metric_column . ':' . $sheet_row_col->metric_column;
            $response = $service->spreadsheets_values->get($spreadsheet->spread_sheet_id, $range);
            $metrics = $response->getValues();

            for($j=0; $j<count($metrics); $j++) {
                $data = new \stdClass;
                if (count($metrics[$j]) > 0) {
                    // $i = array_search($metric, $metrics);
                    // dd($i);
                    $data->column_name = $sheet_row_col->metric_column;
                    $data->row = $j + 1;
                    $data->name = $metrics[$j][0];
                    array_push($all_metrics, $data);
                }
            }

            $sheet_obj->name = 'Google sheet';
            $sheet_obj->data = $all_metrics;
            $all_kpis['sheets'] = $sheet_obj;
       }

       $contacts = Contact::where('company', $id)->get();
       foreach($contacts as $contact) {
        $recipients = Recipient::where('contact_id', $contact->id)->get();
        foreach($recipients as $recipient) {
            // dd($recipient);
            $sent_report = SentReport::find($recipient->report_id);
            if($sent_report) {
                $report = Report::find($sent_report->report_id);
                $report_metrics = ReportMetric::where('report_id', $report->id)->get();

                foreach($report_metrics as $metric) {
                    $kpis = ReportMetricKpi::where('report_metric_id', $metric->id)->get();

                    foreach($kpis as $kpi){
                        array_push($manual_kpis, $kpi->name);
                        array_push($kpi_ids, $kpi->id);
                    }
                }
            }
        }
       }
    //    dd($contacts);
       $report_obj = new \stdClass;
       $report_obj->name = 'Report';
       $report_obj->data = array_unique($manual_kpis);
       $all_kpis['reports'] = $report_obj;
    //    $all_kpis['report_ids'] = $kpi_ids;
    //    dd($all_kpis);
       return $all_kpis;
       dd($all_metrics, $manual_kpis, $kpi_ids);
   }
}


