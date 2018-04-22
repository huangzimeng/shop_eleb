<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goodscategory extends Model
{
    //
    protected $fillable = [
        'name','description','is_select','type_accumulation','store_id'
    ];
}
