<?php
namespace App\Services;
    
use App\Services\StorageClass;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Callback {

    public function xero() {
        $clientId = getenv('XERO_CLIENT_ID');
        $clientSecret = getenv('XERO_CLIENT_SECRET');
        $redirectUri = getenv('XERO_REDIRECT_URI');

        // Storage Classe uses sessions for storing token > extend to your DB of choice
        $storage = new StorageClass();  

        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => $clientId,   
            'clientSecret'            => $clientSecret,
            'redirectUri'             => $redirectUri,
            'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
            'urlAccessToken'          => 'https://identity.xero.com/connect/token',
            'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
        ]);
    
        // If we don't have an authorization code then get one
        if (!isset($_GET['code'])) {
            return 'No code';

        // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            return 'Invalid State';
        } else {
            try {
                // Try to get an access token using the authorization code grant.
                $client = new Client();
                
                $bearerToken = "Basic " . base64_encode($clientId . ":" . $clientSecret);

                $res = $client->post('https://identity.xero.com/connect/token', [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Authorization' => $bearerToken
                    ],
                    'form_params' => [
                        'code' => $_GET['code'],
                        'redirect_uri' => $redirectUri,
                        'grant_type' => 'authorization_code'
                    ]
                ]);

                $accessToken = json_decode($res->getBody());
                $access_token = $accessToken->access_token;

                $res = $client->get('https://api.xero.com/connections', [
                    'headers' => [
                        'Authorization' => "Bearer " . $access_token,
                        'Content-Type' => 'application/json'
                    ]
                ]);

                $tenants = json_decode($res->getBody());
                // dd($tenants, $accessToken);

                // Save my token, expiration and tenant_id
                $storage->setToken(
                    $access_token,
                    $accessToken->expires_in,
                    $tenants[0]->tenantId,  
                    $accessToken->refresh_token,
                    $accessToken->id_token
                );
    
                return [$tenants, $accessToken];
        
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                dd($e);
                // Failed to get the access token or user details.
                return false;
            }
        }
    }

    public function trello() {
        $token = $_GET['oauth_token'];
        $verifier = $_GET['oauth_verifier'];
        $appName = getenv('APP_NAME');
        $scope = getenv('TRELLO_SCOPE');
        $expiration = getenv('TRELLO_EXPIRATION');
        $key = getenv('TRELLO_API_KEY');
        $secret = getenv('TRELLO_API_SECRET');
        $redirectUri = getenv('TRELLO_REDIRECT_URI');
        
        $client = new \Stevenmaguire\Services\Trello\Client(array(
                'key' => $key,
                'secret' => $secret,
        ));

        $config = array(
                'name' => $appName,
                'callbackUrl' => $redirectUri,
                'expiration' => $expiration,
                'scope' => $scope,
        );

        $temporaryCredentials = unserialize($_SESSION['Stevenmaguire\Services\Trello\Authorization:temporary_credentials']);
        
        $credentials = $client->getAccessToken($token, $verifier, $temporaryCredentials);
        $accessToken = $credentials->getIdentifier();
        $secret = $credentials->getSecret();

        $client->addConfig('token', $accessToken);

        $user = $client->getCurrentUser();

        if ($accessToken)
            return [$accessToken, $user, $secret];
        else return 'failed';

    }

    public function google () {
		$client = new \Google_Client();
        $token = $_GET['code'];
        // dd($token);
        $redirectUri = getenv('GOOGLE_REDIRECT_URI');
        // $client->setAuthConfig('client_secret.json');
        // $client->addScope(\Google_Service_Drive::DRIVE_METADATA_READONLY);
        // $client->setAccessType('offline');        // offline access
		// $client->setIncludeGrantedScopes(true);   // incremental auth
        // $client->setRedirectUri($redirectUri);
        // $client->fetchAccessTokenWithAuthCode($token);
        $client->setAuthConfig('client_secret.json');
        $client->setAccessType('offline');        // offline acces
			
        $client->setApplicationName('EchoVCPlex');
        $client->setScopes(\Google_Service_Sheets::SPREADSHEETS_READONLY, \Google_Service_Drive::DRIVE_METADATA_READONLY);
        $client->setPrompt('select_account consent');
        $client->fetchAccessTokenWithAuthCode($token);
        $access_token = $client->getAccessToken();

        // $files = $service->files->listFiles($parameters);

        // $oauth2 = new \Google_Service_Oauth2($client);
        // $userInfo = $oauth2->userinfo->get();

        // dd($access_token); 

        if($access_token) return $access_token;

        return 'failed';
    }
}
?>
