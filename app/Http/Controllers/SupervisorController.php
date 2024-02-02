<?php

namespace App\Http\Controllers;

use App\LoanApplication;
use App\LoanDocument;
use App\LoanDispatch;
use App\SavingAmount;
use App\SavingsAccountInfo;
use App\SavingsWithdraw;
use App\SavingsWithdrawForm;
use App\SupervisorLoanVerification;
use Carbon\Carbon;
use Chumper\Zipper\Zipper;
use FontLib\EOT\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;
use App;
use View;
use PDF;
use App\SavingsAccountVerification;
use App\AdditionalCollection;
use App\User;
use App\Upazila;
use ZipArchive;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function newMembers(){

        $newMembers=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->select('savings_account_infos.*','users.name')
            ->where('savings_account_infos.verify','=',0)
            ->get();

//dd($newMembers);

        return view('Backend.Supervisor.Members.member-list',['newMembers'=>$newMembers]);
    }
    protected function detailsView($slug){
        $viewMember=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->select('savings_account_infos.*','users.id as Sid','users.name')
            ->where('savings_account_infos.verify','=',0)
            ->where('savings_account_infos.slug','=',$slug)
            ->first();
        $upazila=new Upazila();
//dd($viewMember);
        return view('Backend.Supervisor.Members.details-of-members',['viewMember'=>$viewMember,'upazila'=>$upazila]);
    }
    protected function DeclineMember($slug){
        $DeclineAccount=SavingsAccountInfo::find($slug);
        $DeclineAccount->delete();
        
        return redirect('/new-member-requests')->with('mess','Member Request Canceled!');
    }
    protected function verifiedMembers(){
        $newMembers=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->select('savings_account_infos.*','users.name')
            ->where('savings_account_infos.verify','=',1)
            ->get();

        $supervisorName=new SavingsAccountVerification();
        return view('Backend.Supervisor.Members.verified-members',['newMembers'=>$newMembers,'supervisorName'=>$supervisorName]);
    }
    protected function VerifiedDetailsView($slug){
        $viewMember=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->select('savings_account_infos.*','users.id as Sid','users.name')
            ->where('savings_account_infos.verify','=',1)
            ->where('savings_account_infos.slug','=',$slug)
            ->first();
        $verificationDetails=DB::table('savings_account_verifications')
            ->join('users','savings_account_verifications.supervisor_id','=','users.id')
            ->where('savings_account_verifications.account_no','=',$viewMember->id)
            ->select('savings_account_verifications.*','users.name','users.id as SupervisorId')
            ->first();

        $upazila=new Upazila();
        //dd($viewMember);
        return view('Backend.Supervisor.Members.verified-members-details',['upazila'=>$upazila,'viewMember'=>$viewMember,'verificationDetails'=>$verificationDetails]);
    }
    public function confirmMember($id){
        $verifyAccount=SavingsAccountInfo::find($id);
        $verifyAccount->verify="1";
        $verifyAccount->save();

        $savingAccountInfo=new SavingsAccountVerification();
        $savingAccountInfo->account_no=$id;
        $savingAccountInfo->supervisor_id=Auth::user()->id;
        $savingAccountInfo->save();
        return redirect('/verified-members')->with('message','Account Verified!');
    }
    public function AllDailyCollections(){
        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];


        $dailyCollectionOfAllFeildman=DB::table('saving_amounts')
            ->join('users','users.id','=','saving_amounts.field_man_id')
//            ->selectRaw('SUM(amount) as sum, field_man_id,name')
            ->select('saving_amounts.field_man_id','users.name','saving_amounts.sheet_no')
            ->groupBy('saving_amounts.field_man_id','users.name','saving_amounts.sheet_no')
            ->whereDate('saving_amounts.created_at','=',$today)
            ->get();
        //dd($dailyCollectionOfAllFeildman);
        return view('Backend.Supervisor.Collections.daily-all-savings-collections',['dailyCollectionOfAllFeildman'=>$dailyCollectionOfAllFeildman]);
    }
    public function newLoanRequest(){
        $newLoan=DB::table('loan_applications')
            ->join('users','users.id','=','loan_applications.field_officer_id')
            ->select('loan_applications.*','users.name')
            ->where('status','=',0)
            ->get();
        return view('Backend.Supervisor.Loan.new-loan-request',['newLoan'=>$newLoan]);
    }
    public function LoanRequestDetails($slug){

        $loanInfo=LoanApplication::where('slug',$slug)->first();
        $customerInfo=SavingsAccountInfo::where('id',$loanInfo->account_no)->first();

        $totalApplicantDeposite=SavingAmount::where('member_id','=',$loanInfo->account_no)->where('status','=',1)->sum('amount');
        
        $savingsWithdraw = DB::table('savings_withdraw_forms')
            ->where('account_no','=',$loanInfo->account_no)
            ->where('status','=',1)
            ->get(); 
            
        $sum=0;
           
            if($savingsWithdraw != null){
                
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
                
        $totalApplicantDeposite =($totalApplicantDeposite - $sum);
        }
        $nomineeTotalInfo=new LoanApplication();


        $nominee_one=$nomineeTotalInfo->NomineeTotalInfo($loanInfo->nominee_account_1);
        $nominee_one_savings=$nomineeTotalInfo->NomineeTotalSavings($loanInfo->nominee_account_1);
        $nominee_two=$nomineeTotalInfo->NomineeTotalInfo($loanInfo->nominee_account_2);
        $nominee_two_Savings=$nomineeTotalInfo->NomineeTotalSavings($loanInfo->nominee_account_2);
        if ($nominee_one_savings==null || $nominee_two_Savings==null){
            return back()->with('mass','One Of the Nominies has no savings yet!!');
        }

        return view('Backend.Supervisor.Loan.details-loan-overview',['loanInfo'=>$loanInfo,
                                                                    'totalApplicantDeposite'=>$totalApplicantDeposite,
                                                                    'nomineeTotalInfo'=>$nomineeTotalInfo,
                                                                    'nominee_one'=>$nominee_one,
                                                                    'customerInfo'=>$customerInfo,
                                                                    'nominee_two'=>$nominee_two,
                                                                    'nominee_one_savings'=>$nominee_one_savings,
                                                                    'nominee_two_Savings'=>$nominee_two_Savings,
        ]);
    }
    public function SupervisorLoanVerification($slug){

        $loanAmount=LoanApplication::where('slug',$slug)->first();
//dd($loanAmount);


        return view('Backend.Supervisor.Loan.manage-loan-document',['slug'=>$slug,'loanAmount'=>$loanAmount]);

    }
    public function UploadDocuments(Request $request){
         $loanId=LoanApplication::where('slug',$request->slug)->first();
         
        $approveLoan=new SupervisorLoanVerification();
        $approveLoan->supervisor_id=Auth::user()->id;
        $approveLoan->loan_id=$loanId->id;
        $approveLoan->check_no=$request->check_no;
        $approveLoan->bank_name=$request->bank_name;
        $approveLoan->loan_suggest=$request->loan_suggest;
        $approveLoan->note=$request->note;
        $approveLoan->status=0;
        $approveLoan->save();
        
       
        $loanId->status=1;
        $loanId->save();

        if ($request->file('other_document')!=null){

        foreach($request->file('other_document') as $file)
        {

            if ($file->extension()=='PNG'||$file->extension()=='jpeg'||$file->extension()=='jpg'||$file->extension()=='JPG'||$file->extension()=='JEPG'||$file->extension()=='png'||$file->extension()=='pdf'||$file->extension()=='docx'||$file->extension()=='PDF'||$file->extension()=='DOCX'||$file->extension()=='doc'||$file->extension()=='DOC')
            {

                $imageName2 = $file->getClientOriginalName() ;
                $directory2 = 'Loan_Documents/';
                $temp2 = explode(".", $imageName2);
                $newfilename2 = round(microtime(true)) . date('dmYHis') . '.' . end($temp2);
                $imgLoanDoc = $directory2 . $newfilename2;
                Image::make($file)->save($imgLoanDoc);

                $UploadDocument=new LoanDocument();
                $UploadDocument->loan_id=$loanId->id;
                $UploadDocument->other_document=$newfilename2;
                $UploadDocument->save();

            }else{
                return back()->with('danger_mass','Please Upload Only JPG/PNG/PDF/DOC file!');
            }


        }
        }
        return redirect('/new-loan-documents')->with('mass','Information added successfully');

       //dd($request->file('non_juditial'));
    }
    public function SupervisorLoanVerificationCancel($slug){
       
        $loanId=LoanApplication::where('slug','=',$slug)->first();
        $loanId->status=-1;//-1 for loan cancelation
        $loanId->save();
 
        $approveLoan=new SupervisorLoanVerification();
        $approveLoan->loan_id=$loanId->id;
        $approveLoan->supervisor_id = Auth::user()->id;
        $approveLoan->loan_suggest = 00000;
        $approveLoan->note="Supervisor Canceled the loan";
        $approveLoan->status=-1 ; //-1 for loan cancelation
        $approveLoan->save();
        
        return redirect('/new-loan-request')->with('mass','Loan Application Canceled!');

    }
    public function LoanDocuments(){
        $newLoan= SupervisorLoanVerification::where('status',0)->get();
        $newObject=new LoanDocument();
        $newAccount=new SupervisorLoanVerification();

        return view('Backend.Supervisor.Loan.Loan-documents',['newLoan'=>$newLoan,'newObject'=>$newObject,'newAccount'=>$newAccount]);
    }
    public function downloadDocument($id){

        $loanDoc=DB::table('loan_documents')
            ->select('other_document')
            ->where('loan_id',$id)
            ->where('status','=',0)
            ->get();
        $zip= new \Chumper\Zipper\Zipper;
        foreach ($loanDoc as $item) {
            $files[] = glob('Loan_Documents/'.$item->other_document);
        }

        $zip->make('loan_document'.$id.'.zip')->add($files);
        $zip->close();

        return response()->download(public_path('loan_document'.$id.'.zip'));
    }
    public function viewDoc($id){
        $doc=LoanDocument::find($id);
        $docname=$doc->other_document;
        $array = explode('.', $docname);
        $extension = end($array);
//dd($extension);
        if ($extension=='pdf'){
            return '<embed src="'.url('Loan_Documents/'.$docname).'" type="application/pdf" width="100%" height="600px"><i height="600px" width="100%">';
        }elseif($extension=='docx'||$extension=='DOCX'||$extension=='doc'||$extension=='DOC'){
//            dd('me');
            return '<iframe src="'.url('Loan_Documents/'.$docname).'">myDocument</iframe>';
        }
        else{
            return '<img src="'.url('Loan_Documents/'.$docname).'" ><i height="600px" width="100%">';
        }

    }
    public function EditLoanDocumentForm($slug){
//        $loanaId=LoanApplication::where('slug',$slug)->first();
        $loanInfo=DB::table('supervisor_loan_verifications')
            ->select('*')
            ->where('id','=',$slug)
            ->first();
        $docList=LoanDocument::where('loan_id',$loanInfo->loan_id)->where('status','=',0)->get();
        return view('Backend.Supervisor.Loan.Edit-loan-documents',['loanInfo'=>$loanInfo,'docList'=>$docList]);
    }
    public function UpdateLoanDocumentForm(Request $request){

        $approveLoan=SupervisorLoanVerification::find($request->id);
        $approveLoan->check_no=$request->check_no;
        $approveLoan->bank_name=$request->bank_name;
        $approveLoan->loan_suggest=$request->loan_suggest;
        $approveLoan->note=$request->note;
        $approveLoan->save();

        if ($request->file('other_document')!=null) {

             foreach ($request->file('other_document') as $file) {

                 if ($file->extension() == 'PNG'|| $file->extension() == 'jpeg' || $file->extension() == 'jpg' || $file->extension() == 'JPG' || $file->extension() == 'JEPG' || $file->extension() == 'png' || $file->extension() == 'pdf' || $file->extension() == 'docx' || $file->extension() == 'PDF' || $file->extension() == 'DOCX' || $file->extension() == 'doc' || $file->extension() == 'DOC') {

                    $imageName2 = $file->getClientOriginalName();
                    $directory2 = 'Loan_Documents/';
                    $temp2 = explode(".", $imageName2);
                    $newfilename2 = round(microtime(true)) . date('dmYHis') . '.' . end($temp2);
                    $imgLoanDoc = $directory2 . $newfilename2;
                    Image::make($file) ->resize(700, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($imgLoanDoc);
        
                    $UploadDocument = new LoanDocument();
                    $UploadDocument->loan_id = $approveLoan->loan_id;
                    $UploadDocument->other_document = $newfilename2;
                    $UploadDocument->save();

                } else {
            return back()->with('danger_mass', 'Please Upload Only JPG/PNG/PDF/DOC file!');
        }


    }
    return back()->with('mass', 'New Document Upload Sucessful!');
}
        return redirect('new-loan-documents')->with('mass', 'Loan Info Updated Successfully!');
    }
    public function deleteDocument($id){
         $deldoc=LoanDocument::find($id);
        $deldoc->delete();
        return back()->with('danger_mass','Document Deleted Successfully!');
    }
    public function DailyCollectionOfFieldofficer($id){
        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];

        $everyDayCollection=DB::table('saving_amounts')
            ->join('savings_account_infos','savings_account_infos.id','=','saving_amounts.member_id')
            ->select('savings_account_infos.applicant_name','savings_account_infos.id as mid','saving_amounts.*')
            ->where('saving_amounts.field_man_id','=',$id)
            ->whereDate('saving_amounts.created_at','=',$today)
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
            ->whereDate('loan_pay_amounts.created_at','=',$today)
            ->where('loan_pay_amounts.field_man_id','=',$id)
            ->orderBy('loan_pay_amounts.id','desc')
            ->get();
        $additionalCollection=DB::table('additional_collections')
            ->select('additional_collections.*')
            ->whereDate('date_of_cost',$today)
            ->where('created_by','=',$id)
            ->get();

        foreach ($everyDayLoanApplication as $everyDay){
            $loanSum=$loanSum+$everyDay->amount;
            $service=$service+$everyDay->service_charge;

        }

        $sumOfDepositeService=$service;
        $sumOfDepositeLoanAmount=$loanSum;
        $colcate=new App\CollectionCategory();
        $foN=new User();
//dd($everyDayLoanApplication);
        return view('Backend.Supervisor.Collections.daily-field-man-collection',['everyDayCollection'=>$everyDayCollection,
            'everyDayLoanApplication'=>$everyDayLoanApplication,
            'sumOfDeposite'=>$sumOfDeposite,
            'sumOfDepositeService'=>$sumOfDepositeService,
            'additionalCollection'=>$additionalCollection,
            'sumOfDepositeLoanAmount'=>$sumOfDepositeLoanAmount,
            'colcate'=>$colcate,
            'foN'=>$foN,
        ]);

    }
    public function allActiveLoansforSupervisor(){

        $loanDispatch=DB::table('loan_dispatches')
            ->join('loan_applications','loan_dispatches.loan_id','=','loan_applications.id')
            ->join('supervisor_loan_verifications','supervisor_loan_verifications.loan_id','=','loan_dispatches.loan_id')
            ->join('users','users.id','=','loan_applications.field_officer_id')
            ->select('loan_dispatches.*','users.name','loan_applications.field_officer_id')
            ->where('supervisor_loan_verifications.supervisor_id','=',Auth::user()->id)
            ->get();
            $loanAccount=new LoanDispatch();

        $supervisorName=new SupervisorLoanVerification();
        return view('Backend.Supervisor.Loan.active-loans',['loanDispatch'=>$loanDispatch,'supervisorName'=>$supervisorName,'loanAccount'=>$loanAccount]);
    }
    public function dailyAllCollection(){
        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];


//        $first=DB::table('saving_amounts')
//            ->selectRaw('SUM(amount) as sumSavings, sheet_no, member_id,field_man_id')
//            ->groupBy('sheet_no','member_id','field_man_id')
//            ->distinct('field_man_id')
//            ->whereDate('created_at',$today);
//        $second=DB::table('loan_pay_amounts')
//            ->selectRaw('SUM(amount) as loanSavings, sheet_no, account_no,field_man_id')
//            ->groupBy('sheet_no','account_no','field_man_id')
//            ->distinct()
//            ->union($first)
//            ->get();
//        dd($second);

        $allCollection=DB::table('saving_amounts')
            ->join('users','users.id','=','saving_amounts.field_man_id')
            ->select(DB::raw('SUM(saving_amounts.amount) as sumSavings, saving_amounts.field_man_id,saving_amounts.sheet_no,users.name'))
            ->whereDate('saving_amounts.created_at','=',$today)
            ->groupBy('saving_amounts.field_man_id','saving_amounts.sheet_no','users.name')
            ->get();
        $additionalColections=DB::table('additional_collections')
            ->selectRaw('created_by, sum(additional_cost) as sum')
            ->where('date_of_cost',$today)
            ->groupBy('created_by')
            ->get();
        $userName=new User();

        $allLoanCollection=DB::table('loan_pay_amounts')
            ->join('users','users.id','=','loan_pay_amounts.field_man_id')
            ->select(DB::raw('SUM(loan_pay_amounts.amount) as sumLoans,SUM(loan_pay_amounts.service_charge) as sumService, loan_pay_amounts.field_man_id,loan_pay_amounts.sheet_no,users.name'))
            ->whereDate('loan_pay_amounts.created_at','=',$today)
            ->groupBy('loan_pay_amounts.field_man_id','loan_pay_amounts.sheet_no','users.name')
            ->get();
//        dd($allLoanCollection);
        return view('Backend.Supervisor.Collections.daily-collection',['allCollection'=>$allCollection,
                                                                    'allLoanCollection'=>$allLoanCollection,
                                                                    'additionalColections'=>$additionalColections,
                                                                    'userName'=>$userName,

            ]);
    }
    public function SearchAllCollection(Request $request){
        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];

        $allCollection=DB::table('saving_amounts')
            ->leftJoin('loan_pay_amounts','loan_pay_amounts.field_man_id','=','saving_amounts.field_man_id')
            ->leftJoin('users','users.id','=','saving_amounts.field_man_id')
            ->selectRaw('SUM(saving_amounts.amount) as sumSavings,SUM(loan_pay_amounts.amount) as sumLoan,SUM(loan_pay_amounts.service_charge) as sumService, saving_amounts.field_man_id,saving_amounts.sheet_no,saving_amounts.created_at,users.name')
            ->groupBy('saving_amounts.field_man_id','saving_amounts.created_at','saving_amounts.sheet_no','saving_amounts.created_at','users.name')
            ->whereDate('saving_amounts.created_at','=',$today)
            ->get();

        $searchCollection=DB::table('saving_amounts')
            ->leftJoin('loan_pay_amounts','loan_pay_amounts.field_man_id','=','saving_amounts.field_man_id')
            ->leftJoin('users','users.id','=','saving_amounts.field_man_id')
            ->selectRaw('SUM(saving_amounts.amount) as sumSavings,SUM(loan_pay_amounts.amount) as sumLoan,SUM(loan_pay_amounts.service_charge) as sumService, saving_amounts.field_man_id,saving_amounts.sheet_no,saving_amounts.created_at,users.name')
            ->groupBy('saving_amounts.field_man_id','saving_amounts.created_at','saving_amounts.sheet_no','saving_amounts.created_at','users.name')
            ->whereDate('saving_amounts.created_at','=',$request->date)
            ->get();
        return view('back.Supervisor.Report.daily-collection',['allCollection'=>$allCollection,'searchCollection'=>$searchCollection]);
    }
    public function printDailyReport(){
        $mytime=Carbon::now();
        $mytime->toDateTimeString();
        $array = explode(" ", $mytime);
        $today=$array[0];

        $allCollection=DB::table('saving_amounts')
            ->join('users','users.id','=','saving_amounts.field_man_id')
            ->select(DB::raw('SUM(saving_amounts.amount) as sumSavings, saving_amounts.field_man_id,saving_amounts.sheet_no,users.name'))
            ->whereDate('saving_amounts.created_at','=',$today)
            ->groupBy('saving_amounts.field_man_id','saving_amounts.sheet_no','users.name')
            ->get();

        $additionalColections=DB::table('additional_collections')
            ->selectRaw('created_by, sum(additional_cost) as sum')
            ->where('date_of_cost',$today)
            ->groupBy('created_by')
            ->get();
        $userName=new User();

        $allLoanCollection=DB::table('loan_pay_amounts')
            ->join('users','users.id','=','loan_pay_amounts.field_man_id')
            ->select(DB::raw('SUM(loan_pay_amounts.amount) as sumLoans,SUM(loan_pay_amounts.service_charge) as sumService, loan_pay_amounts.field_man_id,loan_pay_amounts.sheet_no,users.name'))
            ->whereDate('loan_pay_amounts.created_at','=',$today)
            ->groupBy('loan_pay_amounts.field_man_id','loan_pay_amounts.sheet_no','users.name')
            ->get();
        $invoice_render = View::make('Backend.Reports.dailyAllcollection',['userName'=>$userName,'allCollection'=>$allCollection,'allLoanCollection'=>$allLoanCollection,'date'=>$today,'additionalColections'=>$additionalColections])->render();
        // dd($invoice_render);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function withdrawSavings(){
        $requests=DB::table('savings_withdraw_forms')
            ->join('users','users.id','=','savings_withdraw_forms.field_man_id')
            ->join('savings_account_infos','savings_account_infos.id','=','savings_withdraw_forms.account_no')
            ->select('users.name','savings_withdraw_forms.*','savings_account_infos.applicant_name')
            ->where('savings_withdraw_forms.status','=',0)
            ->get();
        return view('Backend.Supervisor.SavingsWithdraw.withdraw-savings-request',['requests'=>$requests]);
    }
    public function WithdrawRequestDetails($slug){
        $viewMember=DB::table('savings_account_infos')
            ->join('users','users.id','=','savings_account_infos.field_man_id')
            ->join('savings_withdraw_forms','savings_withdraw_forms.account_no','=','savings_account_infos.id')
            ->select('savings_account_infos.*','users.id as Sid','users.name','savings_withdraw_forms.id as Lid','savings_withdraw_forms.total_savings','savings_withdraw_forms.mobile','savings_withdraw_forms.form_fee','savings_withdraw_forms.note','savings_withdraw_forms.days_of_saving','savings_withdraw_forms.status as Sstatus')
            ->where('savings_account_infos.verify','=',1)
            ->where('savings_withdraw_forms.id','=',$slug)
            ->first();
      //dd($viewMember);

//        $checkDepositeInfo=SavingAmount::where('member_id',$viewMember->account_no)->first();

        $totalApplicantDeposite=DB::table('saving_amounts')
            ->where('member_id','=',$viewMember->id)
            ->where('status',1)
            ->sum('saving_amounts.amount');
            
        $savingsWithdrawntillnow=DB::table('savings_withdraw_forms')
        ->join('savings_withdraws','savings_withdraws.request_id','=','savings_withdraw_forms.id')
        ->where('savings_withdraw_forms.account_no','=',$viewMember->id)
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
       
        $totalApplicantDeposite=$totalApplicantDeposite-$amount;

        return view('Backend.Supervisor.SavingsWithdraw.view-savings-withdrawal-request',['viewMember'=>$viewMember,
            'totalApplicantDeposite'=>$totalApplicantDeposite
        ]);
    }
    public function CancelWithdrawRequest($slug){
        $withdrawRequest=SavingsWithdrawForm::find($slug);
        $withdrawRequest->status=-1;
        $withdrawRequest->save();
        return redirect('/withdraw-requests')->with('mass','Request canceled!');
    }
    public function approveWithdrawRequest($id){

        $allInfo=DB::table('savings_account_infos')
            ->join('savings_withdraw_forms','savings_withdraw_forms.account_no','=','savings_account_infos.id')
            ->select('savings_account_infos.*','savings_withdraw_forms.id as Lid','savings_withdraw_forms.total_savings','savings_withdraw_forms.mobile','savings_withdraw_forms.form_fee','savings_withdraw_forms.note','savings_withdraw_forms.days_of_saving','savings_withdraw_forms.created_at as applicationDate')
            ->where('savings_account_infos.verify','=',1)
            ->where('savings_withdraw_forms.id','=',$id)
            ->first();
        
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
         $sum=0;    
        $currentBalance=0;
                 
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
                

            
        
        $schemes=App\Scheme::where('status',1)->get();

        return view('Backend.Supervisor.SavingsWithdraw.final-stage-approval',['schemes'=>$schemes,'allInfo'=>$allInfo, 'SumofMoney'=>$SumofMoney,'allSavingsDetails'=>$allSavingsDetails,'SumofTotalWithdrawMoney'=>$sum,'currentBalance'=>$currentBalance]);
    }
    public function submitRequestToSuper(Request $request){
        //dd($request->request_id);
        $savingsWithdraw=new SavingsWithdraw();
        $savingsWithdraw->request_id=$request->withdraw_id;
        $savingsWithdraw->supervisor_id=Auth::user()->id;
        $savingsWithdraw->percentage=$request->scheme_year;
        $savingsWithdraw->savings_amount=$request->current_amount;
        $savingsWithdraw->profit=$request->profit;
        $savingsWithdraw->bonus=$request->bonus;
        $savingsWithdraw->total=$request->total;
        $savingsWithdraw->status=0;
        $savingsWithdraw->save();

        $savings=SavingsWithdrawForm::find($request->withdraw_id);
        $savings->status=1;
        $savings->save();

        return redirect('/pending-withdraw-requests')->with('mass','Request Send to ED Successfully!');
    }
    public function viewSubmitedRequest(){
        $pendingForAdminApproval=DB::table('savings_withdraws')
            ->join('savings_withdraw_forms','savings_withdraws.request_id','=','savings_withdraw_forms.id')
            ->join('savings_account_infos','savings_account_infos.id','=','savings_withdraw_forms.account_no')
            ->where('savings_withdraws.status','=',0)
            ->where('savings_withdraws.supervisor_id','=',Auth::user()->id)
            ->select('savings_withdraws.*','savings_account_infos.id as accountNo','savings_account_infos.applicant_name')
            ->get();
           //dd($pendingForAdminApproval);
        return view('Backend.Supervisor.SavingsWithdraw.pending-withdraw-requests',['pendingForAdminApproval'=>$pendingForAdminApproval]);
    }
    public function editSubmittedRequest($id){
        $editInfo=SavingsWithdraw::find($id);
        $allInfo=DB::table('savings_account_infos')
            ->join('savings_withdraw_forms','savings_withdraw_forms.account_no','=','savings_account_infos.id')
            ->select('savings_account_infos.*','savings_withdraw_forms.id as Lid','savings_withdraw_forms.total_savings','savings_withdraw_forms.mobile','savings_withdraw_forms.form_fee','savings_withdraw_forms.note','savings_withdraw_forms.days_of_saving','savings_withdraw_forms.created_at as applicationDate')
            ->where('savings_account_infos.verify','=',1)
            ->where('savings_withdraw_forms.id','=',$editInfo->request_id)
            ->first();
            
        $SumofMoney=DB::table('saving_amounts')
            ->where('member_id','=',$allInfo->id)
            ->sum('saving_amounts.amount');
            
        $savingsWithdraw = DB::table('savings_withdraw_forms')
            ->where('account_no','=',$allInfo->id)
            ->where('status','=',1)
            ->get(); 
            
            
        if($savingsWithdraw != null){
            
                 $sum=0;
                 
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
            
        $allSavingsDetails=DB::table('saving_amounts')
            ->select('*')
            ->where('member_id','=',$allInfo->id)
            ->where('status','=',1)
            ->get();
        $schemes=App\Scheme::where('status',1)->get();
        return view('Backend.Supervisor.SavingsWithdraw.edit-submitted-request',['schemes'=>$schemes,'editInfo'=>$editInfo,'allInfo'=>$allInfo, 'SumofMoney'=>$SumofMoney,'allSavingsDetails'=>$allSavingsDetails,'currentBalance'=>$currentBalance]);

    }
    public function updateSubmittedRequest(Request $request){
        $updateInfo=SavingsWithdraw::find($request->U_ID);
        $updateInfo->percentage=$request->scheme_year;
        $updateInfo->profit=$request->profit;
        $updateInfo->bonus=$request->bonus;
        $updateInfo->total=$request->total;
        $updateInfo->save();
        return redirect('/pending-withdraw-requests')->with('message','Info Updated Successfully!!');
    }
}
