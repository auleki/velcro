<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use XeroAPI\XeroPHP\AccountingObjectSerializer;
use App\Services\Callback;
use App\Services\Authorization;
use Illuminate\Http\Request;
use App\Services\StorageClass;
use App\Tool;
use App\MetricsParameter;
use App\Services\Report;
use App\SpreadSheet;
use App\SheetColumnRow;
use App\Sheet;
use App\Services\Client;
use App\Services\MetricValue;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;

class ProvidedMetricController extends Controller
{
  public function index(Request $request, $tool_id){
    $current = [];
    $user_id = \Auth::user()->id;
// dd($tool_id);
    if($tool_id == 'google-sheet') {
      $tool = Tool::where('name', 'google')->firstOrFail();
    } else {
      $tool = Tool::where('tool_id', $tool_id)->firstOrFail();
    }
    // dd($tool, $tool_id);
    if($tool->name == 'xero') $current = $this->xero($tool->document, $tool->name);
    elseif($tool->name == 'trello') $current = $this->trello($tool->document, $tool->name);
    elseif($tool->name == 'google') $current = $this->getSpreadSheets($tool);

    $checked = MetricsParameter::where('metric', $tool->name)->first();
    $all_metrics = Tool::where('user_id', $user_id)
                    ->where('name', 'trello')
                    ->orWhere('name', 'xero')
                    ->orWhere('name', 'excel')
                    ->get();

    $google_sheets = Sheet::all();

                    // dd($google_sheets);
    if ($tool->name == 'google') {

      return view('metrics.add', compact('tool', 'all_metrics', 'current', 'google_sheets'));
    }

    return view('metrics.provided_metric', compact('current', 'checked', 'all_metrics', 'tool_id', 'google_sheets'));
  }

   public function getSpreadSheets($tool) {
    // $spread_sheets = SpreadSheet::all();
    
      $dir = '/';
      $type = 'file';
      $mimetype = 'application/vnd.google-apps.spreadsheet';
      $recursive = false; // Get subdirectories also?
      $contents = collect(Storage::cloud()->listContents($dir, $recursive));
      $spread_sheets = $contents->where('type', '=', $type);

     return $spread_sheets;

    // return [ $tool->document, $tool->name, $spread_sheets];
  }

  public function xero($document, $tool) {
    return [$document, $tool, 'gross_profit', 'net_income', 'revenue', 
      'total_assets', 'total_cash', 'total_cost_of_sales', 
      'total_equity', 'total_expenses', 'total_liabilities', 
      'total_property'
    ];
  }

  public function trello($document, $tool) {
    return [$document, $tool, 'organizations', 'members', 'boards', 'cards'];
  }

  public function fetchSheets(Request $request, $spreadsheetId) {
    $tool_id = $request->query('tool');
    $name = $request->query('name');
    // $spread_sheet = SpreadSheet::where('spread_sheet_id', $spreadsheetId)->first();
    // $tool = Tool::where('tool_id', $tool_id)->firstOrFail();

    $find_spread_sheet = SpreadSheet::where('spread_sheet_id', $spreadsheetId)->first();

    if(!$find_spread_sheet) {
      $new_sheet = new SpreadSheet;

      $new_sheet->title = $name;
      $new_sheet->spread_sheet_id = $spreadsheetId;
      $new_sheet->description = '';

      $new_sheet->save();
    }

    $tool = Tool::find($tool_id);

    $client = Client::getClient($tool);
    // dd($tool, $client);

    $all_sheets = Metricvalue::sheets($client, $spreadsheetId);
    // dd($all_sheets, $spread_sheet);
    return $all_sheets;

    // return view('metrics.sheets', compact('tool_id', 'all_sheets', 'spread_sheet'));
  }

  public function fetchSheetData(Request $request, $toolId) {
    $spreadsheetId = $request->spreadsheet;
    $sheetId = $request->sheet;
    $row = $request->row;
    $column = $request->column;

    
    // dd($request);
    $tool = Tool::find($toolId);
    $spread_sheet = SpreadSheet::where('spread_sheet_id', $spreadsheetId)->first();

    $sheet = Sheet::where('name', $sheetId)
                  ->where('spread_sheet_id', $spread_sheet->id)
                  ->first();
    

    if($sheet) {
      $sheet_column_row = SheetColumnRow::where('sheet_id', $sheet->id)->first();
    }
    
    if(!$sheet) {
      $sheet = new Sheet;
      $sheet->name = $sheetId;
      $sheet->gid = '';
      $sheet->spread_sheet_id = $spread_sheet->id;
      $sheet->save();

      $sheet_column_row = new SheetColumnRow;

      $sheet_column_row->spreadsheet = '';
      $sheet_column_row->sheet_id = $sheet->id;
      $sheet_column_row->date_row = $row;
      $sheet_column_row->metric_column = $column;

      $sheet_column_row->save();
    }

    // dd($request, $tool);
    // $service = Storage::cloud()->getAdapter()->getService();
    $client = Client::getClient($tool);

    // $service = new \Google_Service_Drive($client);

    // $parameters = array();

    // $parameters['corpora'] = 'user';

    // $response = $service->files->listFiles($parameters);

    // dd($response);
    // Get dates
    $range = $sheetId . '!' . $row . ':' . $row;
    $all_dates = MetricValue::selectDates($client, $range, $spreadsheetId);

    $row_length = MetricValue::rowLength($client, $range, $spreadsheetId);

    // Get names
    $range = $sheetId . '!' . $column . ':' . $column;
    $all_metrics = MetricValue::selectNames($client, $range, $spreadsheetId, $sheet_column_row);

    
    // $all_sheets = MetricValue::sheets($client, $spreadsheetId);
    $all_sheets = Sheet::all();

    $all_tools = Tool::where('user_id', auth()->user()->id)
                    ->where('name', 'trello')
                    ->orWhere('name', 'xero')
                    ->orWhere('name', 'excel')
                    ->get();
                    // dd($sheet);
    // dd($all_dates, $all_metrics, $all_sheets, $sheetId, $all_tools);

    return view('metrics.google_sheet_metrics', compact('all_sheets', 'all_metrics', 'row_length', 'spreadsheetId', 'sheetId', 'all_tools', 'toolId'));
  }

  public function getSheetData(Request $request, $sheetId) {
    $spreadsheetId = $request->query('spreadsheet');
    $type = $request->query('type');
    $tool = Tool::where('name', $type)->first();
    // dd($request, $toolId);
    $spread_sheet = SpreadSheet::find($spreadsheetId);

    $sheet = Sheet::where('name', $sheetId)
                  ->where('spread_sheet_id', $spread_sheet->id)
                  ->first();
    // dd($sheet);
    $sheet_column_row = SheetColumnRow::where('sheet_id', $sheet->id)->first();

    // dd($request, $tool);
    $client = Client::getClient($tool);
    
    // Get names
    $range = $sheetId . '!' . $sheet_column_row->metric_column . ':' . $sheet_column_row->metric_column;
    // dd($range);
    $all_metrics = MetricValue::selectNames($client, $range, $spread_sheet->spread_sheet_id, $sheet_column_row);

    // dd($all_metrics);
    $range = $sheetId . '!' . $sheet_column_row->date_row . ':' . $sheet_column_row->date_row;
    $row_length = MetricValue::rowlength($client, $range, $spread_sheet->spread_sheet_id);
    // dd($range, $row_length);

    $all_sheets = Sheet::all();

    $all_tools = Tool::where('user_id', auth()->user()->id)
                    ->where('name', 'trello')
                    ->orWhere('name', 'xero')
                    ->get();
    // dd($all_dates, $all_metrics, $all_sheets, $sheetId, $all_tools);
    $spreadsheetId = $spread_sheet->spread_sheet_id;
    $toolId = $tool->tool_id;

    return view('metrics.google_sheet_metrics', compact('all_sheets', 'all_metrics', 'row_length', 'spreadsheetId', 'sheetId', 'all_tools', 'toolId'));
  }

  public function fetchMetricData(Request $request) {
    $spreadsheetId = $request->query('spreadsheetId');
    $sheetId = $request->query('sheetId');
    $index = $request->query('i');
    $toolId = $request->query('toolId');
    $length = $request->query('length');
    $column = $request->query('col');
    $kpi = $request->query('name');

    $tool = Tool::find($toolId);
    if(!$tool) {
      $tool = Tool::where('tool_id', $toolId)->first();
    }
    $spread_sheet = SpreadSheet::where('spread_sheet_id', $spreadsheetId)->first();
    $sheet = Sheet::where('spread_sheet_id', $spread_sheet->id)->where('name', $sheetId)->first();
    $sheet_column_row = SheetColumnRow::where('sheet_id', $sheet->id)->first();
    $alphabet = range('A', 'Z');
    // dd($toolId);

    $client = Client::getClient($tool);
    $service = new \Google_Service_Sheets($client);

    // Get metric values
    $range = $sheetId . '!' . $column . $index . ':' . $alphabet[$length-1] . $index ;
    // dd($range, $index);
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $metric_values = $response->getValues();

    // Get dates
    $range = $sheetId . '!' . $sheet_column_row->date_row . ':' . $sheet_column_row->date_row;
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $dates = $response->getValues();
    // dd($dates);

    $data = [];
    // dd($dates[0], $metric_values[0]);
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
    $name = $sheetId;
    // kpi, $dates[0], $metric_values[0], $data);

    return view('metrics.single_kpi', compact('name', 'kpi', 'data', 'spread_sheet'));
  }

  public function check($user_id) {
    // Storage Classe uses sessions for storing token > extend to your DB of choice
    $storage = new StorageClass();
    $xeroTenantId = (string)$storage->getSession()['tenant_id'];
    $clientId = getenv('XERO_CLIENT_ID');
    $clientSecret = getenv('XERO_CLIENT_SECRET');
    $redirectUri = getenv('XERO_REDIRECT_URI');
    // dd($storage->getHasExpired(), $xeroTenantId);
    if ($storage->getHasExpired()) {
      $provider = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => $clientId,
        'clientSecret'            => $clientSecret,
        'redirectUri'             => $redirectUri,
        'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
        'urlAccessToken'          => 'https://identity.xero.com/connect/token',
        'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
      ]);

      $newAccessToken = $provider->getAccessToken('refresh_token', [
        'refresh_token' => $storage->getRefreshToken()
      ]);

      // Save my token, expiration and refresh token
      $storage->setToken(
          $newAccessToken->getToken(),
          $newAccessToken->getExpires(),
          $xeroTenantId,
          $newAccessToken->getRefreshToken(),
          $newAccessToken->getValues()["id_token"]
      );
    }

    $client = new \GuzzleHttp\Client();
    // dd((string)$storage->getSession()['token']);

    $res = $client->get('https://api.xero.com/api.xro/2.0/reports/profitandloss', [
        'headers' => [
            'Authorization' => "Bearer " . (string)$storage->getSession()['token'],
            'Content-Type' => 'application/json',
            'Xero-tenant-id' => $xeroTenantId
        ]
    ]);

    $tenants = json_decode($res->getBody());

  }

  public function addRemoveParam(Request $request) {
    $checked = $request->query('checked');
    $param = $request->query('param');
    $metric = $request->query('metric');

    $findMetric = MetricsParameter::where('metric', $metric)->first();

    if ($findMetric) {
      if($checked == "true") {
        $findMetric->$param = true;
        $findMetric->save();
        return 'added';
      } else {
        $findMetric->$param = false;
        $findMetric->save();
        return 'removed';
      }
    }

    $new_metric = new MetricsParameter;

    $new_metric->metric = $metric;
    $new_metric->$param = true;

    $new_metric->save();
    return 'added';
  }

  public function delete() {
    Tool::query()->delete();

    return redirect()->action('MetricsController@index');
  }
}
