<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;

class SocialController extends Controller
{
        public function redirect($provider)
        {
            return Socialite::driver($provider)->redirect();
        }
        
        public function callback($provider)
        {
                
            $getInfo = Socialite::driver($provider)->user();
            
            $user = $this->createUser($getInfo,$provider);
        
            // auth()->login($user);
        
            return redirect()->back();
        
        }



        function createUser($getInfo,$provider){
        
            $auth_user = User::where('id', Auth::user()->id)->first();
            

            if($auth_user)
            {
                $user = User::updateOrCreate(['email' => $auth_user->email],
                ['access_token' => $getInfo->token, 
                'refresh_token'=> $getInfo->refreshToken, 
                'expires_in'=> $getInfo->expiresIn]);
            }
            return $user;
        }
}
