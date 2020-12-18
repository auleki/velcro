<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany('App\FundActivity', 'fund_id', 'id');
    }

    public function tag()
    {
        return $this->hasOne('App\Tag');
    }
}
