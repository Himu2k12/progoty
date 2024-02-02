<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SavingsAccountVerification extends Model
{
    public  function  SupervisorName($id){
        return DB::table('users')
            ->join('savings_account_verifications','savings_account_verifications.supervisor_id','=','users.id')
            ->where('savings_account_verifications.account_no','=',$id)
            ->select('users.name as SuperName','savings_account_verifications.account_no')
            ->first();
    }
}
