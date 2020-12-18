<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;

class AuthController extends Controller
{

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($token)
    {
        $invite = Invitation::where('invitation_token',$token)->first();
        if(!$invite)
        {
            abort(404); 
        }

        if($invite->registered_at != null )
        {
            abort(404); 
        }
        // return view('admin.register');
        return view('auth.register', compact('invite'));
    }


      /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request, $token)
    {
        $this->validator($request->all())->validate();

        $invite = Invitation::where('invitation_token',$token)->first();
        if(!$invite)
        {
            return redirect()->back()->with('error', 'Link does not exist or it is expired'); 
        }

        if(!$invite->registered_at == null)
        {
            return redirect()->back()->with('error', 'Link does not exist or it is expired'); 
        }
        $user = User::where('email',$invite->email)->first();

        if($user){
            return redirect()->back()->with('error', 'Account exist');
        }
        else
        {
            // dd($invite);
                $nuser = new User();
                $nuser->fname = $request->fname;
                $nuser->lname = $request->lname;
                $nuser->permission = $invite->permission;
                $nuser->email = $invite->email;
                $nuser->password = Hash::make($request->password);

                //  User::create([
                //     'name' => $request->name,
                //     'email' => $invite->email,
                //     'role' => $invite->role,
                //     'password' => Hash::make($request->password),
                // ]);

              if($nuser->save())
              {
                $this->guard()->login($nuser);
                $invite->registered_at = Carbon::now();
                $invite->save();
                return redirect()->to('/profile');
              }
            
        }
      

    }


    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

   
    
}
