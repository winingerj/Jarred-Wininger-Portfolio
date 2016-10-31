<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
 use Request;
 use DateTime;
use Auth;
use DB;
use App\Provider;
use App\User;

use App\Http\Requests;

class ProfileController extends Controller
{
    
    public function viewProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if($user !== null)
        {
            $user = User::find($id);
            return view('profile.view', compact('user'));
        }
        else
        {
             $message = "404 - Page not found"; 
             return view('message', compact('message'));
             //abort(404, 'Page not found');
        }

    }


 

    public function editProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if($user !== null)
        {
            return view('profile.edit', compact('user'));
        }
        else
        {
             $message = "404 - Page not found"; 
             return view('message', compact('message'));
             //abort(404, 'Page not found');
        }
    }

    public function updateProfile()
     {
         //store fields from form
         $email = Request::get('email');

        $id = Auth::user()->id;
        $user = User::find($id);
        $user->email = $email;
        $user->save();

        return view('profile.view',compact('user'));
         
 
     }

}
