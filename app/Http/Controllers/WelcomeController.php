<?php

namespace App\Http\Controllers;

use App\AboutContent;
use App\Event;
use App\LoanApplication;
use App\SavingsAccountInfo;
use App\Slide;
use App\StaffInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function viewHome(){
        $slider=Slide::where('status',1)->limit(3)->orderBy('id','desc' )->get();
        $teamMembers=DB::table('staff_infos')
            ->join('users','users.id','=','staff_infos.user_id')
            ->join('roles','roles.id','=','users.role')
            ->select('roles.role','users.name','staff_infos.*')
            ->where('staff_infos.status','=',1)
            ->get();
        $locale = App::getLocale();
        $events=Event::where('status',0)->limit(3)->get();
        $LatestEvents=Event::where('status',0)->latest()->first();
        $about=AboutContent::where('status',1)->first();
        $numberOfLoans=LoanApplication::where('status','!=',-1)->count();
        $numberOfsavings=SavingsAccountInfo::count();
        $numberOfusers=User::count();
        return view('front.Home.home-page',['slider'=>$slider,'about'=>$about,'teamMembers'=>$teamMembers,'events'=>$events,'LatestEvents'=>$LatestEvents,'numberOfLoans'=>$numberOfLoans,'numberOfsavings'=>$numberOfsavings,'numberOfusers'=>$numberOfusers]);
    }
    public function viewAbout(){
        $about=AboutContent::where('status',1)->first();
        return view('front.About.about-page',['about'=>$about]);
    }
    public function viewContact(){
        return view('front.Contact.contact-us');
    }
    public function viewEvent(){
        $events=Event::where('status',0)->orderBy('id', 'desc')->get();
         return view('front.Event.event',['events'=>$events]);
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
