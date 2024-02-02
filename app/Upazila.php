<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Upazila extends Model
{
    public function upazilaName($id){
        return DB::table('upazilas')
            ->select('upazila_name')
            ->where('id',$id)
            ->first();
    }
}
