<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Company;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    //  public function redirectTo()
    // {
    //     $loguser = Auth::user();
    //     $company = Company::where('user_id', $loguser->id)->first();

    //    if($loguser->type == 'client' && !is_null($company))
    //             {
    //                 return redirect()->to($company->uuid.'/home');
    //             }

    //             if($loguser->type == 'client' && is_null($company))
    //             {
    //                 return redirect()->to('/add_company');
    //             }


    //             if($loguser->type == 'echovc' )
    //             {
    //                 return redirect()->to('/home');
    //             }
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }

    public function logout()
    {
        Auth::Logout();
        Session::flush();
        return redirect('/');
    }
}
