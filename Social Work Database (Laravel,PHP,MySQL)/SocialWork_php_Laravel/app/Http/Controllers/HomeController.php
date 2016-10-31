<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Provider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //this feel slightly ridiculous, yet somehow more correct.
        $this->middleware('role:worker', ['only' => ['index', 'welcome', 'cart']]);
        $this->middleware('role:GA', ['only' => 'notifications']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function welcome()
    {
        return view('home');
    }
    public function cart()
    {
        return view('cart');
    }
    public function notifications()
    {
        $providers = Provider::where('flag_out_of_date', '=', 1)->get();
        return view('notifications', compact('providers'));
    }
}
