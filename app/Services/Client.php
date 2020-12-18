<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
	
	class Client
	{
      public static function getClient($tool)
    {
      $client = Storage::cloud()->getAdapter()->getService()->getClient();
      return $client;
      // $client = new \Google_Client();
      // $client->setApplicationName('EchoVCPlex');
      // $client->setScopes(\Google_Service_Sheets::SPREADSHEETS_READONLY, \Google_Service_Drive::DRIVE_METADATA_READONLY);
      // $client->setAuthConfig('client_secret.json');
      // $client->setAccessType('offline');
      // $client->setPrompt('select_account consent');

      // if(time() < $tool->expires_in) {
      //   $client->setAccessToken(decrypt($tool->token));
      //   // dd(decrypt($tool->token));
      // } else {
      //   $access_token = $client->fetchAccessTokenWithRefreshToken(decrypt($tool->refresh_token));
        
      //   $tool->token = encrypt($access_token['access_token']);
      //   $tool->refresh_token = encrypt($access_token['refresh_token']);
      //   $tool->expires_in = $access_token['created'] + $access_token['expires_in'];
        
      //   $tool->save();
      //   $client->setAccessToken(decrypt($tool->token));
      // }

      // return $client;
    }

    public static function getValue($spreadsheetId, $range) {

      $response = $service->spreadsheets_values->get($spreadsheetId, $range);
      return $response->getValues();

    }
	}
?>
