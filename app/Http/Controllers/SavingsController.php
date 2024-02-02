<?php

namespace App\Http\Controllers;


use App\LoanApplication;
use App\LoanPayAmount;
use App\SavingAmount;
use App\SavingsWithdrawForm;
use App\SavingsAccountInfo;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\LoanDispatch;
use PDF;
use View;
use App;
use Gate;

class SavingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function showForm(){
        $MembersById=DB::table('savings_account_infos')
            ->select('*')
            ->where('verify','=', 1)
            ->get();

        return view('Backend.FieldOfficer.Savings.savings-form',['MembersById'=>$MembersById]);
    }
    public function memberById(Request $request){
       
        $MembersById[0]=DB::table('savings_account_infos')
            ->select('*')
            ->where('id','=', $request->id)
            ->where('verify','=', 1)
            ->first();
         
        if($MembersById[0]){
            $date1 = $MembersById[0]->created_at;
            $date2 = date('Y-m-d H:i:s');

            $diff = abs(strtotime($date2) - strtotime($date1));

            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            if($years==0){
                $MembersById[5]= ($months. " months ,". $days." Days ");
            }else{
                $MembersById[5]= ($years. " Year ". $months. " Months ". $days." Days");
            }
        

        $MembersById[1]=LoanApplication::where('account_no',$request->id)->where('status',3)->first();
        if ($MembersById[1]) {
            $MembersById[2] = LoanDispatch::where('loan_id', $MembersById[1]->id)->first();
            $loanAmount = $MembersById[2]->loan_amount;
            $serviceCharge = $MembersById[2]->total_amount_with_charge - $MembersById[2]->loan_amount;
            $loanPaidAmount = LoanPayAmount::where('loan_id', $MembersById[1]->id)->where('account_no', $request->id)->where('status','=',1)->sum('amount');
            $loanPaidService = LoanPayAmount::where('loan_id', $MembersById[1]->id)->where('account_no', $request->id)->where('status','=',1)->sum('service_charge');
            $MembersById[3] = $serviceCharge - $loanPaidService;
            $MembersById[4] = $loanAmount - $loanPaidAmount;
        }
        return response(json_encode($MembersById));
    }else{
                $MembersById[2]="This Account is Not Authorised! Contact Authority!";
                return response(json_encode($MembersById));
            }
    }
    public function storeMoney(Request $request)
    {
      
        $this->validate($request, [
            'member_id' => 'required',
            'amount' => 'required',
            'sheet_no' => 'required',
        ], [
            'amount.required' => 'Amount of money cannot be Blank!',
        ]);
        
        $val=DB::table('sheet_records')
        ->select('sheet_no')
        ->get();
        
          foreach($val as $data)
          {
            if($data->sheet_no==$request->sheet_no){
                return back()->with('Negmessage','Duplicate Sheet Number Entry!!!');
            }
          }
          
  
            $memberInfo=SavingsAccountInfo::where('id',$request->member_id)->first();
            if($memberInfo==null){
                return back()->with('Negmessage', 'Account Number Not Found!Contact Authority!');
            }
        if ($memberInfo->verify==1) {
           

            if (isset($request->loan_payment)) {
                
                $loanPaidAmount = LoanPayAmount::where('loan_id', $request->loan_id)->where('account_no', $request->member_id)->sum('amount');
                $loanPaidService = LoanPayAmount::where('loan_id', $request->loan_id)->where('account_no', $request->member_id)->sum('service_charge');
                $loanConsidered = LoanDispatch::where('loan_id', $request->loan_id)->first();
                

                if ($loanConsidered->loan_amount >= ($loanPaidAmount + $request->loan_payment) && (($loanConsidered->total_amount_with_charge - $loanConsidered->loan_amount) >= ($loanPaidService + $request->service_charge))) {
                  

                    if ($loanConsidered->loan_amount < ($loanPaidAmount + $request->loan_payment) && (($loanConsidered->total_amount_with_charge - $loanConsidered->loan_amount) < ($loanPaidService + $request->service_charge))) {
                        
                        
                        return back()->with('Negmessage', 'PLease Close the loan Before savings Store! Contact with supervisor to close the loan first!');
                    }
                    
                    $loanAmount = new LoanPayAmount();
                    $loanAmount->loan_id = $request->loan_id;
                    $loanAmount->account_no = $request->member_id;
                    $loanAmount->field_man_id = Auth::user()->id;
                    $loanAmount->amount = $request->loan_payment;
                    $loanAmount->service_charge = $request->service_charge;
                    $loanAmount->sheet_no = $request->sheet_no;
                    $loanAmount->save();
                } else {
                   
                    return back()->with('Negmessage', 'Input Amount Exceeds Loan Amounts!please check the loan and service charge!!');
                }
            }
            $storeMoney = new SavingAmount();
            $storeMoney->member_id = $request->member_id;
            $storeMoney->amount = $request->amount;
            $storeMoney->sheet_no = $request->sheet_no;
            $storeMoney->field_man_id = Auth::user()->id;
            $storeMoney->save();
            return back()->with('message', 'Amount Deposited Successfully!');
        }else{
            return back()->with('Negmessage', 'Account Not Authorised!Contact Authority!');
        }
    }
    public function todaySavings(){
        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];

        if(Gate::any(['isSuper','isCashier','isSupervisor'])){
            $everyDayCollection=DB::table('saving_amounts')
                ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
                ->select('savings_account_infos.applicant_name','savings_account_infos.id as mid','saving_amounts.*')
                ->where('saving_amounts.status','=',0)
                ->get();
        }else{
            $everyDayCollection=DB::table('saving_amounts')
                ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
                ->select('savings_account_infos.applicant_name','savings_account_infos.id as mid','saving_amounts.*')
                ->where('saving_amounts.field_man_id','=',Auth::user()->id)
                ->where('saving_amounts.status','=',0)
                ->orderBy('saving_amounts.id','desc')
                ->get();

        }



        $sum=0;
        $loanSum=0;
        $service=0;
        foreach ($everyDayCollection as $everyDayCollectio){
            $sum=$sum+$everyDayCollectio->amount;

        }
        $sumOfDeposite=$sum;

        if(Gate::any(['isSuper','isCashier','isSupervisor'])) {

            $everyDayLoanApplication = DB::table('loan_pay_amounts')
                ->join('savings_account_infos', 'savings_account_infos.id', '=', 'loan_pay_amounts.account_no')
                ->select('savings_account_infos.applicant_name', 'loan_pay_amounts.*')
                ->where('loan_pay_amounts.status', '=', 0)
                ->get();
        }else{
            $everyDayLoanApplication = DB::table('loan_pay_amounts')
                ->join('savings_account_infos', 'savings_account_infos.id', '=', 'loan_pay_amounts.account_no')
                ->select('savings_account_infos.applicant_name', 'loan_pay_amounts.*')
                ->where('loan_pay_amounts.status', '=', 0)
                ->where('loan_pay_amounts.field_man_id', '=', Auth::user()->id)
                ->orderBy('loan_pay_amounts.id', 'desc')
                ->get();
        }
        foreach ($everyDayLoanApplication as $everyDay){
            $loanSum=$loanSum+$everyDay->amount;
            $service=$service+$everyDay->service_charge;

        }

        $sumOfDepositeService=$service;
        $sumOfDepositeLoanAmount=$loanSum;

//dd($everyDayLoanApplication);
        return view('Backend.FieldOfficer.Savings.current-day-savings',['everyDayCollection'=>$everyDayCollection,
                                                                            'everyDayLoanApplication'=>$everyDayLoanApplication,
                                                                            'sumOfDeposite'=>$sumOfDeposite,
                                                                            'sumOfDepositeService'=>$sumOfDepositeService,
                                                                            'sumOfDepositeLoanAmount'=>$sumOfDepositeLoanAmount,
            ]);

    }
    public function editTodaySavings($slug){
        $updateInfo=SavingAmount::where('slug',$slug)->first();
        
       return view('Backend.FieldOfficer.Savings.edit-savings-form',['updateInfo'=>$updateInfo]);
    }
    public function deleteTodaySavings($slug){
        $updateInfo=SavingAmount::where('slug',$slug)->delete();
       return redirect('/today-saving-collection')->with('Negmessage','Savings Info Deleted Permanently!');
    }
    public function updateDailysavings(Request $request){

        $this->validate($request, [
            'amount'=>'required',
            'sheet_no'=>'required',
        ],[
            'amount.required'=>'Amount of money cannot be Blank!',
        ]);
        $val=DB::table('sheet_records')
        ->select('sheet_no')
        ->get();
        
          foreach($val as $data)
          {
            if($data->sheet_no==$request->sheet_no){
                return back()->with('Negmessage','Duplicate Sheet Number Entry!!!');
            }
          }
        $storeMoney=SavingAmount::find($request->id);
        $storeMoney->amount=$request->amount;
        $storeMoney->sheet_no=$request->sheet_no;
        $storeMoney->field_man_id=Auth::user()->id;
        $storeMoney->save();

        return redirect('/today-saving-collection')->with('message','Savings Info Updated!');
    }
    public function editDailyLoanDeposite($slug){
        $updateInfo=LoanPayAmount::where('slug',$slug)->first();
        return view('Backend.FieldOfficer.Loan.edit-form-loan-collection',['updateInfo'=>$updateInfo]);
    }
    public function deleteDailyLoanDeposite($slug){
        $updateInfo=LoanPayAmount::where('slug',$slug)->delete();
        return redirect('/today-saving-collection')->with('Negmessage','Loan Transaction Deleted permanently!');
    }
    public function updateDailyLoanDeposite(Request $request){
        $update=LoanPayAmount::find($request->id);
        $update->amount=$request->amount;
        $update->service_charge=$request->service_charge;
        $update->sheet_no=$request->sheet_no;
        $update->save();

        return redirect('/today-saving-collection')->with('mass','Loan Amount Updated Successfully!');
    }
    public function savingsByDate(){
        $data=null;
        $sheet_no=null;
        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];
        $search=SavingAmount::whereDate('created_at',$today)->where('field_man_id',Auth::user()->id)->get();

        $loanCollection=LoanPayAmount::whereDate('created_at',$today)->where('field_man_id',Auth::user()->id)->get();

        return view('back.FieldOfficer.savings-info-by-date',['search'=>$search,'loanCollection'=>$loanCollection]);
    }
    public function searchSavings(Request $request){

        if ($request->date && $request->sheet_no){
            $search=SavingAmount::whereDate('created_at',$request->date)->where('sheet_no',$request->sheet_no)->where('field_man_id',Auth::user()->id)->get();
            $loanCollection=LoanPayAmount::whereDate('created_at',$request->date)->where('sheet_no',$request->sheet_no)->where('field_man_id',Auth::user()->id)->get();

            $date=$request->date;
            $sheet_no=$request->sheet_no;
            return view('back.FieldOfficer.savings-info-by-date',['search'=>$search,'date'=>$date,'sheet_no'=>$sheet_no,'loanCollection'=>$loanCollection]);

        }elseif ($request->sheet_no){
            $search=SavingAmount::where('sheet_no',$request->sheet_no)->where('field_man_id',Auth::user()->id)->get();
            $loanCollection=LoanPayAmount::where('sheet_no',$request->sheet_no)->where('field_man_id',Auth::user()->id)->get();
            $sheet_no=$request->sheet_no;
            return view('back.FieldOfficer.savings-info-by-date',['search'=>$search,'sheet_no'=>$sheet_no,'loanCollection'=>$loanCollection]);
        }elseif ($request->date){
            $search=SavingAmount::whereDate('created_at',$request->date)->where('field_man_id',Auth::user()->id)->get();
            $loanCollection=LoanPayAmount::whereDate('created_at',$request->date)->where('field_man_id',Auth::user()->id)->get();
            $date=$request->date;
            return view('back.FieldOfficer.savings-info-by-date',['search'=>$search,'date'=>$date,'loanCollection'=>$loanCollection]);
        } else{
            $search=SavingAmount::where('field_man_id',Auth::user()->id)->get();
            $loanCollection=LoanPayAmount::where('field_man_id',Auth::user()->id)->get();
            return view('back.FieldOfficer.savings-info-by-date',['search'=>$search,'loanCollection'=>$loanCollection]);
        }

    }
    public function printSavings($date,$sheet){
        $search=DB::table('saving_amounts')
            ->whereDate('created_at','=',$date)
            ->where('sheet_no','=',$sheet)
            ->where('field_man_id',Auth::user()->id)
            ->get();
        $loanCollection=DB::table('loan_pay_amounts')
            ->whereDate('created_at','=',$date)
            ->where('sheet_no','=',$sheet)
            ->where('field_man_id',Auth::user()->id)
            ->get();
       // dd($search);

        $invoice_render = View::make('back.FieldOfficer.ok',['search'=>$search,'sheet'=>$sheet,'date'=>$date,'loanCollection'=>$loanCollection])->render();
       // dd($invoice_render);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();

    }
    public function printByDateSavings($date){
        $search=DB::table('saving_amounts')
            ->whereDate('created_at','=',$date)
            ->where('field_man_id',Auth::user()->id)
            ->get();
        $loanCollection=DB::table('loan_pay_amounts')
            ->whereDate('created_at','=',$date)
            ->where('field_man_id',Auth::user()->id)
            ->get();

        // dd($search);

        $invoice_render = View::make('back.FieldOfficer.ok',['search'=>$search,'date'=>$date,'loanCollection'=>$loanCollection])->render();
        // dd($invoice_render);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();

    }
    public function printBySheetSavings($sheet){
        $search=DB::table('saving_amounts')
            ->where('sheet_no','=',$sheet)
            ->where('field_man_id',Auth::user()->id)
            ->get();
        $loanCollection=DB::table('loan_pay_amounts')
            ->where('sheet_no','=',$sheet)
            ->where('field_man_id',Auth::user()->id)
            ->get();
        //dd($search);

        $invoice_render = View::make('back.FieldOfficer.ok',['search'=>$search,'sheet'=>$sheet,'loanCollection'=>$loanCollection])->render();
        // dd($invoice_render);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function savingsWithdrawForm(){
        
         
        
        
        $MembersById=DB::table('savings_account_infos')
            ->select('*')
            ->where('verify','=', 1)
            ->get();
        $categories=App\CollectionCategory::where('status',1)->get();
        return view('Backend.FieldOfficer.Savings.withdraw-savings-form',['MembersById'=>$MembersById,'categories'=>$categories]);
    }
    public function memberInfoForWithdraw(Request $request){
        $MembersById[0]=DB::table('savings_account_infos')
            ->select('*')
            ->where('id','=', $request->id)
            ->where('verify','=', 1)
            ->first();
        $MembersById[1]=LoanApplication::select('id')->where('account_no',$request->id)->where('status',3)->first();
        if($MembersById[1]){
            $MembersById[3]=DB::table('loan_pay_amounts')
            ->where('loan_id','=',$MembersById[1]->id)
            ->where('status','=',1)
            ->sum('amount');
            $MembersById[5]=DB::table('loan_pay_amounts')
            ->where('loan_id','=',$MembersById[1]->id)
            ->where('status','=',1)
            ->sum('service_charge');
            $MembersById[6]=$MembersById[5]+$MembersById[3];
            
            $MembersById[4]=DB::table('loan_dispatches')
            ->select('*')
            ->where('loan_id','=',$MembersById[1]->id)
            ->first();
            $MembersById[4]=$MembersById[4]->total_amount_with_charge;
            
            
        }
        
        $MembersById[2]=DB::table('saving_amounts')
            ->where('member_id','=',$request->id)
            ->where('status','=',1)
            ->sum('amount');
            
        $savingsWithdraw = DB::table('savings_withdraw_forms')
            ->where('account_no','=',$request->id)
            ->where('status','=',1)
            ->get(); 
            
            
           
            if($savingsWithdraw != null){
                 $sum=0;
            foreach($savingsWithdraw as $me){
            
                $savings = DB::table('savings_withdraws')
                    ->where('request_id','=',$me->id)
                    ->where('status','=',2)
                    ->select('total')
                    ->first();  
                   if(isset($savings->total)){
                    $sum += $savings->total;
                    }
                }
                
                $MembersById[2]=($MembersById[2]- $sum);
                
            }
           
            
        
        return response(json_encode($MembersById));
    }
    public function SaveWithdrawInformation(Request $request){

        $acInfo=SavingsAccountInfo::find($request->account_no);

        $d=date('Y-m-d');
        $todate=strtotime($d);
        $startdate=strtotime($acInfo->created_at);

        $diff = abs($todate - $startdate);
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24)
            / (30*60*60*24));

        $days = floor(($diff - $years * 365*60*60*24 -
                $months*30*60*60*24)/ (60*60*24));
                
            $SavingsAmount=DB::table('saving_amounts')
            ->where('member_id','=',$request->account_no)
            ->where('status','=',1)
            ->sum('amount');
                
                if($request->amount>$SavingsAmount){
                    return back()->with('Negmessage','Withdraw Amount Cannot be more than savings!');
                }

        $saveInfo=new SavingsWithdrawForm();
        $saveInfo->account_no=$request->account_no;
        $saveInfo->total_savings=$request->amount;//this amount is request money for partial or full withdraw
        $saveInfo->mobile=$request->mobile;
        $saveInfo->form_fee=$request->form_fee;
        $saveInfo->note=$request->note;
        $saveInfo->field_man_id=Auth::user()->id;
        $saveInfo->days_of_saving=$days;
        $saveInfo->save();

        $newadditional=new App\AdditionalCollection();
        $newadditional->additional_cost=$request->form_fee;
        $newadditional->collection_category=$request->category;
        $newadditional->date_of_cost=date('Y-m-d');
        $newadditional->description="Account No: ".$saveInfo->id.". Account Close Form fee";
        $newadditional->created_by=Auth::user()->id;
        $newadditional->save();

        return back()->with('message','Request Submitted Successfully!');
    }
}
