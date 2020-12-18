<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model 
{

    protected $table = 'forms';
    public $timestamps = true;

    public function report()
    {
        return $this->belongsTo('Report');
    }

}