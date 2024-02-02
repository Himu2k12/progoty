<?php

namespace App\Http\Controllers;

use App\AdditionalCollection;
use App\AdditionalCost;
use App\FinalLoanVerification;
use App\LoanApplication;
use App\LoanDispatch;
use App\LoanDocument;
use App\LoanPayAmount;
use App\Role;
use App\SavingAmount;
use App\SavingsAccountInfo;
use App\SavingsWithdraw;
use App\SavingsAccountVerification;
use App\Scheme;
use App\SheetRecord;
use App\SupervisorLoanVerification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Gate;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowDashboard(){
        if(!Gate::allows('isSuper')){
            abort('404','you can\'t access here');
        }
        $thisYear=Carbon::now()->year;
        $thisMonth=Carbon::now()->month;
        $CurrentMonthsSavings=SavingAmount::whereMonth('created_at',$thisMonth)->whereYear('created_at',$thisYear)->sum('amount');
        $CurrentMonthsLoan=LoanPayAmount::whereMonth('created_at',$thisMonth)->whereYear('created_at',$thisYear)->sum('amount');
        $CurrentMonthsLoanService=LoanPayAmount::whereMonth('created_at',$thisMonth)->whereYear('created_at',$thisYear)->sum('service_charge');
        $CurrentMonthloanDespatched=FinalLoanVerification::whereMonth('created_at',$thisMonth)->whereYear('created_at',$thisYear)->sum('final_amount');
        $CurrentMonthloanNumber=FinalLoanVerification::whereMonth('created_at',$thisMonth)->whereYear('created_at',$thisYear)->count('id');
        $CurrentMonthsAdditionalCost=AdditionalCost::whereMonth('created_at',$thisMonth)->whereYear('created_at',$thisYear)->sum('additional_cost');
        $CurrentMonthsAdditionalCollection=AdditionalCollection::whereMonth('created_at',$thisMonth)->whereYear('created_at',$thisYear)->sum('additional_cost');
        $CurrentMonthsNewMember=SavingsAccountInfo::whereMonth('created_at',$thisMonth)->whereYear('created_at',$thisYear)->where('verify',1)->count('id');


        $janSavings=SavingAmount::whereMonth('created_at',01)->whereYear('created_at',$thisYear)->sum('amount');
        $febSavings=SavingAmount::whereMonth('created_at',02)->whereYear('created_at',$thisYear)->sum('amount');
        $marSavings=SavingAmount::whereMonth('created_at',03)->whereYear('created_at',$thisYear)->sum('amount');
        $aprSavings=SavingAmount::whereMonth('created_at',04)->whereYear('created_at',$thisYear)->sum('amount');
        $maySavings=SavingAmount::whereMonth('created_at',05)->whereYear('created_at',$thisYear)->sum('amount');
        $juneSavings=SavingAmount::whereMonth('created_at',06)->whereYear('created_at',$thisYear)->sum('amount');
        $julySavings=SavingAmount::whereMonth('created_at',"07")->whereYear('created_at',$thisYear)->sum('amount');
        $augSavings=SavingAmount::whereMonth('created_at',"08")->whereYear('created_at',$thisYear)->sum('amount');
        $sepSavings=SavingAmount::whereMonth('created_at',"09")->whereYear('created_at',$thisYear)->sum('amount');
        $octSavings=SavingAmount::whereMonth('created_at',10)->whereYear('created_at',$thisYear)->sum('amount');
        $novSavings=SavingAmount::whereMonth('created_at',11)->whereYear('created_at',$thisYear)->sum('amount');
        $decSavings=SavingAmount::whereMonth('created_at',12)->whereYear('created_at',$thisYear)->sum('amount');


        $janLoans=LoanPayAmount::whereMonth('created_at',01)->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $febLoans=LoanPayAmount::whereMonth('created_at',02)->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $marLoans=LoanPayAmount::whereMonth('created_at',03)->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $aprLoans=LoanPayAmount::whereMonth('created_at',04)->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $mayLoans=LoanPayAmount::whereMonth('created_at',05)->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $juneLoans=LoanPayAmount::whereMonth('created_at',06)->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $julyLoans=LoanPayAmount::whereMonth('created_at',"07")->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $augLoans=LoanPayAmount::whereMonth('created_at',"08")->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $sepLoans=LoanPayAmount::whereMonth('created_at',"09")->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $octLoans=LoanPayAmount::whereMonth('created_at',10)->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $novLoans=LoanPayAmount::whereMonth('created_at',11)->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        $decLoans=LoanPayAmount::whereMonth('created_at',12)->whereYear('created_at',$thisYear)->sum(\DB::raw('amount + service_charge'));
        //dd($febLoans);
        return view('Backend.SuperAdmin.super-home',[
            'CurrentMonthsSavings'=>$CurrentMonthsSavings,
            'janSavings'=>$janSavings,
            'febSavings'=>$febSavings,
            'marSavings'=>$marSavings,
            'aprSavings'=>$aprSavings,
            'maySavings'=>$maySavings,
            'juneSavings'=>$juneSavings,
            'julySavings'=>$julySavings,
            'augSavings'=>$augSavings,
            'sepSavings'=>$sepSavings,
            'octSavings'=>$octSavings,
            'novSavings'=>$novSavings,
            'decSavings'=>$decSavings,
            'janLoans'=>$janLoans,
            'febLoans'=>$febLoans,
            'marLoans'=>$marLoans,
            'aprLoans'=>$aprLoans,
            'mayLoans'=>$mayLoans,
            'juneLoans'=>$juneLoans,
            'julyLoans'=>$julyLoans,
            'augLoans'=>$augLoans,
            'sepLoans'=>$sepLoans,
            'octLoans'=>$octLoans,
            'novLoans'=>$novLoans,
            'decLoans'=>$decLoans,
            'CurrentMonthsLoan'=>$CurrentMonthsLoan,
            'CurrentMonthsLoanService'=>$CurrentMonthsLoanService,
            'CurrentMonthloanDespatched'=>$CurrentMonthloanDespatched,
            'CurrentMonthsAdditionalCost'=>$CurrentMonthsAdditionalCost,
            'CurrentMonthsAdditionalCollection'=>$CurrentMonthsAdditionalCollection,
            'CurrentMonthsNewMember'=>$CurrentMonthsNewMember,
            'CurrentMonthloanNumber'=>$CurrentMonthloanNumber,
        ]);
    }
    public function RegisterStaffs(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $roles=Role::where('id','!=',1)->get();
        $staffs=DB::table('users')
            ->join('roles','roles.id','=','users.role')
            ->select('users.*','roles.role as roleName')
            ->get();
        return view('Backend.SuperAdmin.Employee.add-employee',['staffs'=>$staffs,'roles'=>$roles]);
    }
    public function viewSheets(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $sheets=SheetRecord::get();
        $fon=new User();
        
        return view('Backend.SuperAdmin.sheet-page',['sheets'=>$sheets,'fon'=>$fon]);
    }
    public function EditSheetInfo($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $sheetNo=DB::table('sheet_records')
        ->where('id','=',$id)
        ->first();
        
        $savings=DB::table('saving_amounts')
        ->where('sheet_no','=',$sheetNo->sheet_no)
        ->get();
        foreach($savings as $saving){
            $data=SavingAmount::find($saving->id);
            $data->status = 0;
            $data->save();
        }
        
        $loans=DB::table('loan_pay_amounts')
        ->where('sheet_no','=',$sheetNo->sheet_no)
        ->get();
         foreach($loans as $loan){
            $data=LoanPayAmount::find($loan->id);
            $data->status = 0;
            $data->save();
         }
        
        DB::table('sheet_records')->where('id', $id)->delete();
        
        return redirect('/all-sheets')->with('message', 'FieldOfficer Data restored for the sheet you Deleted!Cashier need to Accept the Sheet Again!');
        
        }
    public function inactiveMember($slug){
        $member=SavingsAccountInfo::where('slug',$slug)->first();
        $member->verify=2;
        $member->save();
        
        //dd($member);
        return back()->with('message',"Member Info Inactivated!");
    }
    public function activeMember($slug){
        $member=SavingsAccountInfo::where('slug',$slug)->first();
        $member->verify=1;
        $member->save();
        
        //dd($member);
        return back()->with('message',"Member Info Activated!");
    }
    protected function closedMembers(){
         if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $newMembers=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->select('savings_account_infos.*','users.name')
            ->where('savings_account_infos.verify','=',2)
            ->get();

        $supervisorName=new SavingsAccountVerification();
        return view('Backend.SuperAdmin.Savings.closedAccounts',['newMembers'=>$newMembers,'supervisorName'=>$supervisorName]);
    }

    protected function newStaffs(Request $request)
    {
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $users=new User();
        $users->name = $request['name'];
        $users->email = $request['email'];
        $users->password= Hash::make($request['password']);
        $users->role= $request['role'];
        $users->access = 0;
        $users->save();

        return redirect('/register-staffs')->with('message','New Staff Added Successfully!');
    }

    public function inactiveStaffInfo($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $staffById = User::find($id);
        $staffById->access = 0;
        $staffById->save();
        return redirect('/register-staffs')->with('message', 'Staff info Inactive successfully');
    }
    public function activeStaffInfo($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $staffById = User::find($id);
        $staffById->access = 1;
        $staffById->save();
        return redirect('/register-staffs')->with('message', 'Staff info Activated successfully');
    }
    public function updateStaffInfo(Request $request){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
        ]);
        $users=User::find($request->id);
        $users->name = $request['name'];
        $users->role= $request['role'];
        $users->save();

        return redirect('/register-staffs')->with('message','Staff Updated Successfully!');
    }
    public function loanRequestsAdmin(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
      $SupervisorVerifiedLoan=  DB::table('loan_applications')
            ->join('supervisor_loan_verifications','supervisor_loan_verifications.loan_id','=','loan_applications.id')
          ->join('users','users.id','=','supervisor_loan_verifications.supervisor_id')
            ->select('loan_applications.*','supervisor_loan_verifications.created_at as VerifyDate','supervisor_loan_verifications.supervisor_id','users.name')
            ->where('supervisor_loan_verifications.status','=',0)
            ->where('loan_applications.status','=',1)
            ->get();

      //dd($SupervisorVerifiedLoan);
      return view('Backend.SuperAdmin.Loan.loan-request',['SupervisorVerifiedLoan'=>$SupervisorVerifiedLoan]);
    }
    public function detailsLoanPapers($slug){
        $loanInfo=LoanApplication::where('slug',$slug)->first();
        $customerInfo=SavingsAccountInfo::where('id',$loanInfo->account_no)->first();

        $totalApplicantDeposite=SavingAmount::where('member_id','=',$loanInfo->account_no)->where('status','=',1)->sum('amount');
        $totalLoanPay=LoanPayAmount::where('loan_id','=',$loanInfo->id)->where('status','=',1)->sum('amount');
        $totalLoanService=LoanPayAmount::where('loan_id','=',$loanInfo->id)->where('status','=',1)->sum('service_charge');

        $nomineeTotalInfo=new LoanApplication();
        $nominee_one=$nomineeTotalInfo->NomineeTotalInfo($loanInfo->nominee_account_1);
        $nominee_one_savings=$nomineeTotalInfo->NomineeTotalSavings($loanInfo->nominee_account_1);
        $nominee_two=$nomineeTotalInfo->NomineeTotalInfo($loanInfo->nominee_account_2);
        $nominee_two_Savings=$nomineeTotalInfo->NomineeTotalSavings($loanInfo->nominee_account_2);
        $supervisorVerificationInfo=SupervisorLoanVerification::where('loan_id',$loanInfo->id)->first();
        $supervisorVerificationDocuments=LoanDocument::where('status',0)->where('loan_id',$loanInfo->id)->get();
        $supervisorName=DB::table('users')
            ->select('name')
            ->where('id','=',$supervisorVerificationInfo->supervisor_id)
            ->first();
        $loanLastInfo=LoanDispatch::whereloan_id($loanInfo->id)->first();

        return view('Backend.SuperAdmin.Loan.loan-details',[
            'loanInfo'=>$loanInfo,
            'totalLoanPay'=>$totalLoanPay,
            'totalLoanService'=>$totalLoanService,
            'loanLastInfo'=>$loanLastInfo,
            'totalApplicantDeposite'=>$totalApplicantDeposite,
            'nomineeTotalInfo'=>$nomineeTotalInfo,
            'nominee_one'=>$nominee_one,
            'nominee_two'=>$nominee_two,
            'supervisorVerificationDocuments'=>$supervisorVerificationDocuments,
            'supervisorVerificationInfo'=>$supervisorVerificationInfo,
            'supervisorName'=>$supervisorName,
            'nominee_one_savings'=>$nominee_one_savings,
            'nominee_two_Savings'=>$nominee_two_Savings,
            'customerInfo'=>$customerInfo,
        ]);
    }
    public function LoanApproveComment($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $loanAmount=LoanApplication::where('slug',$id)->first();
        $supervisorAmount=SupervisorLoanVerification::where('loan_id',$loanAmount->id)->first();
        //dd($supervisorAmount);

        return view('Backend.SuperAdmin.Loan.manage-loan-document',['slug'=>$id,'loanAmount'=>$loanAmount,'supervisorAmount'=>$supervisorAmount]);
    }
    public function AdminLoanAmountEdit($slug){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $loanAmount=LoanApplication::where('slug',$slug)->first();
        $supervisorAmount=SupervisorLoanVerification::where('loan_id',$loanAmount->id)->first();
        $adminInfos=FinalLoanVerification::where('loan_id',$loanAmount->id)->first();
        //($adminInfos);
        //dd($supervisorAmount);

        return view('Backend.SuperAdmin.Loan.edit-loan-documents',['slug'=>$slug,'loanAmount'=>$loanAmount,'supervisorAmount'=>$supervisorAmount,'adminInfos'=>$adminInfos]);
    }
    public function LoanApprove(Request $request){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
       //dd($request->final_amount);
        $adminInfo=new FinalLoanVerification();
        $adminInfo->loan_id=$request->loan_id;
        $adminInfo->final_amount=$request->final_amount;
        $adminInfo->note=$request->note;
        $adminInfo->save();
            
        $approveLoan=SupervisorLoanVerification::find($request->id);
        $approveLoan->status=1;
        $approveLoan->save();


        $loanId=$approveLoan->loan_id;
        $loanApprove=LoanApplication::find($loanId);
        $loanApprove->status=2;
        $loanApprove->save();

        return redirect('/approved-loans')->with('mass','Loan Approved!!');
    }
    public function AdminLoanCancel($slug){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $loanId=LoanApplication::where('slug',$slug)->first();
        $loanId->status=-1;
        $loanId->save();

        $approveLoan=SupervisorLoanVerification::where('loan_id',$loanId->id)->first();
        $approveLoan->status=-1;
        $approveLoan->save();


        return redirect('/approved-loans')->with('mass','Loan Request Cancelled!');
    }
    public function LoanApprovebyAdmin(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $adminVerifiedLoan=  DB::table('loan_applications')
            ->join('supervisor_loan_verifications','supervisor_loan_verifications.loan_id','=','loan_applications.id')
            ->join('final_loan_verifications','final_loan_verifications.loan_id','=','loan_applications.id')
            ->join('users','users.id','=','supervisor_loan_verifications.supervisor_id')
            ->select('final_loan_verifications.final_amount','final_loan_verifications.cashier_status','loan_applications.*','supervisor_loan_verifications.created_at as VerifyDate','supervisor_loan_verifications.supervisor_id','users.name')
            ->where('supervisor_loan_verifications.status','=',1)
            ->where('loan_applications.status','!=',0)
            ->get();
        return view('Backend.SuperAdmin.Loan.approved-loan-status',['adminVerifiedLoan'=>$adminVerifiedLoan]);
    }
    public function LoanReadytoDispatchbyAdmin(){
          if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
      $SupervisorVerifiedLoan=  DB::table('loan_applications')
            ->join('supervisor_loan_verifications','supervisor_loan_verifications.loan_id','=','loan_applications.id')
          ->join('users','users.id','=','supervisor_loan_verifications.supervisor_id')
            ->select('loan_applications.*','supervisor_loan_verifications.created_at as VerifyDate','supervisor_loan_verifications.supervisor_id','users.name')
            ->where('supervisor_loan_verifications.status','=',1)
            ->where('loan_applications.status','=',2)
            ->get();

      //dd($SupervisorVerifiedLoan);
      return view('Backend.SuperAdmin.Loan.ready-to-dispatch',['SupervisorVerifiedLoan'=>$SupervisorVerifiedLoan]);
    }
     public function LoanSanctionUpdate(Request $request){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $adminInfo=FinalLoanVerification::find($request->id);
        $adminInfo->final_amount=$request->final_amount;
        $adminInfo->note=$request->note;
        $adminInfo->save();
        return redirect('/ready-to-dispatch-loan-request-admin')->with('mass','Loan Info Updated!!');
    }
    public function allLoansforAdmin(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        //dd('me');
        $loanDispatch=DB::table('loan_dispatches')
            ->join('loan_applications','loan_dispatches.loan_id','=','loan_applications.id')
            ->join('users','users.id','=','loan_applications.field_officer_id')
            ->select('loan_dispatches.*','users.name','loan_applications.field_officer_id')
            ->where('loan_applications.status','=',3)
            ->get();
        $loanAccount=new LoanDispatch();
        return view('Backend.SuperAdmin.Loan.active-loans',['loanDispatch'=>$loanDispatch,'loanAccount'=>$loanAccount]);
    }
    public function transactionById($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $loanAmount=DB::table('loan_dispatches')
            ->select('*')
            ->where('loan_id','=',$id)
            ->first();
        $loanPayment=DB::table('loan_pay_amounts')
            ->select('*')
            ->where('loan_id','=',$id)
            ->where('status','=',1)
            ->get();
        $paidAmount=0;
        $paidService=0;
        foreach ($loanPayment as $item){
            $paidAmount+=$item->amount;
            $paidService+=$item->service_charge;
        }
        $supervisor=SupervisorLoanVerification::where('loan_id',$id)->first();
        $AdminVerification=FinalLoanVerification::where('loan_id',$id)->first();
        $CashierComment=LoanDispatch::where('loan_id',$id)->first();
        $supervisorVerificationDocuments=LoanDocument::where('loan_id',$id)->get();
        $userName=new User();

        return view('Backend.SuperAdmin.Loan.loan-transactions',['loanPayment'=>$loanPayment,
                                                                'loanAmount'=>$loanAmount,
                                                                'paidAmount'=>$paidAmount,
                                                                'paidService'=>$paidService,
                                                                'supervisor'=>$supervisor,
                                                                'AdminVerification'=>$AdminVerification,
                                                                'CashierComment'=>$CashierComment,
                                                                'supervisorVerificationDocuments'=>$supervisorVerificationDocuments,
                                                                'userName'=>$userName,

        ]);
    }
    public function closeLoan(Request $request){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        
        if($request->discount == ($request->rest_loan+$request->rest_service)){
        
        $discountAdd=LoanDispatch::whereloan_id($request->loan_id)->first();
        $discountAdd->discount=$request->discount;
        $discountAdd->save();
        

        $closeLoan=LoanApplication::find($request->loan_id);
        $closeLoan->status=4;
        $closeLoan->save();
        return redirect('admin-all-active-loans')->with('mass','Loan closed Successfully!');
        }else{
            return back()->with('message','Discount Amount must be equal to rest of the loan amount!');
            
        }
    }
    public function SavingsWithdrawRequests(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        
        $requestForAdmin=DB::table('savings_withdraws')
            ->join('savings_withdraw_forms','savings_withdraws.request_id','=','savings_withdraw_forms.id')
            ->join('savings_account_infos','savings_account_infos.id','=','savings_withdraw_forms.account_no')
            ->join('users','users.id','=','savings_withdraws.supervisor_id')
            ->where('savings_withdraws.status','=',0)
            ->select('savings_withdraws.*','users.name','savings_account_infos.id as accountNo','savings_account_infos.applicant_name')
            ->get();
            //dd($requestForAdmin);

        return view('Backend.SuperAdmin.Savings.request-for-withdraw-savings',['requestForAdmin'=>$requestForAdmin]);

    }
    public function ApprovedSavingsWithdrawRequests(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $requestForAdmin=DB::table('savings_withdraws')
            ->join('savings_withdraw_forms','savings_withdraws.request_id','=','savings_withdraw_forms.id')
            ->join('savings_account_infos','savings_account_infos.id','=','savings_withdraw_forms.account_no')
            ->join('users','users.id','=','savings_withdraws.supervisor_id')
            ->where('savings_withdraws.status','=',1)
            ->select('users.name','savings_withdraws.*','savings_account_infos.id as accountNo','savings_account_infos.applicant_name')
            ->get();

//dd($pendingForAdminApproval);
        return view('Backend.SuperAdmin.Savings.approved-withdraw-savings',['requestForAdmin'=>$requestForAdmin]);

    }
    public function SavingsWithdrawHistory(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $requestForAdmin=DB::table('savings_withdraws')
            ->join('savings_withdraw_forms','savings_withdraws.request_id','=','savings_withdraw_forms.id')
            ->join('savings_account_infos','savings_account_infos.id','=','savings_withdraw_forms.account_no')
            ->join('users','users.id','=','savings_withdraws.supervisor_id')
            ->where('savings_withdraws.status','=',2)
            ->select('users.name','savings_withdraws.*','savings_account_infos.id as accountNo','savings_account_infos.applicant_name')
            ->get();

//dd($requestForAdmin);
        return view('Backend.SuperAdmin.Savings.closed-accounts',['requestForAdmin'=>$requestForAdmin]);

    }
    public function viewSavingsDetails($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $editInfo = SavingsWithdraw::find($id);
        $allInfo=DB::table('savings_account_infos')
            ->join('savings_withdraw_forms','savings_withdraw_forms.account_no','=','savings_account_infos.id')
            ->select('savings_account_infos.*','savings_withdraw_forms.id as Lid','savings_withdraw_forms.total_savings','savings_withdraw_forms.mobile','savings_withdraw_forms.form_fee','savings_withdraw_forms.note','savings_withdraw_forms.days_of_saving','savings_withdraw_forms.created_at as applicationDate')
            ->where('savings_withdraw_forms.id','=',$editInfo->request_id)
            ->first();
        //dd($editInfo);
        $SumofMoney=DB::table('saving_amounts')
            ->where('member_id','=',$allInfo->id)
            ->where('status','=',1)
            ->sum('saving_amounts.amount');

        $allSavingsDetails=DB::table('saving_amounts')
            ->select('*')
            ->where('member_id','=',$allInfo->id)
            ->where('status','=',1)
            ->get();
        $savingsWithdraw = DB::table('savings_withdraw_forms')
            ->where('account_no','=',$allInfo->id)
            ->where('status','=',1)
            ->get(); 
            
            $currentBalance=0;
            $sum=0;
        if($savingsWithdraw != null){
                 
        foreach($savingsWithdraw as $me){
            
            $savings = DB::table('savings_withdraws')
                    ->where('request_id','=',$me->id)
                    ->where('status','=',2)
                    ->first();
                    if(isset($savings->total)){
                    $sum += $savings->total;
                    }
            }
             
            $currentBalance=$SumofMoney - $sum;
                
            }
        $username=new User();
        return view('Backend.SuperAdmin.Savings.view-savings-withdraw',['editInfo'=>$editInfo,'allInfo'=>$allInfo, 'SumofMoney'=>$SumofMoney,'allSavingsDetails'=>$allSavingsDetails,'username'=>$username,'currentBalance'=>$currentBalance,'sum'=>$sum]);
    }
    public function approveForDespatch($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $savings=SavingsWithdraw::find($id);
        $savings->status=1;
        $savings->save();

        return redirect('/approved-withdraws-admin')->with('message','Savings Withdraw Approval referred to Cashier for Despatch');
    }
     public function CancelWithdrawRequest($slug){
        $withdrawRequest=SavingsWithdraw::find($slug);
        $withdrawRequest->status=-2;//for admin decline -2 and for supervisor -1
        $withdrawRequest->save();
        return back()->with('mass','Withdraw Request canceled!');
    }
    public function DetailsOfWithdraw($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $alreadyDespatched=DB::table('cash_despatch_savings')
            ->join('savings_withdraws','savings_withdraws.id','=','cash_despatch_savings.savings_withdraw_id')
            ->join('savings_withdraw_forms','savings_withdraw_forms.id','=','savings_withdraws.request_id')
            ->join('savings_account_infos','savings_account_infos.id','=','savings_withdraw_forms.account_no')
            ->join('users','users.id','=','savings_withdraw_forms.field_man_id')
            ->select('savings_withdraw_forms.days_of_saving','savings_account_infos.applicant_name','savings_account_infos.id as accountNo','savings_account_infos.created_at as ACopen','cash_despatch_savings.*','savings_withdraw_forms.field_man_id','users.name')
            ->where('cash_despatch_savings.savings_withdraw_id','=',$id)
            ->first();
        $cashierName=User::find($alreadyDespatched->cashier_id);

        return view('Backend.SuperAdmin.Savings.details-of-withdraws',['alreadyDespatched'=>$alreadyDespatched,
                                                                        'cashierName'=>$cashierName,
            ]);
    }
    public function editStaffForm($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $userInfo=User::find($id);
        $role=Role::where('access',1)->where('id','!=',1)->get();
        return view('Backend.SuperAdmin.Employee.edit-employee',['userInfo'=>$userInfo,'role'=>$role]);
    }
    public function loanStatement(){
        return view('Backend.SuperAdmin.Loan.statement-form');
    }
    public function searchLoan(Request $request){
        $statements=LoanPayAmount::where('loan_id',$request->loan_id)->get();

        return view('Backend.SuperAdmin.Loan.statement-form',['statements'=>$statements]);
    }
    public function searchSavings(Request $request){
        $statements=SavingAmount::where('member_id',$request->id)->get();

        return view('Backend.SuperAdmin.Savings.statement-form',['statements'=>$statements]);
    }
    public function savingsStatement(){
        return view('Backend.SuperAdmin.Savings.statement-form');
    }
    public function searchFieldOfficer(Request $request){
        $fieldOfficers=User::where('role','=',3)->get();
        $statements=SavingAmount::where('member_id',$request->id)->get();
        return view('Backend.Reports.field-officer-report',['statements'=>$statements,'fieldOfficers'=>$fieldOfficers]);
    }
    public function FieldofficersStatement(){
        $officers=User::where('role','=',3)->get();
        return view('Backend.Reports.field-officer-report',['officers'=>$officers]);
    }
    public function CreateNewReport(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $officers=User::where('role','=',3)->get();
        
        if($request->from!==null){
            $from=$request->from;
            $to=$request->to;
            $fo=$request->field_officer;
            $savings=DB::table('saving_amounts')
                ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
                ->whereBetween('saving_amounts.created_at',[$request->from,$request->to])
                ->where('saving_amounts.field_man_id','=',$request->field_officer)
                ->select('savings_account_infos.applicant_name','saving_amounts.id','saving_amounts.member_id','saving_amounts.amount','saving_amounts.sheet_no','saving_amounts.created_at','saving_amounts.field_man_id')
                ->get();

            $loans=DB::table('loan_pay_amounts')
                ->join('savings_account_infos','savings_account_infos.id','=','loan_pay_amounts.account_no')
                ->whereBetween('loan_pay_amounts.created_at',[$request->from,$request->to])
                ->where('loan_pay_amounts.field_man_id','=',$request->field_officer)
                ->select('savings_account_infos.applicant_name','loan_pay_amounts.id','loan_pay_amounts.account_no','loan_pay_amounts.service_charge','loan_pay_amounts.sheet_no','loan_pay_amounts.field_man_id','loan_pay_amounts.amount','loan_pay_amounts.created_at')
                ->get();
                 $foN=new User();
            return view('Backend.Reports.field-officer-report',['fo'=>$fo,'officers'=>$officers,'savings'=>$savings,'loans'=>$loans,'from'=>$from,'to'=>$to,'foN'=>$foN]);
        }else{
           
            return view('Backend.Reports.field-officer-report',['officers'=>$officers]);
        }
    }
    public function CreateDailyReport(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $officers=User::where('role','=',3)->get();
        $foN=new User();
        if($request->date!==null){
            $from=$request->date;
            $fo=$request->field_officer;
            $savings=DB::table('saving_amounts')
                ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
                ->whereDate('saving_amounts.created_at','=',$from)
                ->where('saving_amounts.field_man_id','=',$request->field_officer)
                ->select('savings_account_infos.applicant_name','saving_amounts.id','saving_amounts.member_id','saving_amounts.amount','saving_amounts.sheet_no','saving_amounts.created_at','saving_amounts.field_man_id')
                ->get();
            $loans=DB::table('loan_pay_amounts')
                ->join('savings_account_infos','savings_account_infos.id','=','loan_pay_amounts.account_no')
                ->whereDate('loan_pay_amounts.created_at','=',$from)
                ->where('loan_pay_amounts.field_man_id','=',$request->field_officer)
                ->select('savings_account_infos.applicant_name','loan_pay_amounts.id','loan_pay_amounts.account_no','loan_pay_amounts.service_charge','loan_pay_amounts.sheet_no','loan_pay_amounts.field_man_id','loan_pay_amounts.amount','loan_pay_amounts.created_at')
                ->get();
            $check="checked";
            
            return view('Backend.Reports.field-officer-report',['foN'=>$foN,'fo'=>$fo,'officers'=>$officers,'savings'=>$savings,'loans'=>$loans,'from'=>$from,'check'=>$check]);
        }else{
            return view('Backend.Reports.field-officer-report');
        }
    }
    public function SheetReport(){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        return view('Backend.Reports.Supervisor.sheet-report');
    }
    public function SheetSubmitReport(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->sheet!==null) {
            $sheet = $request->sheet;
            $savings = DB::table('saving_amounts')
                ->where('saving_amounts.sheet_no', '=', $sheet)
                ->where('saving_amounts.status','=', 1)
                ->select('*')
                ->get();
            $loan = DB::table('loan_pay_amounts')
                ->where('sheet_no', '=', $sheet)
                ->where('loan_pay_amounts.status','=', 1)
                ->select('*')
                ->get();
            $FoN=new User();
            $additionalCollection=DB::table('sheet_records')
            ->where('sheet_no','=',$sheet)
            ->select('additional_collection')
            ->first();
            if($additionalCollection){
            if($additionalCollection->additional_collection==null){
              
                $additionalCollection=0;
            }else{
                $additionalCollection=$additionalCollection->additional_collection;
            }
            }
            $applicantName=new SavingsAccountInfo();
            return view('Backend.Reports.Supervisor.sheet-report',['FoN'=>$FoN,'savings'=>$savings,'loan'=>$loan,'sheet'=>$sheet,'additionalCollection'=>$additionalCollection,'applicantName'=>$applicantName]);
        }else{
            return view('Backend.Reports.Supervisor.sheet-report');
        }
    }
    public function percentageform(){
        $schemes=Scheme::all();
        return view('Backend.SuperAdmin.percentage.add-percentage',['schemes'=>$schemes]);
    }
    public function addPercent(Request $request){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'percentage' => ['required'],
        ]);
        $users=new Scheme();
        $users->title= $request['title'];
        $users->percentage= $request['percentage'];
        $users->save();

        return back()->with('message','Scheme Created Successfully!');
    }
    public function inactivePercentage($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $scheme = Scheme::find($id);
        $scheme->status = 0;
        $scheme->save();
        return redirect('/scheme')->with('message', 'Scheme info Inactive successfully');
    }
    public function activePercentage($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $scheme = Scheme::find($id);
        $scheme->status = 1;
        $scheme->save();
        return redirect('/scheme')->with('message', 'Scheme info actived successfully');
    }
}
