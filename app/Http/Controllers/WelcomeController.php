<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function viewHome(){
        return view('front.home.home-page');
    }
    public function viewAbout(){
        return view('front.About.about-page');
    }
    public function viewContact(){
        return view('front.Contact.contact-us');
    }
    public function viewPolicy(){
        return view('front.policy.policy-page');
    }
    public function getUpazilla(Request $request){
        $id=$request->id;
        $getUpazila=DB::table('upazilas')
            ->select('*')
            ->where('district_id','=',$id)
            ->get();
        return response(json_encode($getUpazila));
    }
    public function getpermanentUpazilla(Request $request){
        $id=$request->id;
        $getUpazila=DB::table('upazilas')
            ->select('*')
            ->where('district_id','=',$id)
            ->get();
        return response(json_encode($getUpazila));
    }
    public function UpazilaNameById(Request $request){
        $id=$request->id;
        $getUpazila=DB::table('upazilas')
            ->select('*')
            ->where('id','=',$id)
            ->get();
        return response(json_encode($getUpazila));
    }
}
