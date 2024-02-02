<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CostCategory extends Model
{
    public function categoryName($id){
        return DB::table('cost_categories')
            ->where('id',$id)
            ->select('category')
            ->first();
    }
}
