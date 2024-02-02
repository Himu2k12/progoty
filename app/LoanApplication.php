<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoanApplication extends Model
{
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['present_village','loan_amount']
            ]
        ];
    }

    public function NomineeTotalInfo($id){
        return DB::table('savings_account_infos')
           ->where('id','=',$id)
            ->first();
    }

    public function NomineeTotalSavings($id){
        return DB::table('saving_amounts')
            ->where('member_id','=',$id)
            ->sum('amount');
    }


}
