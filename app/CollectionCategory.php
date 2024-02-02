<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class CollectionCategory extends Model
{
    public function collectionCategoryName($id){
        Return DB::table('collection_categories')
            ->select('category')
            ->where('id',$id)
            ->first();
    }
}
