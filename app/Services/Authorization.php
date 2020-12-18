<?php

namespace App\Services;

use App\Services\StorageClass;
use App\Services\TrelloService;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

	// ini_set('display_errors', 'On');
	// require __DIR__ . '/vendor/autoload.php';
	// require_once('storage.php');
	
	class Authorization
	{
		public function xero(){
			// $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
			// $dotenv->load();

			$clientId = getenv('XERO_CLIENT_ID');
			$clientSecret = getenv('XERO_CLIENT_SECRET');
			$redirectUri = getenv('XERO_REDIRECT_URI');

			// dd($clientId, $clientSecret, $redirectUri);

			// Storage Classe uses sessions for storing access token > extend to your DB of choice
			$storage = new StorageClass();

			// session_start();

			$provider = new \League\OAuth2\Client\Provider\GenericProvider([
						'clientId'                => $clientId,   
						'clientSecret'            => $clientSecret,
						'redirectUri'             => $redirectUri,
					'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
					'urlAccessToken'          => 'https://identity.xero.com/connect/token',
					'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
			]);
				// dd($provider);
			// If we don't have an authorization code then get one
			if (!isset($_GET['code'])) {
				$options = [
						'scope' => ['openid email profile offline_access accounting.settings accounting.transactions accounting.contacts accounting.journals.read accounting.reports.read accounting.attachments']
				];

					// Fetch the authorization URL from the provider; this returns the urlAuthorize option and generates and applies any necessary parameters (e.g. state).
					$authorizationUrl = $provider->getAuthorizationUrl($options);

					// Get the state generated for you and store it to the session.
					$_SESSION['oauth2state'] = $provider->getState();

					// Store the authorization URL in session
					$_SESSION['authorizationURL'] = $authorizationUrl;
					return 'Success';

			// Check given state against previously stored one to mitigate CSRF attack
			} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
					unset($_SESSION['oauth2state']);
					return 'Invalid state';
			} else {
				return 'Failed';
			}
		}

		public function trello() {
      session_start();
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

			$client->addConfig($config);

			$authorizationUrl = $client->getAuthorizationUrl();

			// dd($authorizationUrl, $_SESSION);

			return $authorizationUrl;
			// header('Location: ' . $authorizationUrl);

		}

		public function google() {
			$redirectUri = getenv('GOOGLE_REDIRECT_URI');
			$client = new \Google_Client();
      $client->setAuthConfig('client_secret.json');
			// $client->addScope(\Google_Service_Drive::DRIVE_METADATA_READONLY);
			// $client->addScope('https://www.googleapis.com/auth/userinfo.profile');
      $client->setAccessType('offline');        // offline access
			// $client->setIncludeGrantedScopes(true);   // incremental auth
			// $client->setRedirectUri($redirectUri);
			
			$client->setApplicationName('EchoVCPlex');
			$client->setScopes(\Google_Service_Sheets::SPREADSHEETS_READONLY, \Google_Service_Drive::DRIVE_METADATA_READONLY);
			// $client->setAuthConfig('credentials.json');
			// $client->setAccessType('offline');
			$client->setPrompt('select_account consent');
			
			$auth_url = $client->createAuthUrl();

			// dd($client, $auth_url);
			
			return $auth_url;
		}
	}
?>
