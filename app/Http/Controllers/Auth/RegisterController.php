<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;
use Avatar;
use Storage;
use App\Company;
use Auth;
use Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    // public function redirectTo()
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
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create( array $data)
    {



        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'avatar' => 'avatar.png',
            'type'=>'client', 
            'permission'  => 'admin',
            // 'password' => Hash::make($data['password']),
            'password' => $data['password'],
        ]);

         $avatar = Avatar::create($data['fname'] .''. $data['lname'])->getImageObject()->encode('png');
        Storage::put('/public/avatars/'.$user->id.'/avatar.png', (string) $avatar);

        return $user;
    }
}
