<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Goodslist extends Model
{
    //
    protected $guarded = [];

    public function goodscategory()
    {
        return $this->belongsTo(Goodscategory::class,'goods_category_id');
    }
}
