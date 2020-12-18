<?php

return [
    /*
    |----------------------------------------------------------------------------
    | Google application name
    |----------------------------------------------------------------------------
    */
    'application_name' => env('GOOGLE_APPLICATION_NAME', ''),

    /*
    |----------------------------------------------------------------------------
    | Google OAuth 2.0 access
    |----------------------------------------------------------------------------
    |
    | Keys for OAuth 2.0 access, see the API console at
    | https://developers.google.com/console
    |
    */
    'client_id' => env('GOOGLE_CLIENT_ID', '697206933855-phm86h18k52ekv51te6qsf26bg16o0c3.apps.googleusercontent.com'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET', 'rf-Jhxnebl23g6wboVMmdz9Z'),
    'redirect_uri' => env('GOOGLE_REDIRECT', ''),
    'scopes'           => [\Google_Service_Sheets::DRIVE, \Google_Service_Sheets::SPREADSHEETS],
    // 'access_type'      => 'online',
    // 'approval_prompt'  => 'auto',
    // 'prompt'           => 'consent', //"none", "consent", "select_account" default:none
    'access_type'      => 'offline',
    'approval_prompt'  => 'force',
    'prompt'           => 'consent',

    /*
    |----------------------------------------------------------------------------
    | Google developer key
    |----------------------------------------------------------------------------
    |
    | Simple API access key, also from the API console. Ensure you get
    | a Server key, and not a Browser key.
    |
    */
    'developer_key' => env('GOOGLE_DEVELOPER_KEY', ''),

    /*
    |----------------------------------------------------------------------------
    | Google service account
    |----------------------------------------------------------------------------
    |
    | Set the credentials JSON's location to use assert credentials, otherwise
    | app engine or compute engine will be used.
    |
    */
    'service' => [
        /*
        | Enable service account auth or not.
        */
        'enable' => env('GOOGLE_SERVICE_ENABLED', false),
        // 'enable'  => env('GOOGLE_SERVICE_ENABLED', true),

        /*
        | Path to service account json file
        */
        // 'file' => env('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION', ''),
        // 'file'    => storage_path('metrics.json'),
        'file'   => env('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION', storage_path('sheets-service-account.json')),
    ],

    /*
    |----------------------------------------------------------------------------
    | Additional config for the Google Client
    |----------------------------------------------------------------------------
    |
    | Set any additional config variables supported by the Google Client
    | Details can be found here:
    | https://github.com/google/google-api-php-client/blob/master/src/Google/Client.php
    |
    | NOTE: If client id is specified here, it will get over written by the one above.
    |
    */
    'config' => [],
];
