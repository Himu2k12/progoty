<?php

namespace App\Http\Controllers;

use App\AdditionalCollection;
use App\AdditionalCost;
use App\AddtitonalCollection;
use App\CashDespatchSaving;
use App\CollectionCategory;
use App\CostCategory;
use App\FinalLoanVerification;
use App\LoanApplication;
use App\LoanDispatch;
use App\LoanPayAmount;
use App\Role;
use App\SavingAmount;
use App\SavingsAccountInfo;
use App\SavingsDespatch;
use App\SavingsWithdraw;
use App\SheetRecord;
use Illuminate\Support\Facades\App;
use View;
use App\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Gate;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dailyCollection(){
        $allFieldOfficer=User::where('role','=',3)->where('access','=',1)->get();
        $role=DB::table('users')
            ->join('roles','roles.id','=','users.role')
            ->select('roles.role')
            ->where('users.id',Auth::user()->id)
            ->first();
        return view('Backend.Cashier.cash-panel',['allFieldOfficer'=>$allFieldOfficer,'role'=>$role]);
    }
    public function dispatchRequest(){
        $dispatchLoan=$adminVerifiedLoan=  DB::table('loan_applications')
            ->join('supervisor_loan_verifications','supervisor_loan_verifications.loan_id','=','loan_applications.id')
            ->Join('final_loan_verifications','final_loan_verifications.loan_id','=','loan_applications.id')
            ->join('users','users.id','=','loan_applications.field_officer_id')
            ->select('final_loan_verifications.final_amount as LoanAm','final_loan_verifications.created_at as VerifyAdminDate','loan_applications.*','supervisor_loan_verifications.created_at as VerifyDate','supervisor_loan_verifications.supervisor_id','users.name')
            ->where('supervisor_loan_verifications.status','=',1)
            ->where('loan_applications.status','=',2)
            ->get();
        $accountInfo=new SavingsAccountInfo();
        return view('Backend.Cashier.Loans.loan-dispatch',['accountInfo'=>$accountInfo,'dispatchLoan'=>$dispatchLoan]);
    }
    public function dispatchForm($slug){
        $loan=LoanApplication::where('slug',$slug)->first();

        $loanAmount=FinalLoanVerification::where('loan_id',$loan->id)->first();
        return view('Backend.Cashier.Loans.dispatch-form',['slug'=>$slug,'loanAmount'=>$loanAmount]);
    }
    public function saveDispatchInfo(Request $request){
        $loanID=LoanApplication::where('slug',$request->slug)->first();
        $loan=LoanApplication::find($loanID->id);
        $loan->status=3;
        $loan->save();

        $ddate=$request->dispatch_date;
        $decdate=date('Y-m-d', strtotime($ddate. ' + 240 days'));

        $loanAmount=$request->loan_amount;
        $TWSC=($loanAmount+($request->service_charge*($loanAmount)/100));

        $saveLoan=new LoanDispatch();
        $saveLoan->loan_id=$loanID->id;
        $saveLoan->dispatch_date=$request->dispatch_date;
        $saveLoan->service_charge=$request->service_charge;
        $saveLoan->note=$request->note;
        $saveLoan->loan_amount=$request->loan_amount;
        $saveLoan->total_amount_with_charge=$TWSC;
        $saveLoan->cashier_id=Auth::user()->id;
        $saveLoan->decline_date=$decdate;
        $saveLoan->save();

        $FinalLoan=FinalLoanVerification::where('loan_id',$loanID->id)->first();
        $FinalLoanVerification=FinalLoanVerification::find($FinalLoan->id);
        $FinalLoanVerification->status=1;
        $FinalLoanVerification->cashier_status=1;
        $FinalLoanVerification->save();
        return redirect('/all-active-loans')->with('mass','Loan Dispatched Successfully');
    }
    public function allLoans(){
       
        $loanDispatch=DB::table('loan_dispatches')
            ->join('loan_applications','loan_dispatches.loan_id','=','loan_applications.id')
            ->join('users','users.id','=','loan_applications.field_officer_id')
            ->where('loan_applications.status','!=',4)
            ->select('loan_dispatches.*','users.name','loan_applications.field_officer_id')
            ->get();
            $loanAccount=new LoanDispatch();
        return view('Backend.Cashier.Loans.active-loan',['loanDispatch'=>$loanDispatch,'loanAccount'=>$loanAccount]);
    }
    public function AllLoanApplications(){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $loans=DB::table('loan_dispatches')
            ->join('loan_applications','loan_dispatches.loan_id','=','loan_applications.id')
            ->join('users','users.id','=','loan_applications.field_officer_id')
            ->select('loan_dispatches.*','users.name','loan_applications.field_officer_id','loan_applications.status as situation')
            ->get();
            $loanAccount=new LoanDispatch();
        return view('Backend.Cashier.Loans.all-loans',['loans'=>$loans,'loanAccount'=>$loanAccount]);
    }
    public function todayCollection(){

        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];


        $dailyCollectionOfAllFeildman=DB::table('saving_amounts')
            ->join('users','users.id','=','saving_amounts.field_man_id')
            ->select('saving_amounts.field_man_id','users.name','saving_amounts.sheet_no')
            ->groupBy('saving_amounts.field_man_id','users.name','saving_amounts.sheet_no')
            ->where('saving_amounts.status','=',0)
            ->get();

        //dd($dailyCollectionOfAllFeildman);
        return view('Backend.Cashier.Collections.daily-collection',['dailyCollectionOfAllFeildman'=>$dailyCollectionOfAllFeildman]);
    }
    public function todayFieldofficerCollection($id,$sheet){
        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];
        $fieldOfficerID=$id;
        $SheetNo=$sheet;

        $everyDayCollection=DB::table('saving_amounts')
            ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
            ->select('savings_account_infos.applicant_name','savings_account_infos.id as mid','saving_amounts.*')
            ->where('saving_amounts.field_man_id','=',$id)
            ->where('saving_amounts.sheet_no','=',$sheet)
            ->where('saving_amounts.status','=',0)
            ->orderBy('saving_amounts.id','desc')
            ->get();

        $sum=0;
        $loanSum=0;
        $service=0;
        foreach ($everyDayCollection as $everyDayCollectio){
            $sum=$sum+$everyDayCollectio->amount;

        }
        $sumOfDeposite=$sum;

        $everyDayLoanApplication=DB::table('loan_pay_amounts')
            ->join('savings_account_infos','savings_account_infos.id','=','loan_pay_amounts.account_no')
            ->select('savings_account_infos.applicant_name','loan_pay_amounts.*')
            ->where('loan_pay_amounts.status','=',0)
            ->where('loan_pay_amounts.field_man_id','=',$id)
            ->where('loan_pay_amounts.sheet_no','=',$sheet)
            ->orderBy('loan_pay_amounts.id','desc')
            ->get();

        foreach ($everyDayLoanApplication as $everyDay){
            $loanSum=$loanSum+$everyDay->amount;
            $service=$service+$everyDay->service_charge;

        }

        $sumOfDepositeService=$service;
        $sumOfDepositeLoanAmount=$loanSum;

//dd($everyDayLoanApplication);
        return view('Backend.Cashier.Collections.daily-field-man-collection',['everyDayCollection'=>$everyDayCollection,
            'everyDayLoanApplication'=>$everyDayLoanApplication,
            'sumOfDeposite'=>$sumOfDeposite,
            'sumOfDepositeService'=>$sumOfDepositeService,
            'sumOfDepositeLoanAmount'=>$sumOfDepositeLoanAmount,
            'fieldOfficerID'=>$fieldOfficerID,
            'SheetNo'=>$SheetNo,
        ]);
    }
    public function receiveMoney(Request $request){
        $sheet=$request->sheet_no;
        $Id=$request->id;
        $username=New User();
        $SavingsCollection=DB::table('saving_amounts')
            ->where('field_man_id','=',$Id)
            ->where('sheet_no','=',$sheet)
            ->where('status','=',0)
            ->sum('amount');

        $LoanCollection=DB::table('loan_pay_amounts')
            ->where('field_man_id','=',$Id)
            ->where('sheet_no','=',$sheet)
            ->where('status','=',0)
            ->sum('amount');

        $LoanService=DB::table('loan_pay_amounts')
            ->where('field_man_id','=',$Id)
            ->where('sheet_no','=',$sheet)
            ->where('status','=',0)
            ->sum('service_charge');

        return view('Backend.Cashier.Collections.sheet-receive',['sheet'=>$sheet,
            'Id'=>$Id,
            'SavingsCollection'=>$SavingsCollection,
            'LoanCollection'=>$LoanCollection,
            'LoanService'=>$LoanService,
            'username'=>$username]);
    }
    public function StoreReceiveMoney(Request $request){

        $savingsamount=SavingAmount::where('field_man_id','=',$request->field_officer_id)->where('sheet_no','=',$request->sheet_no)->where('status','=',0)->get();
        $loanamount=LoanPayAmount::where('field_man_id','=',$request->field_officer_id)->where('sheet_no','=',$request->sheet_no)->where('status','=',0)->get();

        foreach ($savingsamount as $item){
            $updateSavings=SavingAmount::find($item->id);
            $updateSavings->status=1;
            $updateSavings->save();
        }

        foreach ($loanamount as $item){
            $updateSavings=LoanPayAmount::find($item->id);
            $updateSavings->status=1;
            $updateSavings->save();
        }

        $storeForm=new SheetRecord();
        $storeForm->sheet_no=$request->sheet_no;
        $storeForm->field_officer_id=$request->field_officer_id;
        $storeForm->collection_date=$request->date;
        $storeForm->savings_amount=$request->savings;
        $storeForm->loan_amount=$request->loan_return;
        $storeForm->loan_service=$request->service_charge;
        $storeForm->additional_collection=$request->additional_collection;
        $storeForm->total=$request->total;
        $storeForm->cashier_id=Auth::id();
        $storeForm->save();
        return redirect('daily-field-officer-collection')->with('message','Information Saved Successfully');
    }
    public function CashierReceivedSheet(){
        $sheet=SheetRecord::where('status',0)->get();
        $FieldOfficerName=new User();
        return view('Backend.Cashier.Collections.details-sheet',['sheet'=>$sheet,'FieldOfficerName'=>$FieldOfficerName]);
    }
    public function editSheetForm($slug){
        $sheet=SheetRecord::where('slug',$slug)->first();
        $username=new User();
        return view('Backend.Cashier.Collections.edit-sheet',['sheet'=>$sheet,'username'=>$username]);
    }

    public function updateSheet(Request $request){
        $storeForm=SheetRecord::find($request->id);
        $storeForm->sheet_no=$request->sheet_no;
        $storeForm->field_officer_id=$request->field_officer_id;
        $storeForm->collection_date=$request->date;
        $storeForm->savings_amount=$request->savings;
        $storeForm->loan_amount=$request->loan_return;
        $storeForm->loan_service=$request->service_charge;
        $storeForm->additional_collection=$request->additional_collection;
        $storeForm->total=$request->total;
        $storeForm->cashier_id=Auth::id();
        $storeForm->save();

        return back()->with('message','Information Updated Successfully');
    }
    public function listOfSavingsDespatch(){
        $confirmedByAdmin=DB::table('savings_withdraws')
            ->join('savings_withdraw_forms','savings_withdraws.request_id','=','savings_withdraw_forms.id')
            ->join('savings_account_infos','savings_account_infos.id','=','savings_withdraw_forms.account_no')
            ->join('users','users.id','=','savings_withdraw_forms.field_man_id')
            ->where('savings_withdraws.status','=',1)
            ->select('users.name','users.id as FOID','savings_withdraws.*','savings_account_infos.id as accountNo','savings_account_infos.applicant_name')
            ->get();

        return view('Backend.Cashier.SavingsWithdraw.withdraw-savings-despatch',['confirmedByAdmin'=>$confirmedByAdmin]);
    }
    public function despatchedToDelivery($id){
        $staffs=User::where('role','=',3)->where('access',1)->get();
        $confirmedByAdmin=DB::table('savings_withdraws')
            ->join('savings_withdraw_forms','savings_withdraws.request_id','=','savings_withdraw_forms.id')
            ->join('savings_account_infos','savings_account_infos.id','=','savings_withdraw_forms.account_no')
            ->join('users','users.id','=','savings_withdraw_forms.field_man_id')
            ->where('savings_withdraws.id','=',$id)
            ->select('users.name','users.id as FOID','savings_withdraws.*','savings_account_infos.id as accountNo','savings_account_infos.applicant_name')
            ->first();
        $SumofMoney=DB::table('saving_amounts')
            ->where('member_id','=',$confirmedByAdmin->accountNo)
            ->where('status','=',1)
            ->sum('saving_amounts.amount');
        $allSavingsDetails=DB::table('saving_amounts')
            ->select('*')
            ->where('member_id','=',$confirmedByAdmin->accountNo)
            ->where('status','=',1)
            ->get();
        $savingsWithdraw = DB::table('savings_withdraw_forms')
            ->where('account_no','=',$confirmedByAdmin->accountNo)
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

        return view('Backend.Cashier.SavingsWithdraw.savings-despatch-comments',['SumofMoney'=>$SumofMoney,'allSavingsDetails'=>$allSavingsDetails,'staffs'=>$staffs,'confirmedByAdmin'=>$confirmedByAdmin,'currentBalance'=>$currentBalance]);
    }
    public function SaveDespatchSavings(Request $request){
        $todate=date('Y-m-d');
        $confirmedByAdmin=DB::table('savings_withdraws')
            ->join('savings_withdraw_forms','savings_withdraws.request_id','=','savings_withdraw_forms.id')
            ->join('savings_account_infos','savings_account_infos.id','=','savings_withdraw_forms.account_no')
            ->join('users','users.id','=','savings_withdraw_forms.field_man_id')
            ->where('savings_withdraws.id','=',$request->id)
            ->select('users.name','users.id as FOID','savings_withdraws.*','savings_account_infos.id as accountNo','savings_account_infos.applicant_name','savings_withdraw_forms.created_at as accountCreateDate')
            ->first();
        $savingsWithdraws=SavingsWithdraw::find($request->id);
        $savingsWithdraws->status=2;
        $savingsWithdraws->save();
        
        if($request->available_amount-$request->total==0){
        $AccountDismiss=SavingsAccountInfo::find($request->account_no);
        $AccountDismiss->verify=5;
        $AccountDismiss->save();
        }
        $savings_despatch=new CashDespatchSaving();
        $savings_despatch->savings_withdraw_id=$request->id;
        $savings_despatch->cashier_id=Auth::user()->id;
        $savings_despatch->total_despatched=$request->total;
        $savings_despatch->note=$request->note;
        $savings_despatch->despatched_date=$todate;
        $savings_despatch->save();
        return redirect('despatched-savings-money')->with('mass','Amount Despatched Successfully!');

    }
    public function AlreadyDespatched(){
        $alreadyDespatched=DB::table('cash_despatch_savings')
            ->join('savings_withdraws','savings_withdraws.id','=','cash_despatch_savings.savings_withdraw_id')
            ->join('savings_withdraw_forms','savings_withdraw_forms.id','=','savings_withdraws.request_id')
            ->join('savings_account_infos','savings_account_infos.id','=','savings_withdraw_forms.account_no')
            ->join('users','users.id','=','savings_withdraw_forms.field_man_id')
            ->select('savings_account_infos.applicant_name','savings_account_infos.id as accountNo','cash_despatch_savings.*','savings_withdraw_forms.field_man_id','users.name')
            ->where('cash_despatch_savings.cashier_id','=',Auth::user()->id)
            ->orderBy('cash_despatch_savings.id','desc')
            ->get();

        return view('Backend.Cashier.SavingsWithdraw.all-despatched-savings',['alreadyDespatched'=>$alreadyDespatched]);
    }

// Additional Expense Related Functions are starting from here
    public function viewAdditionalExpence(){
//        if(!Gate::allows(['isManager'])){
//            abort('404','you cannot access here');
//        }
        $allCosts=DB::table('additional_costs')
            ->join('users','users.id','=','additional_costs.created_by')
            ->select('additional_costs.*','users.name')
            ->orderBy('id','desc')
            ->limit(60)
            ->get();
        $costings=CostCategory::where('status',1)->get();
        $CategoryName=new CostCategory();
        return view('Backend.Cashier.AdditionalCost.additional-cost-form',['CategoryName'=>$CategoryName,'allCosts'=>$allCosts,'costings'=>$costings]);
    }
    public function createAdditionalCost(Request $request){
//        if(!Gate::allows(['isManager'])){
//            abort('404','you cannot access here');
//        }
        $this->validate($request,[
            'cost_amount'=>'required|numeric',
            'date'=>'required',
            'description'=>'required|max:1000',
            'voucher_no'=>'required|unique:additional_costs'
        ]);

        $additionalCost=new AdditionalCost();
        $additionalCost->additional_cost=$request->cost_amount;
        $additionalCost->additional_cost_category=$request->costing_category;
        $additionalCost->voucher_no=$request->voucher_no;
        $additionalCost->date_of_cost=$request->date;
        $additionalCost->description=$request->description;
        $additionalCost->created_by=Auth::user()->id;
        $additionalCost->save();

        return back()->with('message','Additional Cost added Successfully!');
    }
    public function editAdditionalCost($id){
//        if(!Gate::allows(['isManager'])){
//            abort('404','you cannot access here');
//        }
        $editInfo=AdditionalCost::find($id);
        $costings=CostCategory::where('status',1)->get();
        return view('Backend.Cashier.AdditionalCost.edit-additional-cost',['costings'=>$costings,'editInfo'=>$editInfo]);
    }
    public function UpdateAdditioanlCost(Request $request){
//        if(!Gate::allows(['isManager'])){
//            abort('404','you cannot access here');
//        }
        $this->validate($request,[
            'cost_amount'=>'required|numeric',
            'date'=>'required',
            'description'=>'required|max:1000',
        ]);
        $editInfo=AdditionalCost::find($request->id);
        $editInfo->additional_cost=$request->cost_amount;
        $editInfo->additional_cost_category=$request->costing_category;
        $editInfo->voucher_no=$request->voucher_no;
        $editInfo->date_of_cost=$request->date;
        $editInfo->description=$request->description;
        $editInfo->created_by=Auth::user()->id;
        $editInfo->save();

        return redirect('additional-cost-form')->with('message','Expense Info Updated successfully!');
    }
    public function viewAdditionalCostcategory(){
        $allCategory=CostCategory::all();
        $name=new User();
        return view('Backend.Cashier.AdditionalCost.cost-category-form',['allCategory'=>$allCategory,'name'=>$name]);

    }
    public function createCostCategory(Request $request){
        $this->validate($request,[
            'category'=>'required|unique:cost_categories',
        ]);

        $additionalCategory=new CostCategory();
        $additionalCategory->category=$request->category;
        $additionalCategory->status=$request->status;
        $additionalCategory->admin_id=Auth::user()->id;
        $additionalCategory->save();

        return back()->with('message','Additional Cost Category added Successfully!');
    }
    public function inactiveCostCategory($id){
        if(!Gate::allows('isCashier')){
            abort('404','you cannot access here');
        }
        $scheme = CostCategory::find($id);
        $scheme->status = 0;
        $scheme->save();
        return back()->with('message', 'Cost Inactivated successfully');
    }
    public function activeCostCategory($id){
        if(!Gate::allows('isCashier')){
            abort('404','you cannot access here');
        }
        $scheme = CostCategory::find($id);
        $scheme->status = 1;
        $scheme->save();
        return back()->with('message', 'Cost Activated successfully');
    }

//Additional Expense Related Functions Ends here

// Additional Collection Related Functions are starting from here
    public function createCategoryAdditionalCollection(Request $request){
//        if(!Gate::allows(['isManager'])){
//            abort('404','you cannot access here');
//        }

        $this->validate($request,[
            'category'=>'required|unique:collection_categories',
        ]);

        $additionalCategory=new CollectionCategory();
        $additionalCategory->category=$request->category;
        $additionalCategory->status=$request->status;
        $additionalCategory->admin_id=Auth::user()->id;
        $additionalCategory->save();

        return back()->with('message','Additional Collection Category added Successfully!');
    }
    public function inactiveCollectionCategory($id){
        if(!Gate::allows('isCashier')){
            abort('404','you cannot access here');
        }
        $scheme = CollectionCategory::find($id);
        $scheme->status = 0;
        $scheme->save();
        return back()->with('message', 'Category Inactivated successfully');
    }
    public function activeCollectionCategory($id){
        if(!Gate::allows('isCashier')){
            abort('404','you cannot access here');
        }
        $scheme = CollectionCategory::find($id);
        $scheme->status = 1;
        $scheme->save();
        return back()->with('message', 'Category Activated successfully');
    }
    public function viewAdditionalcategory(){
        $allCategory=CollectionCategory::all();
        $name=new User();
        return view('Backend.Cashier.AdditionalCollection.collection-category-form',['allCategory'=>$allCategory,'name'=>$name]);
    }
    public function viewAdditionalCollection(){
//        if(!Gate::allows(['isManager'])){
//            abort('404','you cannot access here');
//        }
        $allCosts=DB::table('additional_collections')
            ->join('users','users.id','=','additional_collections.created_by')
            ->select('additional_collections.*','users.name')
            ->limit(100)
            ->get();
        $collection=new CollectionCategory();
        $ApplicantName=new SavingsAccountInfo();

        $categories=CollectionCategory::where('status',1)->get();

        return view('Backend.Cashier.AdditionalCollection.additional-collection-form',['collection'=>$collection,'allCosts'=>$allCosts,'categories'=>$categories,'ApplicantName'=>$ApplicantName]);
    }
    public function createAdditionalCollection(Request $request){
//        if(!Gate::allows(['isManager'])){
//            abort('404','you cannot access here');
//        }
        $this->validate($request,[
            'cost_amount'=>'required|numeric',
            'date'=>'required',
            'description'=>'required|max:1000',
        ]);

        $additionalCost=new AdditionalCollection();
        $additionalCost->additional_cost=$request->cost_amount;
        $additionalCost->collection_category=$request->collection_category;
        $additionalCost->date_of_cost=$request->date;
        $additionalCost->description=$request->description;
        $additionalCost->created_by=Auth::user()->id;
        $additionalCost->save();

        return back()->with('message','Additional Collection added Successfully!');
    }
    public function editAdditionalCollection($id){
//        if(!Gate::allows(['isManager'])){
//            abort('404','you cannot access here');
//        }
        $editInfo=AdditionalCollection::find($id);
        $categories=CollectionCategory::where('status',1)->get();
        return view('Backend.Cashier.AdditionalCollection.edit-additional-collection',['categories'=>$categories,'editInfo'=>$editInfo]);
    }
    public function UpdateAdditionalCollection(Request $request){
//        if(!Gate::allows(['isManager'])){
//            abort('404','you cannot access here');
//        }
        $this->validate($request,[
            'cost_amount'=>'required|numeric',
            'date'=>'required',
            'description'=>'required|max:1000',
        ]);
        $editInfo=AdditionalCollection::find($request->id);
        $editInfo->additional_cost=$request->cost_amount;
        $editInfo->collection_category=$request->collection_category;
        $editInfo->date_of_cost=$request->date;
        $editInfo->description=$request->description;
        $editInfo->created_by=Auth::user()->id;
        $editInfo->save();

        return redirect('additional-collection-form')->with('message','Additional Collection Updated successfully!');
    }

//Additional Collection Related Functions Ends here

    public function getCashierCollection(){

        return view('Backend.Cashier.cashierCollection.date-of-collection-form');
    }
    public function CashierCollectionsData(Request $request){

        $data=SheetRecord::where('collection_date',$request->date)->get();
        $FoN=new User();
        $from=$request->date;

        return view('Backend.Cashier.cashierCollection.date-of-collection-form',['data'=>$data,'FoN'=>$FoN,'from'=>$from]);
    }
    public function CashierCollectionsGeneratePdf(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }

        if($request->date!==null){
            $sheet = $request->date;
            $savings = SheetRecord::where('collection_date',$request->date)->get();

            $foN=new User();
            $data = array_merge(['FoN'=>$foN,'savings' => $savings,'sheet'=>$sheet]);
            $invoice_render = View::make('Backend.Cashier.cashierCollection.date-of-collection-pdf', $data)->render();
            $pdf = new Dompdf();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($invoice_render);
            return $pdf->stream();
        }else{
            print_r('Something Wrong!try Again');
        }
    }
}
