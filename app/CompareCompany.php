<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompareCompany extends Model
{
    public function company() {
        return $this->belongsTo('App\Company','compared_company','id');
    }
}
