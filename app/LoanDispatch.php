<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoanDispatch extends Model
{
    public function loanDispatch($id){
        return DB::table('loan_applications')
            ->join('savings_account_infos','loan_applications.account_no','=','savings_account_infos.id')
            ->select('savings_account_infos.id','savings_account_infos.applicant_name')
            ->where('loan_applications.id','=',$id)
            ->where('loan_applications.status','=',3)
            ->first();
    }
    public function AccountNameForCashier($id){
        return DB::table('loan_applications')
            ->join('savings_account_infos','loan_applications.account_no','=','savings_account_infos.id')
            ->select('savings_account_infos.id','savings_account_infos.applicant_name')
            ->where('loan_applications.id','=',$id)
            ->first();
    }
    
    public function loanAccount($id){
        return DB::table('savings_account_infos')
        ->select('applicant_name')
        ->where('id','=',$id)
        ->first();
    }
}
