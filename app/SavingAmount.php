<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class SavingAmount extends Model
{
    use Sluggable;

    public $table = "saving_amounts";


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'amount'
            ]
        ];
    }
}
