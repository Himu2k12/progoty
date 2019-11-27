<?php

namespace App\Http\Controllers;

use App\LoanApplication;
use App\SavingsAccountInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index(){
        $accountNumber=DB::table('savings_account_infos')
            ->select('id','applicant_name')
            ->where('field_man_id','=',Auth::user()->id)
            ->where('verify','=',1)
            ->get();
        //dd($accountNumber);
        return view('front.Loan.loan-form',['accountNumber'=>$accountNumber]);
    }
    public function NomineeInfo(Request $request){
        $me=$request->aid;
        $int = (int)$me;
        $nomineeInfo['amount']=DB::table('saving_amounts')
            ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
            ->where('saving_amounts.member_id','=',$int)
            ->where('savings_account_infos.verify','=',1)
            ->sum('saving_amounts.amount');
        $nomineeInfo['name']=DB::table('savings_account_infos')
            ->select('applicant_name')
            ->where('id',$int)
            ->first();
        return response(($nomineeInfo));
    }
    public function createLoan(Request $request){
        $request->flush();
        $this->validate($request, [
            'account_no'=>'required',
            'loan_amount'=>'required|numeric',
            'application_date'=>'required',
            'present_district'=>'required',
            'present_thana'=>'required',
            'present_post_code'=>'required',
            'present_village'=>'required',
            'mobile_one'=>'required',
            'nominee_account_1'=>'required',
            'nominee_account_2'=>'required',
            ]);
        $newLoan= new LoanApplication();
        $newLoan->account_no=$request->account_no;
        $newLoan->loan_amount=$request->loan_amount;
        $newLoan->application_date=$request->application_date;
        $newLoan->present_district=$request->present_district;
        $newLoan->present_thana=$request->present_thana;
        $newLoan->present_post_code=$request->present_post_code;
        $newLoan->present_village=$request->present_village;
        $newLoan->mobile_one=$request->mobile_one;
        $newLoan->nominee_account_1=$request->nominee_account_1;
        $newLoan->nominee_account_2=$request->nominee_account_2;
        $newLoan->field_officer_id=Auth::user()->id;
        $newLoan->save();

return back()->with('mass','Loan Application submitted Successfully!');
    }
}
