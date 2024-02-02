<?php

namespace App\Http\Controllers;

use App\AdditionalCollection;
use App\CollectionCategory;
use App\LoanApplication;
use App\LoanDispatch;
use App\SavingAmount;
use App\SavingsAccountInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        $completeloan=DB::table('loan_applications')
            ->select('account_no')
            ->where('field_man_id','=',Auth::user()->id)
            ->where('status','=','0')
            ->orWhere('status','=','1')
            ->orWhere('status','=','2')
            ->orWhere('status','=','3');
            

        $accountNumber=DB::table('savings_account_infos')
            ->select('id')
            ->where('field_man_id','=',Auth::user()->id)
            ->where('verify','=',1)
            ->whereNotIn('id',$completeloan)
            ->get();
        $name=new SavingsAccountInfo();
        $collectionSector=CollectionCategory::where('status',1)->get();
        //dd($accountNumber);
        return view('front.Loan.loan-form',['collectionSector'=>$collectionSector,'accountNumber'=>$accountNumber,'name'=>$name]);
    }
    public function NomineeInfo(Request $request){
        $me=$request->aid;
        $int = (int)$me;
        $nomineeInfo['amount']=DB::table('saving_amounts')
            ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
            ->where('saving_amounts.member_id','=',$int)
            ->where('savings_account_infos.verify','=',1)
            ->sum('saving_amounts.amount');
         
         $savingsWithdrawntillnow=DB::table('savings_withdraw_forms')
        ->join('savings_withdraws','savings_withdraws.request_id','=','savings_withdraw_forms.id')
        ->where('savings_withdraw_forms.account_no','=',$int)
        ->where('savings_withdraw_forms.status','=',1)
        ->where('savings_withdraws.status','=',2)
        ->select('savings_withdraw_forms.id')
        ->get();
       
        $amount=0;
        foreach($savingsWithdrawntillnow as $item){
            
            $query=DB::table('savings_withdraws')
            ->where('request_id','=',$item->id)
            ->where('status','=','2')
            ->first();
           
            $amount += $query->total;
            
        }   
        
        $nomineeInfo['amount']=$nomineeInfo['amount']-$amount;
            
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
            'total_deposite'=>'required|numeric|min:1|max:10000000',
            'loan_amount'=>'required|numeric|min:1|max:10000000',
            'application_date'=>'required',
            'present_district'=>'required',
            'present_thana'=>'required',
            'form_fee'=>'required',
            'present_post_code'=>'required',
            'present_village'=>'required',
            'mobile_one'=>'required|digits:11|numeric',
            'nominee_account_1'=>'required',
            'savings_amount_1'=>'required',
            'nominee_mob_1'=>'required|digits:11|numeric',
            'nominee_account_2'=>'required',
            'savings_amount_2'=>'required',
            'collection_category'=>'required',
            'nominee_mobile_2'=>'required|digits:11|numeric',
            ],[
            'mobile_one.digits' => 'Applicant Mobile Number must be 11 Digit!',
            'mobile_one.numeric' => 'Mobile Number must be a number!',
            'nominee_mob_1.digits' => 'Mobile Number must be 11 Digit!',
            'nominee_mob_1.numeric' => 'Mobile Number must be a number!',
            'nominee_mobile_2.digits' => 'Mobile Number must be 11 Digit!',
            'nominee_mobile_2.numeric' => 'Mobile Number must be a number!',

        ]);
        
        if($request->account_no==$request->nominee_account_1 || $request->account_no==$request->nominee_account_2){
             return back()->with('mess','Loan Applicant and Nominees can not be the same person!');
        }else
        {
        $newLoan= new LoanApplication();
        $newLoan->account_no=$request->account_no;
        $newLoan->loan_amount=$request->loan_amount;
        $newLoan->application_date=$request->application_date;
        $newLoan->total_deposite=$request->total_deposite;
        $newLoan->present_district=$request->present_district;
        $newLoan->present_thana=$request->present_thana;
        $newLoan->present_post_code=$request->present_post_code;
        $newLoan->present_village=$request->present_village;
        $newLoan->mobile_one=$request->mobile_one;
        $newLoan->mobile_two=$request->mobile_two;
        $newLoan->nominee_account_1=$request->nominee_account_1;
        $newLoan->savings_amount_1=$request->savings_amount_1;
        $newLoan->nominee_mob_1=$request->nominee_mob_1;
        $newLoan->nominee_account_2=$request->nominee_account_2;
        $newLoan->savings_amount_2=$request->savings_amount_2;
        $newLoan->nominee_mob_2=$request->nominee_mobile_2;
        $newLoan->field_officer_id=Auth::user()->id;
        $newLoan->save();



        $additionalCost=new AdditionalCollection();
        $additionalCost->additional_cost=$request->form_fee;
        $additionalCost->collection_category=$request->collection_category;
        $additionalCost->date_of_cost=date('Y-m-d');
        $additionalCost->description="Account No: ".$newLoan->account_no.".& Loan ID:".$newLoan->id." Loan Opening Form fee";
        $additionalCost->created_by=Auth::user()->id;
        $additionalCost->save();
        return back()->with('mass','Loan Application submitted Successfully!');
        }
    }
    public function getTotalAmountofApplicant(Request $request){
        $prevLoancheck=DB::table('loan_applications')
            ->select("*")
            ->where('account_no','=',$request->mid)
            ->whereIn('status',[0,1,2,3])
            ->first();
            if($prevLoancheck==null){
            $sumOfMoney['prevloan']="";
            $sumOfMoney['money']=DB::table('saving_amounts')
            ->where('member_id','=',$request->mid)
            ->where('status','=',1)
            ->sum('amount');
         $savingsWithdrawntillnow=DB::table('savings_withdraw_forms')
        ->join('savings_withdraws','savings_withdraws.request_id','=','savings_withdraw_forms.id')
        ->where('savings_withdraw_forms.account_no','=',$request->mid)
        ->where('savings_withdraw_forms.status','=',1)
        ->where('savings_withdraws.status','=',2)
        ->select('savings_withdraw_forms.id')
        ->get();
       
        $amount=0;
        foreach($savingsWithdrawntillnow as $item){
            
            $query=DB::table('savings_withdraws')
            ->where('request_id','=',$item->id)
            ->where('status','=','2')
            ->first();
           
            $amount += $query->total;
            
        }   
        
        $sumOfMoney['money']=$sumOfMoney['money']-$amount;   
            
            
            
        $info=DB::table('savings_account_infos')->where('id',$request->mid)->select('applicant_name')->first();
        $sumOfMoney['account_name']=$info->applicant_name;
            }else{
               $sumOfMoney['prevloan']="Close Previous Loan" ;
                $sumOfMoney['account_name']="N/A";
            }
            
        
        return response(($sumOfMoney));
    }
    public function newLoanView(){
        $AllLoans=LoanApplication::where('field_officer_id',Auth::user()->id)->get();
        $loanAccount=new LoanDispatch();
        return view('Backend.FieldOfficer.Loan.all-new-loans',['AllLoans'=>$AllLoans,'loanAccount'=>$loanAccount]);
    }
    public function allActiveLoans(){

        //dd('me');
        $loanDispatch=DB::table('loan_dispatches')
            ->join('loan_applications','loan_dispatches.loan_id','=','loan_applications.id')
            ->join('users','users.id','=','loan_applications.field_officer_id')
            ->select('loan_dispatches.*','users.name','loan_applications.field_officer_id')
            ->where('loan_applications.status','=',3)
            ->where('loan_applications.field_officer_id','=',Auth::user()->id)
            ->get();
        $loanAccount=new LoanDispatch();
        return view('Backend.FieldOfficer.Loan.active-loans',['loanDispatch'=>$loanDispatch,'loanAccount'=>$loanAccount]);
    }
    public function EditFormForLoan($slug){
        $editInfo=LoanApplication::where('slug',$slug)->first();

        //dd($editInfo->loan_amount);
        return view('front.Loan.edit-loan-form',['editInfo'=>$editInfo]);
    }
    public function UpdateLoanApplication(Request $request){
        $request->flush();
        $this->validate($request, [

            'loan_amount'=>'required|numeric',
            'application_date'=>'required',
            'total_deposite'=>'required|numeric',
            'present_district'=>'required',
            'present_thana'=>'required',
            'present_post_code'=>'required',
            'present_village'=>'required',
            'mobile_one'=>'required|digits:11|numeric',
            'nominee_account_1'=>'required',
            'savings_amount_1'=>'required',
            'nominee_mob_1'=>'required|digits:11|numeric',
            'nominee_account_2'=>'required',
            'savings_amount_2'=>'required',
            'nominee_mobile_2'=>'required|digits:11|numeric',
        ],[
            'mobile_one.digits' => 'Applicant Mobile Number must be 11 Digit!',
            'mobile_one.numeric' => 'Mobile Number must be a number!',
            'nominee_mob_1.digits' => 'Mobile Number must be 11 Digit!',
            'nominee_mob_1.numeric' => 'Mobile Number must be a number!',
            'nominee_mobile_2.digits' => 'Mobile Number must be 11 Digit!',
            'nominee_mobile_2.numeric' => 'Mobile Number must be a number!',

        ]);
        
        
        
        $newLoan= LoanApplication::find($request->id);
        if($newLoan->account_no==$request->nominee_account_1 || $newLoan->account_no==$request->nominee_account_2){
             return back()->with('mess','Loan Applicant and Nominees can not be the same person!');
        }else
        {
        
        $newLoan->loan_amount=$request->loan_amount;
        $newLoan->application_date=$request->application_date;
        $newLoan->total_deposite=$request->total_deposite;
        $newLoan->present_district=$request->present_district;
        $newLoan->present_thana=$request->present_thana;
        $newLoan->present_post_code=$request->present_post_code;
        $newLoan->present_village=$request->present_village;
        $newLoan->mobile_one=$request->mobile_one;
        $newLoan->mobile_two=$request->mobile_two;
        $newLoan->nominee_account_1=$request->nominee_account_1;
        $newLoan->savings_amount_1=$request->savings_amount_1;
        $newLoan->nominee_mob_1=$request->nominee_mob_1;
        $newLoan->nominee_account_2=$request->nominee_account_2;
        $newLoan->savings_amount_2=$request->savings_amount_2;
        $newLoan->nominee_mob_2=$request->nominee_mobile_2;
        $newLoan->save();

        return back()->with('mass','Loan Application Updated Successfully!');
        }
    }
    public function viewInfo($slug){

        $viewMember=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->join('loan_applications','loan_applications.account_no','=','savings_account_infos.id')
            ->select('savings_account_infos.*','users.id as Sid','users.name','loan_applications.id as Lid','loan_applications.loan_amount','loan_applications.account_no','loan_applications.nominee_account_1','loan_applications.nominee_account_2','loan_applications.application_date' ,'loan_applications.mobile_one','loan_applications.mobile_two','loan_applications.present_district','loan_applications.present_thana','loan_applications.slug as Lslug')
            ->where('savings_account_infos.verify','=',1)
            ->where('loan_applications.slug','=',$slug)
            ->first();

//        $checkDepositeInfo=SavingAmount::where('member_id',$viewMember->account_no)->first();
//        dd($checkDepositeInfo);
        $totalApplicantDeposite=DB::table('saving_amounts')
            ->where('member_id','=',$viewMember->account_no)
            ->sum('saving_amounts.amount');

        $nomineeTotalInfo=new LoanApplication();
        $nominee_one=$nomineeTotalInfo->NomineeTotalInfo($viewMember->nominee_account_1);

        $nominee_two=$nomineeTotalInfo->NomineeTotalInfo($viewMember->nominee_account_2);
        if ($nominee_one==null || $nominee_two==null){
            return back()->with('mass','Nominee Has not conduct any deposite yet!');
        }
        //dd($nominee_two);
        return view('back.FieldOfficer.loan-details',['viewMember'=>$viewMember,
            'totalApplicantDeposite'=>$totalApplicantDeposite,
            'nomineeTotalInfo'=>$nomineeTotalInfo,
            'nominee_one'=>$nominee_one,
            'nominee_two'=>$nominee_two,
        ]);
    }
    public function LoanDetails($slug){

        $loanInfo=LoanApplication::where('slug',$slug)->first();
        $customerInfo=SavingsAccountInfo::where('id',$loanInfo->account_no)->first();
        $totalApplicantDeposite=SavingAmount::where('member_id','=',$loanInfo->account_no)->where('status','=',1)->sum('amount');

        $nomineeTotalInfo=new LoanApplication();
        $nominee_one=$nomineeTotalInfo->NomineeTotalInfo($loanInfo->nominee_account_1);
        $nominee_one_savings=$nomineeTotalInfo->NomineeTotalSavings($loanInfo->nominee_account_1);
        $nominee_two=$nomineeTotalInfo->NomineeTotalInfo($loanInfo->nominee_account_2);
        $nominee_two_Savings=$nomineeTotalInfo->NomineeTotalSavings($loanInfo->nominee_account_2);
        if ($nominee_one_savings==null || $nominee_two_Savings==null){
            return back()->with('mass','Nominee Has not conducted any deposite yet!');
        }

        return view('Backend.FieldOfficer.Loan.details-loan',['loanInfo'=>$loanInfo,
            'totalApplicantDeposite'=>$totalApplicantDeposite,
            'nomineeTotalInfo'=>$nomineeTotalInfo,
            'nominee_one'=>$nominee_one,
            'customerInfo'=>$customerInfo,
            'nominee_two'=>$nominee_two,
            'nominee_one_savings'=>$nominee_one_savings,
            'nominee_two_Savings'=>$nominee_two_Savings,
        ]);
    }

}
