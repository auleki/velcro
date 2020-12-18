<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyHistory extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user', 'id');
    }
}
