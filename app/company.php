<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Report;

class Company extends Model
{
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function efiles()
    {
        return $this->hasMany('Efile');
    }


    public function reports()
    {
        return $this->hasOne(Report::class);
    }

    public static function getAllCompanyData()
    {
        return self::all();
    }
}
