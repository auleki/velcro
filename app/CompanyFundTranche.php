<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyFundTranche extends Model
{
    public function company()
    {
        return $this->belongsTo('App\CompanyFund', 'company_fund_id', 'id');
    }
}
