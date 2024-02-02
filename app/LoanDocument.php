<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoanDocument extends Model
{
    public function documents($id){
        return DB::table('loan_documents')
            ->select('*')
            ->where('loan_id','=',$id)
            ->where('status','=',0)
            ->get();
    }
}
