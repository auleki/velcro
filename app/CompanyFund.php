<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyFund extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }

    public function tranches()
    {
        return $this->hasMany('App\CompanyFundTranche', 'company_fund_id', 'id');
    }
}
