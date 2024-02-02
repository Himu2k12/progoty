<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavingsWithdrawForm extends Model
{
    public function withdrawFormDetails($id){
        return SavingsWithdrawForm::where('id',$id)->first();
    }
}
