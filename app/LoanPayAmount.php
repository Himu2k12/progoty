<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class LoanPayAmount extends Model
{
    use Sluggable;

    public $table = "loan_pay_amounts";


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'amount'
            ]
        ];
    }
}
