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
            ->join('saving_amounts','saving_amounts.member_id','=','savings_account_infos.id')
            ->select('savings_account_infos.*', DB::raw('SUM(saving_amounts.amount) AS total'))
            ->where('savings_account_infos.id','=',$id)
            ->groupBy('saving_amounts.id','saving_amounts.amount','saving_amounts.field_man_id','savings_account_infos.id','savings_account_infos.applicant_name','savings_account_infos.applicants_father_name'
                ,'progoty.savings_account_infos.national_id','savings_account_infos.slug','savings_account_infos.gender','savings_account_infos.marital_status','savings_account_infos.religion','savings_account_infos.husband_name','.savings_account_infos.yearly_scheme'
                ,'savings_account_infos.deposite_type','progoty.savings_account_infos.amount_of_money','savings_account_infos.form_fee','savings_account_infos.present_dist','savings_account_infos.present_upa'
                ,'savings_account_infos.present_post_code','savings_account_infos.present_village','savings_account_infos.permanent_dist','savings_account_infos.permanent_upa','.savings_account_infos.permanent_post_code'
                ,'savings_account_infos.permanent_village','savings_account_infos.nominee_name','savings_account_infos.relation','savings_account_infos.nominee_dist','savings_account_infos.nominee_upazila','savings_account_infos.nominee_post_code'
                ,'savings_account_infos.nominee_address','savings_account_infos.nomine_nid','savings_account_infos.applicant_photo','savings_account_infos.applicant_nid','savings_account_infos.applicant_signature','savings_account_infos.field_man_id','savings_account_infos.verify'
                ,'savings_account_infos.created_at','savings_account_infos.updated_at')
            ->first();
    }
}
