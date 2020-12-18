<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App\Services\Callback;
use App\Services\Authorization;
use Illuminate\Http\Request;
use App\Services\StorageClass;
use App\Tool;
use Illuminate\Support\Str;

class ConnectController extends Controller
{
  public function index(Request $request){

    $tool = $request->query('tool');
    $user_id = auth()->user()->id;

    $checkIfUserHasConnected = Tool::where('user_id', $user_id)
                              ->where('name', $tool)
                              ->first();
    // dd($checkIfUserHasConnected); 

    if ($checkIfUserHasConnected) {
      return redirect()->to('/selected-metric/'.$checkIfUserHasConnected->tool_id);
    }

    if($tool == 'xero') {

      $connect = new Authorization();
      $result = $connect->xero();

			// Redirect the user to the authorization URL.
      if($result == 'Success') {
        return redirect($_SESSION['authorizationURL']);
      }
    } else if ($tool == 'trello') {
      $connect = new Authorization();
      $authUri = $connect->trello();

      return redirect($authUri);
    } else if ($tool == 'google') {
      // $connect = new Authorization();
      // $authUri = $connect->google();

      return redirect(filter_var($authUri, FILTER_SANITIZE_URL));
    }

    return redirect()->action('MetricsController@index')->with('error', 'Your ' . $tool . ' account was not successfully linked');
  }

  public function callback(Request $request) {
    $tool = $request->query('tool');
    $result = null;
    $uuid = ''; 

    if($tool == 'xero') {
      $callback = new Callback();
      $result = $callback->xero();
      // dd($result);
      if(is_array($result)) {
        $client = new \GuzzleHttp\Client();

        $res = $client->get('https://api.xero.com/api.xro/2.0/reports/profitandloss', [
            'headers' => [
                'Authorization' => "Bearer " . $result[1]->access_token,
                'Content-Type' => 'application/json',
                'Xero-tenant-id' => $result[0][0]->tenantId
            ]
        ]);

        $document = json_decode($res->getBody());
        $document = $document->Reports[0]->ReportTitles[1];
        $token = $result[1]->access_token;
        $expires_in = (integer) strtotime($result[0][0]->createdDateUtc) + $result[1]->expires_in;
        $refresh_token = $result[1]->refresh_token;
        $uuid = $this->store($tool, $token, $refresh_token, $expires_in, $document);
      }
    } else if ($tool == 'trello') {
        // Storage Classe uses sessions for storing token > extend to your DB of choice
        $storage = new StorageClass();  
      
      $callback = new Callback();

      $result = $callback->trello();

      if ($result != 'failed') {
        $expires_in = time() + 86400;
        $document = explode( " ",$result[1]->fullName)[0];
        $token = $result[0];
        $refresh_token = $result[2];
        $uuid = $this->store($tool, $token, $refresh_token, $expires_in, $document);
      }
    } else if ($tool == 'google') {
      $callback = new Callback();

      $result = $callback->google();
      
      if ($result != 'failed') {
        $token = $result['access_token'];
        $refresh_token = array_key_exists('refresh_token', $result) ? $result['refresh_token'] : null;
        $expires_in = time() + $result['expires_in'];
        $document = 'EchoVCPlex';
        // dd($token, $refresh_token, $expires_in, $document);
        $uuid = $this->store($tool, $token, $refresh_token, $expires_in, $document);
      }
    } 

    if ($result) {
      return redirect()->to('/selected-metric'.'/'.$uuid);
    }

    return redirect()->action('MetricsController@index')->with('error', 'Your ' . $tool . ' account was not successfully linked');;
  }

  public function googleConnect() {
    $tool = Tool::where('name', 'google')->first();

    if(!$tool) {
      $tool = new Tool;
      $tool->user_id = auth()->user()->id;
      $tool->name = 'google';
      $tool->document = 'google';
      $tool->tool_id = Str::uuid()->toString();
      $tool->token = Str::uuid()->toString();
      $tool->refresh_token = Str::uuid()->toString();

      $tool->save();
    }

      return redirect()->to('/selected-metric'.'/'.$tool->tool_id);
  }

  public function store($name, $token, $refresh_token = null, $expires_in = null, $document) {
    $user_id = \Auth::user()->id;

    // Check if user has added this tool
    $findTool = Tool::where('user_id', $user_id)
      ->where('name', $name)
      ->where('document', $document)->first();

      // If user hasn't added this tool
    if(!$findTool){
      $tool = new Tool;
      // dd($user_id, $tool, $token);
      $tool->name = $name;
      $tool->document = ucfirst($name) . ' - ' . $document;
      $tool->token = encrypt($token);
      $tool->user_id = $user_id;
      $tool->refresh_token = $refresh_token ? encrypt($refresh_token) : $refresh_token;
      $tool->expires_in = $expires_in;
      $tool->tool_id = Str::uuid()->toString();

      $tool->save();

      return $tool->tool_id;
    }

    return $findTool->tool_id;
  }
}
