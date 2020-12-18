<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/delete_tools', 'ProvidedMetricController@delete');

Route::get('/connect', 'ConnectController@index');
Route::get('/callback', 'ConnectController@callback');
Route::get('/report/view-report/{id}', 'ComposeMailController@viewReport');
Route::post('/report/fill-report/{id}', 'ComposeMailController@fillReport');
Route::get('play/{id}', 'ComposeMailController@play');

Route::group(['middleware' => ['auth', 'new_report']], function () {
    Route::get('/home', 'HomeController@welcome');
    Route::get('/share_welcome_page', function () { return view('home.share_welcome_page'); });
    // Route::get('/files', function () { return view('files.files'); });
    Route::get('/file_upload', function () { return view('files.file_upload'); });
    Route::get('/archives', 'ArchivesController@index');
    // Route::livewire('/archives', 'archives')->layout('archives.archivelist')->section('body');

    Route::get('/google/connect', 'ConnectController@googleConnect');

    Route::post('/delete/archives', 'ArchivesController@delete');
    Route::post('/restore/archives', 'ArchivesController@restore');
    Route::get('/provided_metric', function () { return view('metrics.provided_metric'); });

    //company routing
    Route::get('/dashboard', 'HomeController@index');
    Route::post('/create-dashboard', 'HomeController@createDashboard');
    Route::get('/funding', function () { return view('portfolio_company.funding'); });
    // Route::get('/dashboard1', function () { return view('home.dashboard1'); });
    // Route::get('/backup', function () { return view('backup'); });
    Route::get('/add_chart/{dashboard}', 'MetricsController@addChart');
    Route::get('/charts/delete/{id}', 'HomeController@deleteChart');
    Route::get('/dashboards/delete/{id}', 'HomeController@deleteDashboard');
    //end get method for company routing

    // Investor Relations
    Route::get('/investors', 'InvestorsController@index');
    Route::post('/investors', 'InvestorsController@store');
    Route::post('/investors/{id}', 'InvestorsController@update');

    Route::get('/test', function () { return view('home.welcome'); });
    Route::get('/test_sent', function () { return view('reports.sent_reports'); });
    // Route::get('/profile', function () { return view('account_settings.profile'); });
    // Route::get('/permissions', function () { return view('account_settings.permissions'); });
    Route::get('/new_user', function () { return view('invites.new_user'); });
    Route::get('/new_user', function () { return view('invites.new_user'); });
    Route::get('/single', function () { return view('portfolio_company.single_company'); });
    Route::get('/email_invite', function () { return view('email.email_invite'); });
    Route::get('/investor_update', function () { return view('email.investor_update'); });
    Route::get('/new_report', function () { return view('reports.new_report'); });
    Route::get('/integrations', function () { return view('account_settings.integrations'); });
    Route::get('/authorize_twitter', function () { return view('account_settings.authorize_twitter'); });
    Route::get('/investor_report', function () { return view('email.investor_report'); });
    Route::get('/investor_update', function () { return view('email.investor_update'); });
    Route::get('/scheduled_event', function () { return view('reports.schedule_event'); });
    Route::get('/recurring_event', function () { return view('reports.recurring_event'); });
    Route::get('/report_recipient', function () { return view('reports.report_recipient'); });


    //route for company
    Route::get('/add_company', 'CompanyController@create')->name('create.company');
    Route::get('/company_list', 'CompanyController@index');
    Route::post('/add_company', 'CompanyController@store')->name('store.company');
    Route::get('/single_company/{id}', 'CompanyController@viewSingleCompany');
    Route::get('/new_company', 'CompanyController@newCompany');
    Route::post('/portfolio-company/{id}', 'CompanyController@updateCompany');
    Route::get('/company/remove-contact/{id}', 'CompanyController@deleteContact');
    Route::get('/fetch-company-kpis/{id}', 'MetricsController@fetchKPI');
    Route::get('/company/remove-compared/{id}', 'CompanyController@removeCompared');
    Route::post('/company/add-chart/{id}', 'CompanyController@addPerformanceChart');
    Route::post('/company/send-note/{id}', 'CompanyController@sendNote');
    Route::post('add-round/{id}', 'CompanyController@addRound');
    Route::post('/company-fund/update/{id}', 'CompanyController@updateFund');
    Route::get('/company/exit/{id}', 'CompanyController@exit');
    Route::post('/update-company-data/{id}', 'CompanyController@update');
    Route::post('/archive-company/{id}', 'CompanyController@archive');
    Route::post('/update-fund-tag/{id}', 'TagsController@store');


    Route::get('/screenshot', 'ScreenShotController@index');
    Route::post('/share/{id}', 'ScreenShotController@snapshot');

    //Route for Contacts
    Route::resource('contacts', 'ContactsController');
    Route::delete('contacts', ['as'=>'contact.multiple-delete','uses'=>'ContactsController@deleteMultiple']);


    //Route for Metrics
    Route::resource('metrics', 'MetricsController');
    Route::get('selected-metric/{tool_id}', 'ProvidedMetricController@index');
    Route::get('metrics_display', 'MetricsController@build');
    Route::get('metrics_sheets', 'MetricsController@sheets');
    Route::get('metrics_spreadsheets', 'MetricsController@spreadsheets');
    Route::get('metrics_kpi/{id}', 'MetricsController@metricsKpi');
    Route::get('metrics_single_kpi/{id}', 'MetricsController@metricsSingleKpi');
    Route::delete('metrics_sheets', ['as'=>'metrics.multiple-delete','uses'=>'MetricsController@deleteMultipleMetrics']);
    Route::get('/add_metrics', 'MetricsController@addMetrics');
    Route::get('/add_fund_metrics', 'MetricsController@addFundMetrics');
    Route::post('/submit/spreadsheet', 'MetricsController@submitSheet');
    Route::get('/fetch-sheets/{spreadsheetId}', 'ProvidedMetricController@fetchSheets');
    Route::post('/fetch-sheet-data/{toolId}', 'ProvidedMetricController@fetchSheetData');
    Route::get('select-metric-data', 'ProvidedMetricController@fetchMetricData');
    Route::get('fetch-sheet-data/{sheetId}', 'ProvidedMetricController@getSheetData');

    Route::get('/profile', 'ProfileController@profileindex');
    Route::post('ajax-profile-upload', 'ProfileController@ajaxImage');
    Route::post('/profile', 'ProfileController@profileupdate');
    Route::get('/files', 'FileController@index')->name('file.index');
    Route::post('/file/upload', 'FileController@store')->name('file.upload');
    Route::post('/file/share/{id}', 'FileController@share')->name('file.share');
    Route::post('/delete/file', 'FileController@deleteall')->name('file.deleteall');
    Route::get('/search/users','FileController@usersearch')->name('users.search');
    Route::get('/search/files','FileController@filesearch')->name('files.search');
    Route::post('/cfile/{id}','FileController@sharetocompany')->name('file.cfile');
    Route::post('/cfile/url/{id}','FileController@urlcompany')->name('url.cfile');
    Route::post('/cfile/upload/{id}','FileController@uploadfilecompany')->name('fileupload.cfile');

    //****Importing and Exporting Excel sheets
    Route::get('import-export', 'MetricsController@importExport');
    Route::post('import', 'MetricsController@saveExcel')->name('import');
    Route::get('export', 'MetricsController@export');
    Route::get('user_provided_sheets', 'MetricsController@userProvidedSheets');
    Route::get('excel_sheets/{id}', 'MetricsController@getExcelSheets');
    Route::get('excel/sheet/{name}', 'MetricsController@getExcelSheetMetrics');
    Route::get('excel/metrics_single_kpi/{kpi}', 'MetricsController@getMetricKPI');



    //Route for Reports
    Route::get('/reports', 'ComposeMailController@index');
    Route::get('/received_report', 'ComposeMailController@received');
    Route::get('/sent_report', 'ComposeMailController@sent');
    Route::get('/scheduled_report', 'ComposeMailController@scheduled');
    Route::get('/sample_report', 'ComposeMailController@sample');
    Route::get('/draft_report', 'ComposeMailController@draft');
    Route::get('/reports/create', 'ComposeMailController@create');
    Route::post('/report/send', 'ComposeMailController@sendReport');
    Route::post('/report/draft', 'ComposeMailController@draftReport');
    Route::get('/report/add-emails/{id}', 'ComposeMailController@selectReceivers');
    Route::post('/report/send/{id}', 'ComposeMailController@send');
    Route::get('/received_report/{id}', 'ComposeMailController@viewReceivedReport');
    Route::get('/report/view/{type}', 'ComposeMailController@report');
    // Route::get('/downloadPDF/{type}', 'DownloadController@pdf');
    Route::get('/archive-report/{type}', 'ArchivesController@archiveReport');
    Route::get('/upload-to-cloud/{type}', 'ArchiveController@cloudUpload');
    Route::post('/report/schedule', 'ComposeMailController@scheduleReport');
    Route::get('/report/resend/{id}', 'ComposeMailController@resendReport');
    Route::get('/report/recipients/{id}', 'ComposeMailController@reportRecipients');
    Route::get('/report/tracker/{id}', 'ComposeMailController@tracker');
    // Route::get('/email', function() {
    //     return view('email.investor_report');
    // });


    //For google sheets
    Route::get('google_test', 'MetricsController');
    Route::post('post', 'PostController')->name('post.store');

    // Fund
    Route::post('funds', 'FundController@store');
    Route::post('funds/{id}', 'FundController@update');
    Route::get('/fund/remove/{id}', 'FundController@destroy');
    Route::get('/fund-chart/remove/{id}', 'FundController@removeChart');



    // Invite users
    Route::get('/permissions','InvitationsController@index');
    Route::post('/admin/send/invite','InvitationsController@sendinvite');
    Route::get('/admin/permission/admin/{id}','InvitationsController@roleadmin');
    Route::get('/admin/permission/edit/{id}','InvitationsController@roleedit');
    Route::get('/admin/permission/view/{id}','InvitationsController@roleview');
    Route::delete('/admin/invite/delete/{id}','InvitationsController@destroy');
    // End Invite User

    // Start User
    Route::get('/admin/user/permission/admin/{id}','UserController@roleadmin');
    Route::get('/admin/user/permission/edit/{id}','UserController@roleedit');
    Route::get('/admin/user/permission/view/{id}','UserController@roleview');
    Route::delete('/admin/user/delete/{id}','UserController@destroy');
    //End User

    // Backup
    Route::get('/admin/backup', 'BackupController@index');
    Route::post('/admin/backup/local/delete', 'BackupController@delete');
    Route::get('/admin/backup/local', 'BackupController@local');
    Route::get('/admin/backup/create', 'BackupController@create');
    Route::post('/admin/backup/save', 'BackupController@setting');
    Route::get('/admin/backup/status', 'BackupController@statuschange');


    Route::get('/logout','Auth\LoginController@logout');
    Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('/callback/{provider}', 'SocialController@callback');


});
    Route::middleware('guest')->group(function () {
        Route::get('/signup/{token}', 'AuthController@showRegistrationForm');
        Route::post('/signup/{token}', 'AuthController@register');
        // Route::get('/', function () { return view('landing'); });
        Route::get('/', function () { return view('auth.login'); });
    });
    Auth::routes(['register' => false]);
