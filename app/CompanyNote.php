<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyNote extends Model
{
    public function company() {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }

    public function contact() {
        return $this->belongsTo('App\Contact', 'contact_id', 'id');
    }
}
