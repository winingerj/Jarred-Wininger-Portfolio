<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
 use Request;
 use DateTime;
use Auth;
use DB;
use App\Provider;
use App\User;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
         $this->middleware('role:GA', ['only' => ['userList', 'userDetails','editUser']]);
         $this->middleware('role:admin', ['only' => ['addUser']]);
         $this->middleware('role:superAdmin', ['only' => [ ]]);
    }

    public function userList()
    {
        $users = User::all();
        return view('user.list', compact('users'));
    }

    public function userDetails($userID)
    {
        $user = User::find($userID);
        if($user !== null)
        {
            $user = User::find($userID);
            return view('user.details', compact('user'));
        }
        else
        {
             $message = "404 - Page not found"; 
             return view('message', compact('message'));
             //abort(404, 'Page not found');
        }
    }

     public function storeUser()
     {
         //store fields from form
         $username = Request::get('username');
         $firstname = Request::get('firstname');
         $lastname = Request::get('lastname');
         $level = Request::get('level');
         $password = 'password';
         $created = new DateTime();    
 
         //add user to database with default password
             DB::table('users')->insert([
             'name' => $firstname ." ". $lastname,
             'email' => $username,
             'password' => '$2y$10$wOzsEp8QQNUc/lru8xZyne7YL9M9TzYAm.gvRRGqy9xL7FuC.WFL2',
 		    'role' => $level,
             'created_at' => $created,
              'updated_at' => $created
              ]);
 
         //redirect to user list 
         $users = User::all();
         return view('user.list', compact('users'));
         
 
     }

    public function addUser()
    {
        return view('user.add');
    }

    public function editUser($userID)
    {
        $role= Auth::user()->role;
        $user = User::find($userID);
        
        if($user !== null && $user->role > $role)
        {
                return view('user.edit', compact('user'));
        }
        else
        {
             $message = "404 - Page not found"; 
             return view('message', compact('message'));
             //abort(404, 'Page not found');
        }
    }

    
    public function updateUser($userID)
    {
        //check button
        if(Input::get('save'))
        {
            //store fields from form
            $name = Request::get('name');
            $email = Request::get('email');
            $user = User::find($userID);
     
            //update information
            $user->email = $email;
            $user->name = $name;
            $user->save();

            //return users list
            $users=User::all();
             return view('user.list', compact('users'));

        }
        elseif(Input::get('delete'))
        {
            //if delete button, pass ID to delete function
            $this->deleteUser($userID);
            //return users list
            $users=User::all();
             return view('user.list', compact('users'));
        }
        else 
        {
            //if cancel button selected, return users list
            $users = User::all();
            return view('user.list', compact('users'));
        }
      
       
    }

    public function deleteUser($userID)
    {
        //retrieve user using ID
        $user = User::find($userID);
        //delete user
        $user->delete();

        
    }

}
