<?php

namespace App\Http\Controllers;

use App\LoanPayAmount;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;
use View;
use App\LoanApplication;
use App;
use App\SavingsAccountInfo;
use App\User;
class ReportController extends Controller
{
    public function ExpenseReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){
            $from=$request->from;
            $to=$request->to;
            $expenses=DB::table('additional_costs')
                ->join('users','users.id','=','additional_costs.created_by')
                ->whereBetween('additional_costs.date_of_cost',[$request->from,$request->to])
                ->select('additional_costs.*','users.name')
                ->get();
            return view('Backend.Reports.Cashier.Expense.additional-costs-report',['expenses'=>$expenses,'from'=>$from,'to'=>$to]);
        }else{
            return view('Backend.Reports.Cashier.Expense.additional-costs-report');
        }

    }
    public function DailyExpenseReport(Request $request){
         if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->date!==null){
            $from=$request->date;
            $expenses=DB::table('additional_costs')
                ->join('users','users.id','=','additional_costs.created_by')
                ->where('additional_costs.date_of_cost',$request->date)
                ->select('additional_costs.*','users.name')
                ->get();
            $check="checked";
            return view('Backend.Reports.Cashier.Expense.additional-costs-report',['expenses'=>$expenses,'from'=>$from,'check'=>$check]);
        }else{
            return view('Backend.Reports.Cashier.Expense.additional-costs-report');
        }

    }
    public function PfdOfExpenseReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $expenses=DB::table('additional_costs')
            ->join('users','users.id','=','additional_costs.created_by')
            ->whereBetween('additional_costs.date_of_cost',[$request->from,$request->to])
            ->select('additional_costs.*','users.name')
            ->get();
        $from=$request->from;
        $to=$request->to;
        $totalCost=0;

        foreach ($expenses as $item){
            $totalCost+=$item->additional_cost;
        }
        $data = array_merge(['from'=>$from,'to'=>$to,'expenses'=>$expenses,'totalCost' => $totalCost]);
        $invoice_render = View::make('Backend.Reports.Cashier.Expense.additional-expense-report-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function PfdOfDailyExpenseReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $expenses=DB::table('additional_costs')
            ->join('users','users.id','=','additional_costs.created_by')
            ->where('additional_costs.date_of_cost',$request->from)
            ->select('additional_costs.*','users.name')
            ->get();
        $from=$request->from;
        $totalCost=0;

        foreach ($expenses as $item){
            $totalCost+=$item->additional_cost;
        }
        $data = array_merge(['from'=>$from,'expenses'=>$expenses,'totalCost' => $totalCost]);
        $invoice_render = View::make('Backend.Reports.Cashier.Expense.daily-additional-expense-report-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }


    public function CollectionReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){
            $from=$request->from;
            $to=$request->to;
            $expenses=DB::table('additional_collections')
                ->join('users','users.id','=','additional_collections.created_by')
                ->whereBetween('additional_collections.date_of_cost',[$request->from,$request->to])
                ->select('additional_collections.*','users.name')
                ->get();
            return view('Backend.Reports.Cashier.Collection.additional-collection-report',['expenses'=>$expenses,'from'=>$from,'to'=>$to]);
        }else{
            return view('Backend.Reports.Cashier.Collection.additional-collection-report');
        }
    }
    public function DailyCollectionReport(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->date!==null){
            $from=$request->date;
            $expenses=DB::table('additional_collections')
                ->join('users','users.id','=','additional_collections.created_by')
                ->where('additional_collections.date_of_cost',$request->date)
                ->select('additional_collections.*','users.name')
                ->get();
            $check="checked";
            return view('Backend.Reports.Cashier.Collection.additional-collection-report',['expenses'=>$expenses,'from'=>$from,'check'=>$check]);
        }else{
            return view('Backend.Reports.Cashier.Collection.additional-collection-report');
        }

    }
    public function PfdOfCollectionReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $expenses=DB::table('additional_collections')
            ->join('users','users.id','=','additional_collections.created_by')
            ->whereBetween('additional_collections.date_of_cost',[$request->from,$request->to])
            ->select('additional_collections.*','users.name')
            ->get();
        $from=$request->from;
        $to=$request->to;
        $totalCost=0;

        foreach ($expenses as $item){
            $totalCost+=$item->additional_cost;
        }
        $data = array_merge(['from'=>$from,'to'=>$to,'expenses'=>$expenses,'totalCost' => $totalCost]);
        $invoice_render = View::make('Backend.Reports.Cashier.Collection.additional-collection-report-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function PfdOfDailyCollectionReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $expenses=DB::table('additional_collections')
            ->join('users','users.id','=','additional_collections.created_by')
            ->where('additional_collections.date_of_cost',$request->from)
            ->select('additional_collections.*','users.name')
            ->get();
        $from=$request->from;
        $totalCost=0;

        foreach ($expenses as $item){
            $totalCost+=$item->additional_cost;
        }
        $data = array_merge(['from'=>$from,'expenses'=>$expenses,'totalCost' => $totalCost]);
        $invoice_render = View::make('Backend.Reports.Cashier.Collection.daily-additional-collection-report-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }


    public function SavingsReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){
            $from=$request->from;
            $to=$request->to;
            $expenses=DB::table('saving_amounts')
                ->join('users','users.id','=','saving_amounts.field_man_id')
                ->whereBetween('saving_amounts.created_at',[$request->from,$request->to])
                ->select('saving_amounts.*','users.name')
                ->get();
            $userName=New  App\SavingsAccountInfo();
            return view('Backend.Reports.Cashier.Savings.savings-report',['expenses'=>$expenses,'from'=>$from,'to'=>$to,'userName'=> $userName]);
        }else{
            return view('Backend.Reports.Cashier.Savings.savings-report');
        }
    }
    public function DailySavingsReport(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->date!==null){
            $from=$request->date;
            $expenses=DB::table('saving_amounts')
                ->join('users','users.id','=','saving_amounts.field_man_id')
                ->whereDate('saving_amounts.created_at',$request->date)
                ->select('saving_amounts.*','users.name')
                ->get();
            $userName=New App\SavingsAccountInfo();
            $check="checked";
            return view('Backend.Reports.Cashier.Savings.savings-report',['expenses'=>$expenses,'from'=>$from,'check'=>$check,'userName'=> $userName]);
        }else{
            return view('Backend.Reports.Cashier.Savings.savings-report');
        }

    }
    public function PfdOfSavingsReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $expenses=DB::table('saving_amounts')
            ->join('users','users.id','=','saving_amounts.field_man_id')
            ->whereBetween('saving_amounts.created_at',[$request->from,$request->to])
            ->select('saving_amounts.*','users.name')
            ->get();
        $from=$request->from;
        $to=$request->to;
        $totalCost=0;
        $userName=New App\SavingsAccountInfo();
        foreach ($expenses as $item){
            $totalCost+=$item->amount;
        }
        $data = array_merge(['from'=>$from,'to'=>$to,'expenses'=>$expenses,'totalCost' => $totalCost,'userName'=> $userName]);
        $invoice_render = View::make('Backend.Reports.Cashier.Savings.savings-report-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function PfdOfDailySavingsReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }

        $expenses=DB::table('saving_amounts')
            ->join('users','users.id','=','saving_amounts.field_man_id')
            ->whereDate('saving_amounts.created_at',$request->from)
            ->select('saving_amounts.*','users.name')
            ->get();
        //dd($expenses);
        $from=$request->from;
        $totalCost=0;
        $userName=New  App\SavingsAccountInfo();

        foreach ($expenses as $item){
            $totalCost+=$item->amount;
        }
        $data = array_merge(['from'=>$from,'expenses'=>$expenses,'totalCost' => $totalCost,'userName'=>$userName]);
        $invoice_render = View::make('Backend.Reports.Cashier.Savings.daily-savings-report-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }


    public function LoanReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){
            $from=$request->from;
            $to=$request->to;
            $expenses=DB::table('loan_pay_amounts')
                ->join('users','users.id','=','loan_pay_amounts.field_man_id')
                ->whereBetween('loan_pay_amounts.created_at',[$request->from,$request->to])
                ->select('loan_pay_amounts.*','users.name')
                ->get();
            $userName=New  App\SavingsAccountInfo();
            return view('Backend.Reports.Cashier.Loan.loan-report',['expenses'=>$expenses,'from'=>$from,'to'=>$to,'userName'=> $userName]);
        }else{
            return view('Backend.Reports.Cashier.Loan.loan-report');
        }
    }
    public function DailyLoanReport(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->date!==null){
            $from=$request->date;
            $expenses=DB::table('loan_pay_amounts')
                ->join('users','users.id','=','loan_pay_amounts.field_man_id')
                ->whereDate('loan_pay_amounts.created_at',$request->date)
                ->select('loan_pay_amounts.*','users.name')
                ->get();
            $userName=New App\SavingsAccountInfo();
            $check="checked";
            return view('Backend.Reports.Cashier.Loan.loan-report',['expenses'=>$expenses,'from'=>$from,'check'=>$check,'userName'=> $userName]);
        }else{
            return view('Backend.Reports.Cashier.Loan.loan-report');
        }

    }
    public function PfdOfLoanReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $expenses=DB::table('loan_pay_amounts')
            ->join('users','users.id','=','loan_pay_amounts.field_man_id')
            ->whereBetween('loan_pay_amounts.created_at',[$request->from,$request->to])
            ->select('loan_pay_amounts.*','users.name')
            ->get();
        $from=$request->from;
        $to=$request->to;
        $totalCost=0;
        $userName=New App\SavingsAccountInfo();
        foreach ($expenses as $item){
            $totalCost+=$item->amount;
        }
        $data = array_merge(['from'=>$from,'to'=>$to,'expenses'=>$expenses,'totalCost' => $totalCost,'userName'=> $userName]);
        $invoice_render = View::make('Backend.Reports.Cashier.Loan.loan-report-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function PfdOfDailyLoanReports(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }

        $expenses=DB::table('loan_pay_amounts')
            ->join('users','users.id','=','loan_pay_amounts.field_man_id')
            ->whereDate('loan_pay_amounts.created_at',$request->from)
            ->select('loan_pay_amounts.*','users.name')
            ->get();
        //dd($expenses);
        $from=$request->from;
        $totalCost=0;
        $userName=New  App\SavingsAccountInfo();

        foreach ($expenses as $item){
            $totalCost+=$item->amount;
        }
        $data = array_merge(['from'=>$from,'expenses'=>$expenses,'totalCost' => $totalCost,'userName'=>$userName]);
        $invoice_render = View::make('Backend.Reports.Cashier.Loan.daily-loan-report-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function pdfGenerateApplicantForm($slug){
        if(!Gate::any(['isSuper','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $userinfo=SavingsAccountInfo::where('slug',$slug)->first();
        $PermanentupazilaName=App\Upazila::where('id',$userinfo->permanent_upa)->first();
        $NomineeupazilaName=App\Upazila::where('id',$userinfo->nominee_upazila)->first();
        $data = array_merge(['userInfo'=>$userinfo,'PermanentupazilaName'=>$PermanentupazilaName,'NomineeupazilaName'=>$NomineeupazilaName]);
        $invoice_render = View::make('Backend.Reports.Supervisor.member-info-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function PfdOfLoanStatement(Request $request){
        if(!Gate::any(['isSuper','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $statements  =LoanPayAmount::where('loan_id',$request->loan_id)->get();
        $accountInfo=new SavingsAccountInfo();
        $userinfo=new User();
        $loanId=$request->loan_id;

        $id=LoanApplication::where('id',$loanId)->first();
        $applicantInfo=new SavingsAccountInfo();
        $data = array_merge(['id'=>$id,'userInfo'=>$userinfo,'accountInfo'=>$accountInfo,'statements'=>$statements,'applicantInfo'=>$applicantInfo]);
        $invoice_render = View::make('Backend.Reports.Supervisor.loan-statement-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();

    }
    public function PfdOfSavingsStatement(Request $request){
        if(!Gate::any(['isSuper','isSupervisor'])){
            abort('404','you cannot access here');
        }
        $statements  =App\SavingAmount::where('member_id',$request->id)->get();
        $accountInfo=new SavingsAccountInfo();
        $userinfo=new User();
        $id=$request->id;
        $applicantInfo=new SavingsAccountInfo();
        $data = array_merge(['id'=>$id,'userInfo'=>$userinfo,'accountInfo'=>$accountInfo,'statements'=>$statements,'applicantInfo'=>$applicantInfo]);
        $invoice_render = View::make('Backend.Reports.Supervisor.savings-statement-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();

    }
    public function generatePDFFieldOfficer(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null) {
            $from = $request->from;
            $to = $request->to;
            $savings=DB::table('saving_amounts')
                ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
                ->whereBetween('saving_amounts.created_at',[$request->from,$request->to])
                ->where('saving_amounts.field_man_id','=',$request->field_officer)
                ->select('savings_account_infos.applicant_name','saving_amounts.id','saving_amounts.member_id','saving_amounts.amount','saving_amounts.sheet_no','saving_amounts.created_at','saving_amounts.field_man_id')
                ->get();
            $loans = DB::table('loan_pay_amounts')
                ->join('savings_account_infos', 'savings_account_infos.id', '=', 'loan_pay_amounts.account_no')
                ->whereBetween('loan_pay_amounts.created_at', [$request->from, $request->to])
                ->where('loan_pay_amounts.field_man_id', '=', $request->field_officer)
                ->select('savings_account_infos.applicant_name', 'loan_pay_amounts.id', 'loan_pay_amounts.account_no', 'loan_pay_amounts.service_charge', 'loan_pay_amounts.sheet_no', 'loan_pay_amounts.field_man_id', 'loan_pay_amounts.amount', 'loan_pay_amounts.created_at')
                ->get();
            $foN=new User();
            $data = array_merge(['foN'=>$foN,'from' => $from, 'to' => $to, 'savings' => $savings, 'loans' => $loans]);
            $invoice_render = View::make('Backend.Reports.Supervisor.fieldofficer-report-pdf', $data)->render();
            $pdf = new Dompdf();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($invoice_render);
            return $pdf->stream();
        }
    }
    public function generatePDFDailyFieldOfficer(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){
            $from=$request->from;
            $foN=new User();
            $savings=DB::table('saving_amounts')
                ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
                ->whereDate('saving_amounts.created_at','=',$from)
                ->where('saving_amounts.field_man_id','=',$request->field_officer)
                ->select('savings_account_infos.applicant_name','saving_amounts.id','saving_amounts.member_id','saving_amounts.amount','saving_amounts.sheet_no','saving_amounts.created_at','saving_amounts.field_man_id')
                ->get();
            $loans=DB::table('loan_pay_amounts')
                ->join('savings_account_infos','savings_account_infos.id','=','loan_pay_amounts.account_no')
                ->whereDate('loan_pay_amounts.created_at',$from)
                ->where('loan_pay_amounts.field_man_id','=',$request->field_officer)
                ->select('savings_account_infos.applicant_name','loan_pay_amounts.id','loan_pay_amounts.account_no','loan_pay_amounts.service_charge','loan_pay_amounts.sheet_no','loan_pay_amounts.field_man_id','loan_pay_amounts.amount','loan_pay_amounts.created_at')
                ->get();
            $data = array_merge(['foN'=>$foN,'from' => $from, 'savings' => $savings, 'loans' => $loans]);
            $invoice_render = View::make('Backend.Reports.Supervisor.fieldofficer-daily-report-pdf', $data)->render();
            $pdf = new Dompdf();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($invoice_render);
            return $pdf->stream();
        }
    }
    public function pdfsheet(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->sheet!==null){
            $sheet = $request->sheet;
            $savings = DB::table('saving_amounts')
                ->where('saving_amounts.sheet_no', '=', $sheet)
                ->where('saving_amounts.status','=', 1)
                ->select('*')
                ->get();
            $loans = DB::table('loan_pay_amounts')
                ->where('sheet_no', '=', $sheet)
                ->where('loan_pay_amounts.status','=', 1)
                ->select('*')
                ->get();
            $foN=new User();
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
            $data = array_merge(['foN'=>$foN,'sheet' => $sheet, 'savings' => $savings, 'loans' => $loans,'additionalCollection'=>$additionalCollection,'applicantName'=>$applicantName]);
            $invoice_render = View::make('Backend.Reports.Supervisor.sheet-report-pdf', $data)->render();
            $pdf = new Dompdf();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($invoice_render);
            return $pdf->stream();
        }
    }
    public function viewloanDispatchReportForm(){
        return view('Backend.Reports.Supervisor.loan-despatch-report');
    }
    public function loanDispatch(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }

        if($request->from!==null){
            $from=$request->from;
            $to=$request->to;
            $loanDispatches=DB::table('loan_dispatches')
                ->join('loan_applications','loan_dispatches.loan_id','=','loan_applications.id')
                ->join('savings_account_infos','savings_account_infos.id','=','loan_applications.account_no')
                ->whereBetween('loan_dispatches.dispatch_date',[$request->from,$request->to])
                ->select('loan_dispatches.*','savings_account_infos.applicant_name','loan_applications.account_no')
                ->get();

            return view('Backend.Reports.Supervisor.loan-despatch-report',['loanDispatches'=>$loanDispatches,'from'=>$from,'to'=>$to]);
        }else{
            return view('Backend.Reports.Supervisor.loan-despatch-report');
        }
    }
    public function DailyLoanDispatch(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }

        if($request->date!==null){
            $from=$request->date;
            $loanDispatches=DB::table('loan_dispatches')
                ->join('loan_applications','loan_dispatches.loan_id','=','loan_applications.id')
                ->join('savings_account_infos','savings_account_infos.id','=','loan_applications.account_no')
                ->whereDate('loan_dispatches.dispatch_date',$from)
                ->select('loan_dispatches.*','savings_account_infos.applicant_name','loan_applications.account_no')
                ->get();

            return view('Backend.Reports.Supervisor.loan-despatch-report',['loanDispatches'=>$loanDispatches,'from'=>$from]);
        }else{
            return view('Backend.Reports.Supervisor.loan-despatch-report');
        }
    }
    public function DailyLoanDispatchPdf(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }

        if($request->from!==null) {
            $from = $request->from;
            $loanDispatches = DB::table('loan_dispatches')
                ->join('loan_applications', 'loan_dispatches.loan_id', '=', 'loan_applications.id')
                ->join('savings_account_infos', 'savings_account_infos.id', '=', 'loan_applications.account_no')
                ->whereDate('loan_dispatches.dispatch_date', $from)
                ->select('loan_dispatches.*', 'savings_account_infos.applicant_name', 'loan_applications.account_no')
                ->get();
            $data = array_merge(['loanDispatches' => $loanDispatches, 'from' => $from]);
            $invoice_render = View::make('Backend.Reports.Supervisor.daily-loan-dispatch-report-pdf', $data)->render();
            $pdf = new Dompdf();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($invoice_render);
            return $pdf->stream();
        }
    }
    public function LoanDispatchPdf(Request $request){
        if(!Gate::any(['isSuper','isCashier','isSupervisor'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null) {
            $from = $request->from;
            $to=$request->to;
            $loanDispatches = DB::table('loan_dispatches')
                ->join('loan_applications', 'loan_dispatches.loan_id', '=', 'loan_applications.id')
                ->join('savings_account_infos', 'savings_account_infos.id', '=', 'loan_applications.account_no')
                ->whereBetween('loan_dispatches.dispatch_date', [$from,$to])
                ->select('loan_dispatches.*', 'savings_account_infos.applicant_name', 'loan_applications.account_no')
                ->get();
            $foN=new User();
            $data = array_merge(['foN'=>$foN,'loanDispatches' => $loanDispatches, 'from' => $from, 'to'=>$to]);
            $invoice_render = View::make('Backend.Reports.Supervisor.loan-dispatch-report-pdf', $data)->render();
            $pdf = new Dompdf();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($invoice_render);
            return $pdf->stream();
        }
    }
}
