<?php

namespace App\Http\Controllers;

use App\Invitation;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteMail;
use App\User;
use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Services\Report;

class InvitationsController extends Controller
{
     // Store our neccesity in variables
     public  $permissions = ['admin' =>'Admin', 'edit' =>'Edit', 'view' => 'View'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permissions;
        $user = Auth::user();
        
        if($user && $user->permission != 'admin' && $user->id != 1)
        {
            abort(404);
        }
        
        
        $invites = Invitation::where('registered_at',null)->get();
        // $users =  User::where('id','!=', 1)->get();
        $new_submissions = Report::newSubmissions();
        return view('account_settings.permissions', compact('invites','permissions', 'new_submissions'));

        // return view('invites.new_user');
    }

    public function sendinvite(Request $request)
    {
        $user = Auth::user();
        if($user->permission != 'admin' && $user->id != 1)
        {
            return redirect()->back()->with('error', 'Permission denied'); 
        }
       
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:invitations',
            'permission'  =>  'required|string',
        ]);
       
        if ($validator->fails()) 
        {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $u = User::where('email',$request->email)->first();
        if($u)
        {
            return redirect()->back()->with('error', 'There is a user registered with <strong>'.$request->email.'</strong>'); 
        }
    
    
    
        $invite = new Invitation();
        $invite->permission = $request->permission;
        $invite->email = $request->email;
        $invite->user_id = Auth::user()->id;
        $invite->invitation_token = str_random(32);
        $invite->save();
    
        
        Mail::to($invite->email)->send(new InviteMail($invite));
    
    
        //    dd('mail sent');
    
    
           return redirect()->back()->with('success', 'Invitation have been sent'); 
    
    
    
    
    }
    

    public function roleview($id)
    {
        $user = Auth::user();
        if($user && $user->permission != 'admin')
        {
            return redirect()->back()->with('error', 'Permission denied'); 
        }
        $invite = Invitation::where('id', $id)->FirstOrFail();
        $invite->permission = 'view';
        $invite->save();
        return redirect()->back()->with('success', 'Invitated user permission changed'); 
    }

    public function roleedit($id)
    {
        $user = Auth::user();
        if($user && $user->permission != 'admin')
        {
            return redirect()->back()->with('error', 'Permission denied'); 
        }
        $invite = Invitation::where('id', $id)->FirstOrFail();
        $invite->permission = 'edit';
        $invite->save();
        return redirect()->back()->with('success', 'Invitated user permission changed'); 
    }


    public function roleadmin($id)
    {
        $user = Auth::user();
        if($user && $user->permission != 'admin')
        {
            return redirect()->back()->with('error', 'Permission denied'); 
        }
        $invite = Invitation::where('id', $id)->FirstOrFail();
        $invite->permission = 'admin';
        $invite->save();
        return redirect()->back()->with('success', 'Invitated user permission changed'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invitations  $invitations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if($user && $user->permission != 'admin')
        {
            return redirect()->back()->with('error', 'Permission denied'); 
        }
        $invite = Invitation::where('id', $id)->FirstOrFail();
        $invite->delete();
        return redirect()->back()->with('success', 'Invitation have been revoked'); 
    }
}
