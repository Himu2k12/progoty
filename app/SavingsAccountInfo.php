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
                'source' => 'national_id'
            ]
        ];
    }
    public function upazilaName($id){
        return  DB::table('savings_account_infos')
            ->where('id',$id)
            ->select('upazila_name');

    }
}
