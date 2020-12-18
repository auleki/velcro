<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Redirect;
use Validator;
use Auth;

class UserController extends Controller
{
    // ********Access control for Reports********
    public function __construct()
    {
        $this->middleware('auth');
    }

    Public function index()
    {
        // Return a view here
        Users::paginate(5);
        return view('string');
        
    }


    public function roleview($id)
    {
        $user = Auth::user();
        if($user && $user->permission != 'admin')
        {
            return redirect()->back()->with('error', 'Permission denied'); 
        }
        $invite = User::where('id', $id)->FirstOrFail();
        $invite->permission = 'view';
        $invite->save();
        return redirect()->back()->with('success', 'User permission changed'); 
    }

    public function roleedit($id)
    {
        $user = Auth::user();
        if($user && $user->permission != 'admin')
        {
            return redirect()->back()->with('error', 'Permission denied'); 
        }
        $invite = User::where('id', $id)->FirstOrFail();
        $invite->permission = 'edit';
        $invite->save();
        return redirect()->back()->with('success', 'User permission changed'); 
    }


    public function roleadmin($id)
    {
        $user = Auth::user();
        if($user && $user->permission != 'admin')
        {
            return redirect()->back()->with('error', 'Permission denied'); 
        }
        $invite = User::where('id', $id)->FirstOrFail();
        $invite->permission = 'admin';
        $invite->save();
        return redirect()->back()->with('success', 'User permission changed'); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $Users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if($user && $user->permission != 'admin')
        {
            return redirect()->back()->with('error', 'Permission denied'); 
        }
        $user = User::where('id', $id)->FirstOrFail();
        $user->delete();
        return redirect()->back()->with('success', 'User have been deleted'); 
    }
}


