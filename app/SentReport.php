<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SentReport extends Model
{
    use SoftDeletes;

    public function recipient()
    {
        return $this->hasOne('App\Recipient', 'report_id', 'id');
    }
}
