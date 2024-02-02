<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;

class SavingsAccountInfo extends Model
{
    use Sluggable;

    public $table = "savings_account_infos";


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'applicant_name'
            ]
        ];
    }
    public function upazilaName($id){
        return  DB::table('savings_account_infos')
            ->where('id',$id)
            ->select('upazila_name');

    }
    public function ApplicantName($id){
        return DB::table('savings_account_infos')
            ->select('id','applicant_name','mobile')
            ->where('id','=',$id)
            ->first();
    }
    public function accountInfo($id){
        return DB::table('savings_account_infos')
            ->select('*')
            ->where('id','=',$id)
            ->first();
    }
}
