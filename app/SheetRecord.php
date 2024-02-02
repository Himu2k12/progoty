<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class SheetRecord extends Model
{
    use Sluggable;

    public $table = "sheet_records";


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'sheet_no'
            ]
        ];
    }
}
