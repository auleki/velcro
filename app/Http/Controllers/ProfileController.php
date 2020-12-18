<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Hash;
use App\Services\Report;

class ProfileController extends Controller
{
    public function profileindex()
    {
		// $user = User::whereId(Auth::user()->id)->first();
    	   if (Auth::check())
			    {
        $new_submissions = Report::newSubmissions();
					
					 return view('account_settings.profile', compact('new_submissions'))->with('user',Auth::user());
					//  return view('account_settings.profile', ['user' => $user]);
			        // return View::make('profile')->with('user',Auth::user());
			    }
			    else
			    {
			        return Redirect::to('login')->with('login_error','You must login first.');
			    }
    }



     public function profileupdate(Request $request)
     {



     	if($request->has('fname') || $request->has('lname') || $request->has('phone_no'))
     	{
     		//this is for updating the users name and phone number
     		$validator = Validator::make($request->all(), [
	            'fname' => ['required', 'string', 'max:255'],
	            'lname' => ['required', 'string', 'max:255'],
	            'phone_no' => ['nullable','numeric']
	            ],
	             [
	                    'fname.required' => 'Your firstname is required',
	                    'fname.max' => 'Your name can not exceed 255 character limit',
	                    'lname.required' => 'Your last name is required',
	                    'lname.max' => 'Your last name can not exceed 255 character limit', 
	                    'phone_no.numeric'  => 'You can add only number'
	             ]
	         );
     	}


     // 	if($request->has('change-email'))
    	// {

    	// 	$validator = Validator::make($request->all(), [
     //        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
     //        ]);
    	// }


     	if($request->has('change-email'))
     	{

     		$validator = Validator::make($request->all(), [
	            'fname' => ['required', 'string', 'max:255'],
	            'lname' => ['required', 'string', 'max:255'],
	             'phone_no' => ['nullable','numeric'],
	            'email' => ['required','email', 'string', 'max:255', 'unique:users'],
	            ],
	             [
	                    'fname.required' => 'Your firstname is required',
	                    'fname.max' => 'Your name can not exceed 255 character limit',
	                    'lname.required' => 'Your last name is required',
	                    'lname.max' => 'Your last name can not exceed 255 character limit',     
	                    'phone_no.numeric'  => 'You can add only number'  
	             ]
	         );
     	}



     	if($request->has('change-password'))
     	{

	     	if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {

	     		 toast('Your current password does not matches with the password you provided.','error');
						// The passwords matches
						return redirect()->back();
	            
	      }
				if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
						//Current password and new password are same
					toast('New Password cannot be same as your current password.','error');

						// return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
				}
     	}

				 // dd($request->new_password);
				 
			$validator = Validator::make($request->all(), [
	            'fname' => ['required', 'string', 'max:255'],
	            'lname' => ['required', 'string', 'max:255'],
	            // 'email' => ['email', 'string', 'max:255', 'unique:users'],
	            'email' => ['email', 'string', 'max:255'],	        
	            'phone_no' => ['nullable','numeric'],    
	            'current-password' => 'required',
                // 'new_password' => 'required|string|min:8|confirmed',
                'new_password' => 'required|string|min:8',

	            ],
	             [
	                    'fname.required' => 'Your firstname is required',
	                    'fname.max' => 'Your name can not exceed 255 character limit',
	                    'lname.required' => 'Your last name is required',
	                    'lname.max' => 'Your last name can not exceed 255 character limit',       
	                    'current-password.required' => 'Your current password is required',
	                    'new_password.required' => 'Your new password is required',
	                    'new_password.min' => 'Your new password must be up to 8 characters',
	                    'phone_no.numeric'  => 'You can add only number'  ,
	                    // 'new_password.confirmed' => 'Your new password does not match',             
	             ]
	         );


     			if ($validator->fails()) 
	            {
	            
	                toast($validator->messages()->first(),'error');
	               return redirect()->back();
	            }

	            else
	            {

		            $user = User::where('id',Auth::id())->first();
			    	$user->fname = $request->fname;
			    	$user->lname = $request->lname;
			    	$user->phone_no = $request->phone_no;
			    	if( $request->has('change-email'))
			    	{
			    	$user->email = $request->email;	
			    	}

			    	if( $request->has('change-password'))
			    	{
			    	$user->password = $request->new_password;	
			    	}

			    	if($user->update())
			    	{
			    		 toast('Account have been updated','success');
			    		  return redirect()->back();
			    	}	

	            }
    	

    	






     }




    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = Validator::make($request->all(),[
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

         if ($validatedData->fails()) 
            {
                Session::flash('error', $validatedData->messages()->first());
                toast($validatedData->messages()->first(),'error');
               return redirect()->back();
            }

        //Change Password
        $user = Auth::user();
        $user->password = $request->get('new-password');
        if($user->save())
	        {
	           toast('Password changed successfully !','success');
	        }
        return redirect()->back();
    }


    public function ajaximage(Request $request)
    {
    	$validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );

           
            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $file = $request->file('file');


            $user = User::where('id',Auth::id())->first();

            $old_filename = '/public/avatars/' . $user->id . '/' . $user->avatar;
            $new_filename = '/public/avatars/' .  $user->id  . '/' . $filename;
            // Storage::putFileAs('/public/avatars/' . $user->id . '/', $file,  $filename);

            if (Storage::disk('local')->exists($old_filename)) 
            {
            	Storage::disk('local')->delete($old_filename);
            	if(Storage::putFileAs('avatars/' . $user->id . '/', $file,  $filename))
            	{
                 $user->avatar = $filename;
                 $user->save();
                 // Alert::toast('Success Title', 'Success');
                 return $filename;
                }
            
			}
			
			else
			{
				Storage::putFileAs('avatars/' . $user->id . '/', $file,  $filename);
				$user->avatar = $filename;
				$user->save();

				return $filename;
			}
           
    }


}
