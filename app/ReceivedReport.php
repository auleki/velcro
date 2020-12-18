<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceivedReport extends Model
{
    use SoftDeletes;
    
    public function recipient()
    {
        return $this->belongsTo('App\Recipient');
    }
}
