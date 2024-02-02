<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SupervisorLoanVerification extends Model
{
    public function LoanSupervisorName($id){
        return DB::table('supervisor_loan_verifications')
            ->join('users','users.id','=','supervisor_loan_verifications.supervisor_id')
            ->where('loan_id',$id)
            ->select('users.name','supervisor_loan_verifications.supervisor_id')
            ->first();
    }
    
    public function AccountNumber($id){
         return DB::table('loan_applications')
            ->where('id',$id)
            ->select('account_no')
            ->first();
    }
}
