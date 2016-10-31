<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use App\Provider;
use App\User;

use App\Http\Requests;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:worker', ['only' => ['providerList', 'providerDetails']]);
        $this->middleware('role:GA', ['only' => ['addProvider', 'storeProvider', 'editProvider']]);
    }

    public function providerList()
    {
        $providers = Provider::all();
        return view('provider.list', compact('providers'));
    }

    public function providerDetails($providerID)
    {
        $provider = Provider::find($providerID);
        if($provider !== null)
        {
            return view('provider.details', compact('provider'));
        }
        else
        {
             $message = "404 - Page not found"; 
             return view('message', compact('message'));
             //abort(404, 'Page not found');
        }
    }

    public function addProvider()
    {
        return view('provider.add');
    }

    public function storeProvider(Request $request)
    {
        //$provider = new Provider;
        //$provider->name = $request->name;

         $provider = new Provider;
         $provider->name = $request->name;
         $provider->street = $request->street;
         $provider->city = $request->city;
         $provider->county = $request->county;
         $provider->zip = $request->zip;
         $provider->state = $request->state;
         $provider->phone = $request->phone;
         $provider->email = $request->email;
         $provider->web = $request->web;
         $provider->contact_f_name = $request->contact_f_name;
         $provider->contact_l_name = $request->contact_l_name;
         $provider->location = $request->location;
         $provider->population = $request->population;
         $provider->office_hours = $request->office_hours;
         $provider->description = $request->description;
         $provider->feed = $request->feed;
         $provider->save();
 
         $message = "Provider added"; 
         return view('message', compact('message'));
    }

    public function editProvider($providerID)
    {
        $provider = Provider::find($providerID);
        if($provider !== null)
        {
            return view('provider.edit', compact('providerID'));
        }
        else
        {
             $message = "404 - Page not found"; 
             return view('message', compact('message'));
             //abort(404, 'Page not found');
        }
    }
}
