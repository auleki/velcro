<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyReport extends Model
{
    public function report() {
        return $this->belongsTo('App\Report', 'report_id', 'id');
    }
}
