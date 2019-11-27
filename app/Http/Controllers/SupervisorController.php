<?php

namespace App\Http\Controllers;

use App\LoanApplication;
use App\SavingsAccountInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    protected function newMembers(){

        $newMembers=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->where('savings_account_infos.verify','=',0)
            ->get();


        return view('back.Supervisor.member-list',['newMembers'=>$newMembers]);
    }
    protected function detailsView($slug){
        $viewMember=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->select('savings_account_infos.*','users.id as Sid','users.name')
            ->where('savings_account_infos.verify','=',0)
            ->where('savings_account_infos.slug','=',$slug)
            ->first();
//dd($viewMember);
        return view('back.Supervisor.details-of-members',['viewMember'=>$viewMember]);
    }
    protected function verifiedMembers(){

        $newMembers=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->where('savings_account_infos.verify','=',1)
            ->orderBy('users.id','=','desc')
            ->get();
        return view('back.Supervisor.verified-members',['newMembers'=>$newMembers]);
    }
    protected function VerifiedDetailsView($slug){
        $viewMember=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->select('savings_account_infos.*','users.id as Sid','users.name')
            ->where('savings_account_infos.verify','=',1)
            ->where('savings_account_infos.slug','=',$slug)
            ->first();
//dd($viewMember);
        return view('back.Supervisor.verified-members-details',['viewMember'=>$viewMember]);
    }
    public function confirmMember($id){
        $verifyAccount=SavingsAccountInfo::find($id);
        $verifyAccount->verify="1";
        $verifyAccount->save();
        return redirect('/new-member-requests');
    }

    public function AllDailyCollections(){
        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];


        $dailyCollectionOfAllFeildman=DB::table('saving_amounts')
            ->join('users','users.id','=','saving_amounts.field_man_id')
            ->selectRaw('SUM(amount) as sum, field_man_id,name')
            ->groupBy('saving_amounts.field_man_id','users.name')
            ->whereDate('saving_amounts.created_at','=',$today)
            ->get();
        //dd($dailyCollectionOfAllFeildman);
        return view('back.Supervisor.daily-all-savings-collections',['dailyCollectionOfAllFeildman'=>$dailyCollectionOfAllFeildman]);
    }
    public function newLoanRequest(){
        $newLoan=DB::table('loan_applications')
            ->join('users','users.id','=','loan_applications.field_officer_id')
            ->select('loan_applications.*','users.name')
            ->where('status','=',0)
            ->get();


        return view('back.Supervisor.new-loan-request',['newLoan'=>$newLoan]);
    }
    public function LoanRequestDetails($slug){
        $viewMember=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->join('loan_applications','loan_applications.account_no','=','savings_account_infos.id')
            ->select('savings_account_infos.*','users.id as Sid','users.name','loan_applications.*')
            ->where('savings_account_infos.verify','=',1)
            ->where('loan_applications.slug','=',$slug)
            ->first();
        $totalApplicantDeposite=DB::table('saving_amounts')
            ->where('member_id','=',$viewMember->account_no)
            ->sum('saving_amounts.amount');
        $nomineeTotalInfo=new LoanApplication();
        $nominee_one=$nomineeTotalInfo->NomineeTotalInfo($viewMember->nominee_account_1);
        $nominee_two=$nomineeTotalInfo->NomineeTotalInfo($viewMember->nominee_account_2);

        //dd($nominee_two);


        return view('back.Supervisor.loan-request-details',['viewMember'=>$viewMember,
                                                                    'totalApplicantDeposite'=>$totalApplicantDeposite,
                                                                    'nomineeTotalInfo'=>$nomineeTotalInfo,
                                                                    'nominee_one'=>$nominee_one,
                                                                    'nominee_two'=>$nominee_two,
        ]);
    }

}
