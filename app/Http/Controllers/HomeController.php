<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

//        if (Auth::user()->role==1 && Auth::user()->role!=2){
//            return view('font.home.home-content');
//        }else{
//            return view('admin.dashboard.dashboard-content');
//        }
    }

}
